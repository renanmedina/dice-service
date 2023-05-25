<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Lucky\Dices;
use App\Models\RollResultHistory;
use Illuminate\Http\Request;

class DiceRoller extends Component
{
    protected $dices = [];
    protected $history = [];

    public $pattern = null;
    public $userIp = null;

    public function roll() {
        $this->dices = Dices::createFrom($this->pattern)->roll();
        $this->registerHistory($this->dices, $this->pattern);
        $this->loadHistory();
    }

    public function render()
    {
        if (empty($this->dices) && !empty($this->pattern)) {
            $this->roll();
        }

        $this->loadHistory();
        return view('livewire.dice_roller', ['dices' => $this->dices, 'results_history' => $this->history]);
    }

    private function registerHistory(Dices $dices, string $pattern) {
        return RollResultHistory::create([
            'dice_pattern' => $pattern,
            'user_ip' => $this->userIp,
            'total_result' => $dices->totalResult(),
            'dices_results' => json_encode($dices->toJson()),
        ]);
    }

    private function loadHistory() {
        $this->history = RollResultHistory::where(['user_ip' => $this->userIp])
            ->orderBy('created_at', 'desc')
            ->offset(1)
            ->limit(100)
            ->get()
            ->all();
    }
}
