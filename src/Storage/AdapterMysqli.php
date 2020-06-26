<?php
declare(strict_types=1);
namespace Storage;

class AdapterMysqli implements AdapterIface
{
    /**
     * @var ConnectorIface
     */
    public ConnectorIface $connector;

    /**
     * @param ConnectorIface $connector
     */
    public function __construct(ConnectorIface $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param string $source
     * @param mixed[] $filter
     * @return \Iterator
     */
    public function find(string $source, array $filter): \Iterator
    {
        return $this->connector->get($source, $filter);
    }

    /**
     * @param string $target
     * @param mixed[] $data
     * @return \Iterator
     */
    public function create(string $target, array $data): \Iterator
    {
        $id = $this->connector->create($target, $data);
        $data['id'] = $id;

        return $this->connector->get($target, $data);
    }

    /**
     * @param string $target
     * @param mixed[] $data
     * @return void
     */
    public function update(string $target, array $data): void
    {
        $this->connector->update($target, $data);
    }
}
