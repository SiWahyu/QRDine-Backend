<?php

namespace App\Http\Controllers\Api;

use App\DTOs\MenuData;
use App\Http\Controllers\Controller;
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
