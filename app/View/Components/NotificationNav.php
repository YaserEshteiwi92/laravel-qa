<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationNav extends Component
{
    public $count;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->count = Auth::user()->unreadNotifications->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.notification.nav');
    }
}
