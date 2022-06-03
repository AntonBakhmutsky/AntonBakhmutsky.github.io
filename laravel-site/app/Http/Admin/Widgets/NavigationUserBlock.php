<?php

namespace App\Http\Admin\Widgets;

use AdminTemplate;
use SleepingOwl\Admin\Widgets\Widget;

class NavigationUserBlock extends Widget
{
    public function toHtml(): string
    {
        return view('admin.navbar', [
            'user' => auth()->user()
        ])->render();
    }

    public function template(): array|string
    {
        return AdminTemplate::getViewPath('_partials.header');
    }

    public function block(): string
    {
        return 'navbar.right';
    }
}
