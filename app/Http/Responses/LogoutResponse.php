<?php 

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{

    /**
     * 
     * toResponse
     * 
     */

     public function toResponse($request)
     {
        return redirect('/login');
     }
}