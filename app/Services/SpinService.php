<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class SpinService
{
    public function spin()
    {
        $random = rand(1, 1000);

        $win = $this->checkIfWinner($random);

        $prize = $this->getPrize($random, $win);

        $spin = auth()->user()->spins()->create([
            'result' => $random,
            'prize' => $prize,
            'win' => $win
        ]);

        return $spin;
    }

    private function checkIfWinner(int $digit): bool
    {
        if ($digit % 2 == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPrize(int $digit, bool $win): float
    {
        if (!$win) {
            return 0;
        }

        switch ($digit) {
            case $digit > 900:
                return $digit * 0.7;

            case $digit > 600:
                return $digit * 0.5;

            case $digit > 300:
                return $digit * 0.3;

            case $digit <= 300:
                return $digit * 0.1;

            default:
                return 0;
        }
    }
}
