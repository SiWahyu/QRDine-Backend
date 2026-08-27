<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function getMenus()
    {
        return Menu::with('category')->get();
    }
}
