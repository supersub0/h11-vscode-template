<?php
declare(strict_types=1);
namespace Storage;

interface AdapterIface
{
    /**
     * @param string $source
     * @param mixed[] $filter
     * @return \Iterator
     */
    public function find(string $source, array $filter): \Iterator;

    /**
     * @param string $target
     * @param mixed[] $data
     * @return \Iterator
     */
    public function create(string $target, array $data): \Iterator;

    /**
     * @param string $target
     * @param mixed[] $data
     * @return void
     */
    public function update(string $target, array $data): void;
}
