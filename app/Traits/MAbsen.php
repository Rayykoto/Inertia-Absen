<?php

namespace App\Traits;

use App\Models\Absensi;
use Carbon\Carbon;

trait MAbsen
{
    
    public function distance($lt1, $lon1, $lt2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lt1)) * sin(deg2rad($lt2)) + cos(deg2rad($lt1)) * cos(deg2rad($lt2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

}