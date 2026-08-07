<?php

namespace App\Services;

use App\DTOs\TableData;
use App\Models\Table;
use Illuminate\Support\Str;

class TableService
{
    public function store(TableData $data): Table
    {

        return Table::create([
            'restaurant_id' => $data->restaurantId,
            'number' => $data->number,
            'token' => Str::random(32),
        ]);
    }

    public function showByToken(string $token): Table
    {
        return Table::where('token', $token)->firstOrFail();
    }

    public function update(
        Table $table,
        TableData $data,
    ): bool {
        return $table->update([
            'number' => $data->number,
        ]);
    }

    public function delete(
        Table $table,
    ): bool {
        return $table->delete();
    }
}
