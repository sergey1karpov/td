<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function profile(User $user): View
    {
        return view('profile.profile', [
            'user' => $user,
            'lists' => $user->lists
        ]);
    }
}
