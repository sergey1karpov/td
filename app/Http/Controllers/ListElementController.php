<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\ListElements;
use App\Models\ListUsers;
use App\Models\User;
use App\Models\UserLists;
use App\Repositories\ListElementRepository;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListElementController extends Controller
{
    public function __construct(
        private readonly ImageService          $imageService,
        private readonly ListElementRepository $listElementRepository)
    {}

    public function store(User $user, UserLists $list, ItemRequest $request): RedirectResponse
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

    public function edit(User $user, UserLists $list, ListElements $element): View
    {
        return view('list_element.edit', compact('user', 'list', 'element'));
    }

    public function update(User $user, UserLists $list, ListElements $element, ItemRequest $request): RedirectResponse
    {
        $this->listElementRepository->updateListItem($element, $request->description);

        if ($request->hasFile('image')) {

            $this->listElementRepository->deleteListElementImage($element->id);

            $imagePath = $this->imageService->uploadImage($request->file('image'));
            $thumbnailPath = $this->imageService->createThumbnail($request->file('image'), $imagePath);
            $this->listElementRepository->insertListItemImage($imagePath, $thumbnailPath, $element->id);
        }

        return redirect()->route('list-element.show', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id])
            ->with('success', 'Заметка обновлена!');
    }

    public function deleteImage(User $user, UserLists $list, ListElements $element): RedirectResponse
    {
        $this->listElementRepository->deleteListElementImage($element->id);

        return redirect()->route('list-element.edit', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id])
            ->with('success', 'Изображение удалено!');
    }

    public function delete(User $user, UserLists $list, ListElements $element): RedirectResponse
    {
        $element->delete();

        return redirect()->route('list.show', ['user' => $user->id, 'list' => $list->id])
            ->with('success', 'Заметка удалена!');
    }

    public function shareList(User $user, UserLists $list, Request $request): RedirectResponse
    {
        ListUsers::updateOrCreate(
            ['list_id' => $list->id, 'user_id' => $request->user_id],
            ['user_id' => $request->user_id, 'list_id' => $list->id, 'role' => $request->role]
        );

        return redirect()->route('list.show', ['user' => $user->id, 'list' => $list->id])
            ->with('success', 'Права доступа изменены');
    }
}
