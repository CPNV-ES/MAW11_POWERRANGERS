<?php

namespace App\Model\Entity;

class FieldType
{
    private int $id;
    private string $name;

    /**
     * FieldType constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
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
}
