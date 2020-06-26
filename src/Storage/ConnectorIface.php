<?php
declare(strict_types=1);
namespace Storage;

interface ConnectorIface
{
    /**
     * @param string $source
     * @param mixed[] $filter
     * @return \Iterator
     */
    public function get(string $source, array $filter): \Iterator;

    /**
     * @param string $target
     * @param mixed[] $data
     * @return int|null
     */
    public function create(string $target, array $data): ?int;

    /**
     * @param string $target
     * @param mixed[] $data
     * @return void
     */
    public function update(string $target, array $data): void;
}
