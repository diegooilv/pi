<?php

class MaterialViewModel
{
    public function __construct(
        private array $material,
        private array $author,
    ) {
    }

    public function getMaterial()
    {
        return $this->material;
    }

    public function getauthor()
    {
        return $this->author;
    }
}
