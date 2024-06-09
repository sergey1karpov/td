<?php

namespace App\Http\Controllers;

use App\Models\ListElements;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function searchByTag(User $user, UserLists $list, Request $request)
    {
        $inputTags = $request->input('tag');

        if($inputTags == null) {
            return redirect()->back();
        }

        $tags = Tag::whereIn('name', $inputTags)
            ->pluck('id');

        $elements_ids = DB::table("list_elements_tag")
            ->whereIn('tag_id', $tags)
            ->pluck('list_element_id');

        $elements = ListElements::whereIn('id', $elements_ids)->get();

        //Вывод всех тегов списка
        $allElements = $list->elements->pluck('id');
        $pivotElementsIds = DB::table("list_elements_tag")->whereIn('list_element_id', $allElements)->pluck('tag_id');
        $uniqElementTags = Tag::whereIn('id', $pivotElementsIds)->distinct('name')->get();

        return view('list_element.filter', compact('user', 'list', 'elements', 'uniqElementTags', 'inputTags'));
    }
}
