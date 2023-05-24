<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Lucky\Dices;

class DiceRoller extends Component
{
    protected $dices = [];
    public $quantity = 1;
    public $faces = 6;
    public $pattern = null;

    public function roll() {
        $this->dices = Dices::createFrom($this->pattern)->roll();
    }

    public function render()
    {
        if (empty($this->dices) && !empty($this->pattern)) {
            $this->roll();
        }

        return view('livewire.dice_roller', ['dices' => $this->dices]);
    }
}
