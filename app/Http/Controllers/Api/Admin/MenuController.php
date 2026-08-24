<?php

namespace App\Http\Controllers\Api\Admin;

use App\DTOs\MenuData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Http\Resources\Admin\MenuResource;
use App\Models\Menu;
use App\Services\Admin\MenuService;

class MenuController extends Controller
{

    public function __construct(public readonly MenuService $menuService) {}

    public function index()
    {
        $menus = $this->menuService->getAll();

        return MenuResource::collection($menus);
    }

    public function store(StoreMenuRequest $request)
    {
        $data = MenuData::fromRequest($request);

        $menu = $this->menuService->store($data);

        return response()->json([
            'message' => 'Menu created successfully',
            'data' => MenuResource::make($menu),
        ])->setStatusCode(201);
    }

    public function show(Menu $menu)
    {
        return MenuResource::make($menu->load('category'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $data = MenuData::fromRequest($request);

        $menu = $this->menuService->update($menu, $data);

        return response()->json([
            'message' => 'Menu updated successfully',
        ]);
    }
}
