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
        
        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0755, true);
        }
        
        $path = public_path('qrcodes/early-access-qr.svg');
        
        // Generăm SVG-ul
        QrCode::size(300)
              ->format('svg')
              ->style('square') // stil mai clar pentru scanare
              ->errorCorrection('H') // nivel înalt de corecție a erorilor
              ->generate($url, $path);
              
        $this->info("QR code generat în: " . $path);
        $this->info("URL: " . $url);
        
        if (file_exists($path)) {
            $this->info("QR code generat cu succes!");
            $this->info("Îl poți găsi la: " . url('qrcodes/early-access-qr.svg'));
        } else {
            $this->error("A apărut o eroare la generarea QR code-ului!");
        }
    }
}