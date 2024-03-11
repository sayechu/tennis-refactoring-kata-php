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
        if ($this->player1Name == $playerName) {
            $this->scorePlayer1++;
        } else {
            $this->scorePlayer2++;
        }
    }

    public function getScore(): string
    {
        $score = "";
        if (($this->scorePlayer1 >= 4 || $this->scorePlayer2 >= 4) || ($this->scorePlayer1 == 3 && $this->scorePlayer2 == 3)) {
            return $this->getAdvantageOrWinScore($this->scorePlayer1, $this->scorePlayer2);
        }

        $score = self::PLAYER_SCORES[$this->scorePlayer1];
        if ($this->scorePlayer1 == $this->scorePlayer2) {
            return $score . "-All";
        }
        return ($score . "-" . self::PLAYER_SCORES[$this->scorePlayer2]);
    }

    private function getAdvantageOrWinScore($scorePlayer1, $scorePlayer2): string {
        $scoreDifference = $scorePlayer1 - $scorePlayer2;
        if ($scoreDifference == 0) {
            return "Deuce";
        }
        if ($scoreDifference == 1 || $scoreDifference == -1) {
            return "Advantage" . " " . ($scoreDifference == 1 ? $this->player1Name : $this->player2Name);
        }
        if ($scoreDifference == 2) {
            return "Win for" . " " . $this->player1Name;
        }
        return "Win for" . " " . $this->player2Name;
    }
}

