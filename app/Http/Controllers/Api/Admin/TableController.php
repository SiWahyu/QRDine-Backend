<?php

namespace App\Http\Controllers\Api\Admin;

use App\DTOs\TableData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\StoreTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Http\Resources\Admin\TableResource;
use App\Models\Table;
use App\Services\Admin\TableService;

class TableController extends Controller
{

    public function __construct(private TableService $tableService) {}

    public function index()
    {

        $tables = $this->tableService->getAll();

        return TableResource::collection($tables);
    }

    public function store(StoreTableRequest $request)
    {
        $data = TableData::fromRequest($request);

        $table = $this->tableService->store($data);

        return response()->json([
            'message' => 'Table created successfully.',
            'data' => TableResource::make($table),
        ], 201);
    }

    public function show(Table $table)
    {

        return TableResource::make($table);
    }

    public function update(
        UpdateTableRequest $request,
        Table $table,
    ) {
        $data = TableData::fromRequest($request);

        $this->tableService->update($table, $data);

        return response()->json([
            'message' => 'Table updated successfully.',
        ]);
    }
}