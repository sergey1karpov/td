<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\ListElements;
use App\Models\User;
use App\Models\UserLists;
use App\Repositories\ListElementRepository;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ListElementController extends Controller
{
    public function __construct(
        private readonly ImageService          $imageService,
        private readonly ListElementRepository $listElementRepository)
    {}

    public function store(User $user, UserLists $list, ImageRequest $request): RedirectResponse
    {
        $element = $list->elements()->create([
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->imageService->uploadImage($request->file('image'));

            $thumbnailPath = $this->imageService->createThumbnail($request->file('image'), $imagePath);

            $this->listElementRepository->insertListItemImage($imagePath, $thumbnailPath, $element->id);
        }

        return redirect()->route('list.show', ['user' => $user, 'list' => $list])->with('success', 'List Item created');
    }

    public function show(User $user, UserLists $list, ListElements $element): View
    {
        return view('list_element.show-element', compact('user', 'list', 'element'));
    }
}
