<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class errorMessage extends Component
{
    public $login;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($login, $class)
    {
        //
        $this->login= $login;
        $this->class= $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error-message');
    }
}
