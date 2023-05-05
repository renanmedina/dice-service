<?php

namespace App\Classes;

class Dice {

    const DICE_STRING_PATTERN = "/([1-9]+)[dD]([0-9]+)/";

    public $faces;
    public $result;

    static function createSetFrom(String $dicesPattern) : array {
        $matches = [];
        preg_match(Dice::DICE_STRING_PATTERN, $dicesPattern, $matches);

        if (!count($matches)) {
            throw new \Exception("Invalid dices pattern");
        }

        $quantity = (int) $matches[1];
        $faces = (int) $matches[2];
        $dices = [];
        while (count($dices) < $quantity) {
            $dices[] = new Dice($faces);
        }

        return $dices;
    }

    static function rollSetFrom(String $dicesPattern) : array {
        $dices = self::createSetFrom($dicesPattern);
        return array_map(function($dice) { return $dice->roll(); }, $dices);
    }

    static function resultFrom(String $dicesPattern) : int {
        $dices = self::createSetFrom($dicesPattern);
        return array_reduce($dices, function($acc, $dice){
            return $acc + $dice->roll();
        }, 0);
    }

    public function __construct(int $faces) {
        $this->faces = $faces;
        $this->result = null;
    }

    public function roll() : int {
        $this->result = rand(1, $this->faces);
        return $this->result;
    }
}

