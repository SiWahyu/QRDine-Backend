<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuService
{



    public function delete(Menu $menu): bool
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        return $menu->delete();
    }
}
