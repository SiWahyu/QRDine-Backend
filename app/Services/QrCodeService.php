<?php

namespace App\Services;

use App\Models\Table;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    public function show(Table $table)
    {

        $url = config('app.frontend_url') . '/tables/' . $table->token;

        return QrCode::format('svg')->size(300)->margin(1)->generate($url);
    }
    public function download(Table $table)
    {

        $url = config('app.frontend_url') . '/tables/' . $table->token;

        $svg =  QrCode::format('svg')->size(300)->margin(1)->generate($url);

        return response($svg)
            ->header('Content-Type', 'image/svg+xml')
            ->header(
                'Content-Disposition',
                'attachment; filename="table-' . $table->number . '.svg"'
            );
    }
}
