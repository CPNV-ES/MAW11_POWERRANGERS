<?php

namespace App\Model\Entity;

class Answer
{
    private int $id;
    private string $answer;

    /**
     * Answer constructor.
     * @param int $id
     * @param string $answer
     */
    public function __construct(int $id, string $answer)
    {
        $this->id = $id;
        $this->answer = $answer;
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
     * Getter of answer
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }
}
