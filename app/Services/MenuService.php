<?php

namespace App\Services;

use App\DTOs\MenuData;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuService
{
    public function __construct(
        private SlugService $slugService,
    ) {}

    public function store(MenuData $data): Menu
    {
        $imagePath = $data->image->store('menus', 'public');

        return Menu::create([
            'category_id' => $data->categoryId,
            'name' => $data->name,
            'slug' => $this->slugService->generate($data->name),
            'description' => $data->description,
            'price' => $data->price,
            'image' => $imagePath,
            'is_available' => $data->isAvailable,
        ]);
    }

    public function update(
        Menu $menu,
        MenuData $data,
    ): bool {

        $menuData = [
            'category_id' => $data->categoryId,
            'name' => $data->name,
            'slug' => $this->slugService->generate($data->name),
            'description' => $data->description,
            'price' => $data->price,
            'is_available' => $data->isAvailable,
        ];

        if ($data->image) {

            $imagePath = $data->image->store('menus', 'public');
            $menuData['image'] = $imagePath;

            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
        }

        return $menu->update($menuData);
    }

    public function delete(Menu $menu): bool
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        return $menu->delete();
    }
}
