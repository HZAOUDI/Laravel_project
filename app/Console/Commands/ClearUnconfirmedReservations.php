<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Location;

class ClearUnconfirmedReservations extends Command
{
    
    protected $signature = 'reservations:clear';

    
    protected $description = 'Clear unconfirmed reservations created more than 24 hours ago';

    

    public function handle()
    {
        $twentyFourHoursAgo = Carbon::now()->subHours(24);

        Location::where('status', '=', 'en attente')
            ->where('created_at', '<=', $twentyFourHoursAgo)
            ->delete();

        $this->info('Unconfirmed reservations cleared successfully!');
    }
}
