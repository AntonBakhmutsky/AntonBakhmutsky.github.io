<?php


namespace ITLeague\Interfaces;


interface MetaDataInterface
{
    public function init(): void;
    public function set(): void;
    public function get(): array;
}
