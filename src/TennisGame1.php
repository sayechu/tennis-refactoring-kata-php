<?php

namespace Feature;

class TennisGame1 implements TennisGame
{
    private int $scorePlayer1 = 0;
    private int $scorePlayer2 = 0;
    private string $player1Name;
    private string $player2Name;
    private const PLAYER_SCORES = ["Love", "Fifteen", "Thirty", "Forty"];

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName): void
    {
        if ($this->player1Name == $playerName)
        {
            $this->scorePlayer1++;
        } else {
            $this->scorePlayer2++;
        }
    }

    public function getScore(): string
    {
        $score = "";
        if ($this->isAdvantageDeuceOrWinner($this->scorePlayer1, $this->scorePlayer2))
        {
            return $this->getAdvantageOrWinScore($this->scorePlayer1, $this->scorePlayer2);
        }

        $score = self::PLAYER_SCORES[$this->scorePlayer1];
        if ($this->scorePlayer1 == $this->scorePlayer2)
        {
            return $score . "-All";
        }
        return ($score . "-" . self::PLAYER_SCORES[$this->scorePlayer2]);
    }

    private function getAdvantageOrWinScore($scorePlayer1, $scorePlayer2): string
    {
        $scoreDifference = $scorePlayer1 - $scorePlayer2;
        if ($this->isDeuce($scoreDifference))
        {
            return "Deuce";
        }
        if ($this->isAdvantage(($scoreDifference)))
        {
            return "Advantage" . " " . ($scoreDifference == 1 ? $this->player1Name : $this->player2Name);
        }
        if ($this->isThereAWinner($scoreDifference))
        {
            return "Win for" . " " . $this->player1Name;
        }
        return "Win for" . " " . $this->player2Name;
    }

    private function isAdvantage($scoreDifference): bool
    {
        if (abs($scoreDifference) == 1)
        {
            return true;
        }
        return false;
    }

    private function isThereAWinner($scoreDifference): bool
    {
        if ($scoreDifference >= 2)
        {
            return true;
        }
        return false;
    }

    private function isDeuce($scoreDifference): bool
    {
        if ($scoreDifference == 0)
        {
            return true;
        }
        return false;
    }

    private function isAdvantageDeuceOrWinner(int $scorePlayer1, int $scorePlayer2): bool
    {
        if (($scorePlayer1 >= 4 || $scorePlayer2 >= 4) || ($scorePlayer1 == 3 && $scorePlayer2 == 3))
        {
            return true;
        }
        return false;
    }
}

