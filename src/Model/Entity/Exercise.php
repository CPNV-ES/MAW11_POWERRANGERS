<?php

namespace App\Model\Entity;

class Exercise
{
    private int $id;
    private string $name;
    private array $fields;

    /**
     * Exercise constructor.
     * @param int $id
     * @param string $name
     * @param array $fields
     */
    public function __construct(int $id, string $name, array $fields)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fields = $fields;
    }

    /**
     * Getter of id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter of name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Getter of fields
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
