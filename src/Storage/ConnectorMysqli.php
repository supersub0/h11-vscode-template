<?php
declare(strict_types=1);
namespace Storage;
use \Iterator\MysqliResult;

class ConnectorMysqli implements ConnectorIface
{
    /**
     * @var \mysqli
     */
    private \mysqli $connection;

    /**
     * @param ConnectorIface $connector
     */
    public function __construct(string $host, string $user, string $pass, string $dbname)
    {
        $this->connection = new \mysqli($host, $user, $pass, $dbname);
        $this->connection->set_charset('utf8');
    }

    /**
     * @param string $source
     * @param mixed[] $filter
     * @return \Iterator|null
     */
    public function get(string $source, array $filter): \Iterator
    {
        $result = $this->connection->query(
            'SELECT *
                FROM `'.$this->escape($source).'`'.
                (empty($filter) ? '' : 'WHERE '.$this->getFilterQuery($filter, ' AND ', false, true))
        );

        if ($result) {
            return new \Iterator\MysqliResult($result);
        }
    }

    /**
     * @param string $target
     * @param mixed[] $data
     * @return int|null
     */
    public function create(string $target, array $data): ?int
    {
        if (empty($data['id'])) {
            $data = array_merge( ['id' => null], $data);
        }

        if ($this->connection->query(
            'INSERT INTO `'.$this->escape($target).'`
            SET '.$this->getFilterQuery($data)
        )) {
            return (int)$this->connection->insert_id;
        }

        return null;
    }

    /**
     * @param string $target
     * @param mixed[] $data
     * @return void
     */
    public function update(string $target, array $data): void
    {
        $this->connection->query(
            'UPDATE `'.$this->escape($target).'`
            SET '.$this->getFilterQuery($data).'
            WHERE `id` = '.(int)$data['id']
        );
    }

    /**
     * @param mixed[] $row
     * @param string $sep
     * @param bool $onlyValues
     * @param bool $forFilter
     * @throws \InvalidArgumentException Thrown if passing wrong data to the function.
     * @return string
     */
    private function getFilterQuery(
        array $row,
        string $sep = ',',
        bool $onlyValues = false,
        bool $forFilter = false
    ): string {
        $tmp = [];

        foreach ($row as $k => $v) {
            if ($v === null) {
                if ($forFilter) {
                    $tmp[] = '`'.$k.'` IS NULL';
                } else {
                    $tmp[] = '`'.$k.'` = NULL';
                }
            } elseif (is_array($v)) {
                if (!$forFilter) {
                    throw new \InvalidArgumentException('Use array only for filter.');
                } elseif (reset($v) === 'NOT IN') {
                    if (count($v) != 2) {
                        throw new \InvalidArgumentException('NOT IN: expecting exactly 2 fields.');
                    }

                    $v = end($v);
                    $notIn = true;

                    if (!is_array($v)) {
                        throw new \InvalidArgumentException('NOT IN: the argument is not an array.');
                    }
                } else {
                    $notIn = false;
                }

                if ((count($v) == 0)) {
                    throw new \InvalidArgumentException('(NOT) IN: the argument is an empty array.');
                } else {
                    $values = [];
                    $checkNULL = '';

                    foreach ($v as $val) {
                        if ($val === null) {
                            if ($forFilter) {
                                $checkNULL = '`'.$k.'` IS NULL';
                            } else {
                                $checkNULL = '`'.$k.'` = NULL';
                            }
                        } elseif (is_array($val)) {
                            throw new \InvalidArgumentException('(NOT) IN: only 1 dimensional arrays allowed.');
                        } else {
                            $values[] = $this->escape($val);
                        }
                    }

                    $tmpFilter = [];

                    if (!empty($values)) {
                        $tmpFilter[] = '`'.$k.'` '.($notIn ? 'NOT ' : '').'IN ("'.implode('","', $values).'")';
                    }

                    if (!empty($checkNULL)) {
                        $tmpFilter[] = $checkNULL;
                    }

                    $tmp[] = '('.implode(' OR ', $tmpFilter).')';
                }
            } elseif (mb_strpos((string)$v, 'LIKE ') === 0 && $forFilter) {
                $tmp[] = '`'.$k.'` LIKE "'.$this->escape(substr($v, 5)).'"';
            } elseif (mb_strpos((string)$v, 'REGEXP ') === 0 && $forFilter) {
                $tmp[] = '`'.$k.'` REGEXP "'.$this->escape(substr($v, 7)).'"';
            } elseif ($onlyValues) {
                $tmp[] = '"'.$this->escape($v).'"';
            } else {
                $tmp[] = '`'.$k.'` = "'.$this->escape($v).'"';
            }
        }

        return implode($sep, $tmp);
    }

    /**
     * @param mixed $value
     * @return string
     */
    private function escape($value): string
    {
        return $this->connection->real_escape_string((string)$value);
    }
}
