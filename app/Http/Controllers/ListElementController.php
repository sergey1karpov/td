<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Models\UserLists;
use Illuminate\Http\Request;

class ListElementController extends Controller
{
    //Update
    public function store(User $user, UserLists $list, Request $request)
    {
        $element = $list->elements()->create([
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            //Сохр в бд
            $path = $request->file('image')->store('uploads/images');

            Image::create([
                'image' => $path,
                'thumbnail' => 'Zagluska',
                'list_element_id' => $element->id
            ]);
        }

        return redirect()->back();
    }
}
