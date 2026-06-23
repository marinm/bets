<?php

namespace App\View\Components;

use App\Models\Bet;
use App\Models\Fixture;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BetResultIcon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Fixture $fixture,
        public ?Bet $bet,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bet-result-icon');
    }
}
