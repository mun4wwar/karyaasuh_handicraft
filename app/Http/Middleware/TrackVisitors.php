<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class TrackVisitors
{
    public function handle($request, Closure $next)
    {
        $ip = Request::ip(); // Dapatkan alamat IP pengunjung
        
        // Cek apakah IP sudah tercatat hari ini
        $today = now()->toDateString();
        $visitorExists = DB::table('visitors')
            ->where('ip_address', $ip)
            ->whereDate('created_at', $today)
            ->exists();

        if (!$visitorExists) {
            // Simpan data pengunjung baru
            DB::table('visitors')->insert([
                'ip_address' => $ip,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $next($request);
    }
}
