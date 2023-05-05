<?php

namespace Lucky;

class Dice {

    private $faces;
    private $result;

    public function __construct(int $faces) {
        $this->faces = $faces;
        $this->result = null;
    }

    public function roll() : int {
        $this->result = rand(1, $this->faces);
        return $this->result;
    }

    public function getResult() : int {
        return $this->result;
    }

    public function toJson() : array {
        return [
            "1d".$this->faces => $this->getResult()
        ];
    }

}

