<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userContract()
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->type = 'normal';

        return response()->format(
            'This is your contract', 
            'Type, from and end date', 
            [$user->type, $user->contract]
        );
    }


}
