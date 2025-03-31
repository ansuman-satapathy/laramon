<?php

namespace Ansuman\LaraMon\Http\Livewire\Components;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Card extends Component
{
    public $title;
    public $value;
    public $icon;
    public $bgColor;
    public $subtitle;
    public $trend;
    public $url;

    public function mount($title, $value, $icon = 'chart-bar', $bgColor = 'bg-blue-500', $subtitle = null, $trend = null, $url = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->bgColor = $bgColor;
        $this->subtitle = $subtitle;
        $this->trend = $trend;
        $this->url = $url;
    }

    public function render(): View
    {
        return view('laramon::livewire.components.card');
    }
}
