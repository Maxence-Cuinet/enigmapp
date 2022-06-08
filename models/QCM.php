<?php

class QCM extends Question
{
    private array $possibleAnswers;

    public function __construct(string $question, string $answer, array $possibleAnswers)
    {
        parent::__construct($question, $answer);
        $this->possibleAnswers = $possibleAnswers;
    }

    public function getPossibleAnswers(): array
    {
        return $this->possibleAnswers;
    }

    public function setPossibleAnswers(array $possibleAnswers)
    {
        $this->possibleAnswers = $possibleAnswers;
    }

}