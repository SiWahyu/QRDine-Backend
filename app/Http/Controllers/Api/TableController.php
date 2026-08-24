<?php

namespace App\Http\Controllers\Api;

use App\DTOs\TableData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Services\QRCodeService;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function __construct(
        private TableService $tableService,
        private QRCodeService $qrCodeService
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
     * Display the specified resource.
     */
    public function show(Table $table) {}

    public function showByToken(string $token)
    {

        $table = $this->tableService->showByToken($token);
        return TableResource::make($table);
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
