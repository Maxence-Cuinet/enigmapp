<?php

class Question
{
    private int $id;
    private string $question;
    private string $answer;

    public function __construct(string $question, string $answer)
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question)
    {
        $this->question = $question;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer)
    {
        $this->answer = $answer;
    }
}