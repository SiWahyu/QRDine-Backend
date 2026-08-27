<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use App\Services\TableService;

class TableController extends Controller
{

    public function __construct(
        private TableService $tableService,
    ) {}


    public function showByToken(string $token)
    {

        $table = $this->tableService->showByToken($token);
        return TableResource::make($table);
    }
}
