<?php

namespace App\Http\Controllers\Api;

use App\DTOs\TableData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\StoreTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Services\QrCodeService;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function __construct(
        private TableService $tableService,
        private QrCodeService $qrCodeService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TableResource::collection(
            Table::paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        $data = TableData::fromRequest($request);

        $table = $this->tableService->store($data);

        return response()->json([
            'message' => 'Table created successfully.',
            'data' => TableResource::make($table),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table) {}

    public function showByToken(string $token)
    {

        $table = $this->tableService->showByToken($token);
        return TableResource::make($table);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $this->tableService->delete($table);

        return response()->json([
            'message' => 'Table deleted successfully.',
        ]);
    }

    // Show QRCode Table
    public function showQrCode(Table $table)
    {
        return $this->qrCodeService->show($table);
    }

    // Download QRCode Table
    public function downloadQrCode(Table $table)
    {
        return $this->qrCodeService->download($table);
    }
}
