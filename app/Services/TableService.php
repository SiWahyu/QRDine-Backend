<?php

namespace App\Services;

use App\Models\Table;

class TableService
{

    public function showByToken(string $token): Table
    {
        return Table::where('token', $token)->firstOrFail();
    }
}
