<?php

namespace Lucky;

use Illuminate\Support\Collection;
use Lucky\Dice;

class Dices extends Collection {
    const DICES_STRING_PATTERN = "/([1-9]+)[dD]([0-9]+)/";

    private $rolled = false;

    static function createFrom(String $dicesPattern) : Dices {
        $matches = [];
        preg_match(Dices::DICES_STRING_PATTERN, $dicesPattern, $matches);

        if (!count($matches)) {
            throw new Exceptions\InvalidDicesPatternException("Invalid dices pattern");
        }

        $quantity = (int) $matches[1];
        $faces = (int) $matches[2];

        return self::createMultiple($quantity, $faces);
    }

    static function createMultiple($quantity, $faces) : Dices {
        $dices = [];
        while (count($dices) < $quantity) {
            $dices[] = new Dice($faces);
        }

        return new Dices($dices);
    }

    public function roll() {
        foreach ($this->items as $dice) {
            $dice->roll();
        }

        $this->rolled = true;
        return $this;
    }

    public function results() : array {
        return array_map(function($dice) {
            return $dice->getResult();
        }, $this->items);
    }

    public function totalResult() : int {
        if (!$this->rolled) {
            $this->roll();
        }

        return array_sum($this->results());
    }

    public function getFaces() : int {
        if (!$this->count()) {
            throw new Exceptions\EmptyDicesSetException();
        }

        return $this->first()->getFaces();
    }

    public function toJson($options = 0) : array {
        return [
            "result" => $this->totalResult(),
            "dices_results" => $this->dicesResultsJson(),
            "dices_values" => $this->dicesValuesJson()
        ];
    }

    private function dicesResultsJson() : array {
        return array_map(function($dice) {
            return $dice->toJson();
        }, $this->items);
    }

    private function dicesValuesJson() : array {
        return array_map(function($dice) {
            return $dice->getResult();
        }, $this->items);
    }
}
