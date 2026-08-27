<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Services\MenuService;

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
            $this->menuService->getMenus()
        );
    }
}
