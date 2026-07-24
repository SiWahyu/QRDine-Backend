<?php

namespace App\Http\Controllers\Api;

use App\DTOs\MenuData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct(
        private MenuService $menuService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MenuResource::collection(
            Menu::with('category')->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $data = MenuData::fromRequest($request);

        $menu = $this->menuService->store($data);

        return response()->json([
            'message' => 'Menu created successfully',
            'data' => MenuResource::make($menu),
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $data = MenuData::fromRequest($request);

        $menu = $this->menuService->update($menu, $data);

        return response()->json([
            'message' => 'Menu updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->menuService->delete($menu);

        return response()->json([
            'message' => 'Menu deleted successfully',
        ]);
    }
}
