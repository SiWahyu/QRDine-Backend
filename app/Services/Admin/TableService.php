<?php

namespace App\Services\Admin;

use App\DTOs\TableData;
use App\Models\Table;
use Illuminate\Support\Str;

class TableService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function getAll()
    {

        return Table::query()
            ->latest()
            ->get([
                'id',
                'number',
                'token',
                'created_at'
            ]);
    }

    public function store(TableData $data): Table
    {

        return Table::create([
            'restaurant_id' => $data->restaurantId,
            'number' => $data->number,
            'token' => Str::random(32),
        ]);
    }

    public function update(
        Table $table,
        TableData $data,
    ): bool {
        return $table->update([
            'number' => $data->number,
        ]);
    }
}
