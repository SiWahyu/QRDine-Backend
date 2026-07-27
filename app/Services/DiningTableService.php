<?php

namespace App\Services;

use App\DTOs\DiningTableData;
use App\Models\DiningTable;
use Illuminate\Support\Str;

class DiningTableService
{
    public function store(DiningTableData $data): DiningTable
    {
        return DiningTable::create([
            'number' => $data->number,
            'token' => Str::random(32),
        ]);
    }

    public function update(
        DiningTable $table,
        DiningTableData $data,
    ): bool {
        return $table->update([
            'number' => $data->number,
        ]);
    }

    public function delete(
        DiningTable $table,
    ): bool {
        return $table->delete();
    }
}