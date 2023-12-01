<?php

namespace App\Model\Entity;

class Field
{
    private int $id;
    private string $name;
    private FieldType $fieldType;
    private array $answers;

    /**
     * Field constructor.
     * @param int $id
     * @param string $name
     * @param FieldType $fieldType
     * @param array $answers array of Answer
     */
    public function __construct(int $id, string $name, FieldType $fieldType, array $answers)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fieldType = $fieldType;
        $this->answers = $answers;
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
     * Getter of fieldType
     * @return FieldType
     */
    public function getFieldType(): FieldType
    {
        return $this->fieldType;
    }

    /**
     * Getter of answers
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * Add an answer
     * @param Answer $answer
     */
    public function addAnswer(Answer $answer): void
    {
        $this->answers[] = $answer;
    }
}
