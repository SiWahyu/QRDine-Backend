<?php

namespace App\Services;

use App\Models\DiningTable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    public function show(DiningTable $diningTable)
    {

        $url = config('app.frontend_url') . '/tables/' . $diningTable->token;

        return QrCode::format('svg')->size(300)->margin(1)->generate($url);
    }
    public function download(DiningTable $diningTable)
    {

        $url = config('app.frontend_url') . '/tables/' . $diningTable->token;

        $svg =  QrCode::format('svg')->size(300)->margin(1)->generate($url);

        return response($svg)
            ->header('Content-Type', 'image/svg+xml')
            ->header(
                'Content-Disposition',
                'attachment; filename="table-' . $diningTable->number . '.svg"'
            );
    }
}
