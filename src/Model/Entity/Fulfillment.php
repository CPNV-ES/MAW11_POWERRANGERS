<?php

namespace App\Model\Entity;

use DateTime;

class Fulfillment
{
    private int $id;
    private DateTime $dateTime;
    private array $answers;

    /**
     * Fulfillment constructor.
     * @param int $id
     * @param DateTime $dateTime
     * @param array $answers array of Answer
     */
    public function __construct(int $id, DateTime $dateTime, array $answers)
    {
        $this->id = $id;
        $this->dateTime = $dateTime;
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
     * Getter of dateTime
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
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
     * Add an answer to the array of answers
     * @param Answer $answer
     * @return void
     */
    public function addAnswer(Answer $answer): void
    {
        $this->answers[] = $answer;
    }
}
