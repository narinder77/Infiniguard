<?php

use Illuminate\Support\Facades\Facade;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\DzServiceProvider::class,
    Yajra\DataTables\DataTablesServiceProvider::class,
    SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,
    Maatwebsite\Excel\ExcelServiceProvider::class,
];
