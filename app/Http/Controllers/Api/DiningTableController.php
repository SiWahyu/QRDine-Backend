<?php

namespace App\Http\Controllers\Api;

use App\DTOs\DiningTableData;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiningTable\StoreDiningTableRequest;
use App\Http\Requests\DiningTable\UpdateDiningTableRequest;
use App\Http\Resources\DiningTableResource;
use App\Models\DiningTable;
use App\Services\DiningTableService;
use App\Services\QrCodeService;

class DiningTableController extends Controller
{

    public function __construct(
        private DiningTableService $diningTableService,
        private QrCodeService $qrCodeService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DiningTableResource::collection(
            DiningTable::paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiningTableRequest $request)
    {
        $data = DiningTableData::fromRequest($request);

        $table = $this->diningTableService->store($data);

        return response()->json([
            'message' => 'Dining table created successfully.',
            'data' => DiningTableResource::make($table),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DiningTable $diningTable)
    {
        return DiningTableResource::make($diningTable);
    }

    public function showByToken(string $token)
    {

        $diningTable = $this->diningTableService->showByToken($token);
        return DiningTableResource::make($diningTable);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateDiningTableRequest $request,
        DiningTable $diningTable,
    ) {
        $data = DiningTableData::fromRequest($request);

        $this->diningTableService->update($diningTable, $data);

        return response()->json([
            'message' => 'Dining table updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiningTable $diningTable)
    {
        $this->diningTableService->delete($diningTable);

        return response()->json([
            'message' => 'Dining table deleted successfully.',
        ]);
    }

    // Show QRCode Table
    public function showQrCode(DiningTable $diningTable)
    {
        return $this->qrCodeService->show($diningTable);
    }

    // Download QRCode Table
    public function downloadQrCode(DiningTable $diningTable)
    {
        return $this->qrCodeService->download($diningTable);
    }
}
