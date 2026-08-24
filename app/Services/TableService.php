<?php

namespace App\Services;

use App\DTOs\TableData;
use App\Models\Table;

class TableService
{

    public function showByToken(string $token): Table
    {
        return Table::where('token', $token)->firstOrFail();
    }


    public function delete(
        Table $table,
    ): bool {
        return $table->delete();
    }
}
