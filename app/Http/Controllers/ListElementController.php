<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLists;
use Illuminate\Http\Request;

class ListElementController extends Controller
{
    //Update
    public function store(User $user, UserLists $list, Request $request)
    {
        $list->elements()->create([
            'description' => $request->description,
        ]);

        return redirect()->back();
    }
}
