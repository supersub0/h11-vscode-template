<?php
declare(strict_types=1);
namespace Iterator;

class MysqliResult implements \Iterator
{
    /**
     * @var \mysqli_result
     */
    private \mysqli_result $mysqliResult;

    /**
     * @var int
     */
    private int $currentRow = 0;

    /**
     * @param \mysqli_result $result
     */
    public function __construct(\mysqli_result $result) {
        $this->mysqliResult = $result;
        $this->mysqliResult->data_seek($this->currentRow);
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->mysqliResult->data_seek(0);
    }

    /**
     * @return void
     */
    public function next()
    {
        $this->currentRow = min($this->mysqliResult->num_rows, ++$this->currentRow);
        $this->mysqliResult->data_seek($this->currentRow);
    }

    /**
     * @return mixed[]
     */
    public function current()
    {
        $row = $this->mysqliResult->fetch_assoc();
        $this->mysqliResult->data_seek($this->currentRow);

        return $row;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->currentRow;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->currentRow < $this->mysqliResult->num_rows;
    }
}
