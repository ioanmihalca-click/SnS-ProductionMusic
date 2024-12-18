<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateEarlyAccessQr extends Command
{
    protected $signature = 'early-access:qr';
    protected $description = 'Generează QR code pentru early access';

    public function handle()
    {
        $url = url("/early-access/" . config('early-access.token'));
        
        // Generează QR code-ul
        QrCode::size(300)
              ->generate($url, storage_path('app/early-access-qr.png'));
              
        $this->info("QR code generat în storage/app/early-access-qr.png");
        $this->info("URL: " . $url);
    }
}