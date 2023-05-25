<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RollResultHistory extends Model
{
    use HasFactory;

    public $fillable = ['dice_pattern', 'total_result', 'dices_results', 'user_ip'];

    public function dicesValuesSumString(): string {
        $results = json_decode($this->dices_results, true);
        $dicesValues = $results['dices_values'];
        return implode(" + ", $dicesValues);
    }

    public function readableTime(): string {
        $createdAt = $this->created_at;
        return $createdAt->diffForHumans();
    }
}
