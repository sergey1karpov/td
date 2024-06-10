<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLists;
use App\Repositories\TagRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function __construct(private readonly TagRepository $tagRepository) {}

    public function searchByTag(User $user, UserLists $list, Request $request): View|RedirectResponse
    {
        $inputTags = $request->input('tag');

        if($inputTags == null) {
            return redirect()->back();
        }

        $tagsIds = $this->tagRepository->getInputTagIds($inputTags);

        $elementsIds = $this->tagRepository->getElementsIdsFromPivot($tagsIds);

        $elements = $this->tagRepository->getElemetsByTags($elementsIds);

        $uniqElementTags = $this->tagRepository->getAllListTags($list->elements);

        return view('list_element.filter',
            compact('user', 'list', 'elements', 'uniqElementTags', 'inputTags')
        );
    }
}
