<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Models\User;
use App\Models\UserLists;
use App\Repositories\ListRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserListsController extends Controller
{
    public function __construct(private readonly ListRepository $listRepository) {}

    public function create(User $user): View
    {
        return view('lists.create', compact('user'));
    }

    public function store(User $user, ListRequest $request): RedirectResponse
    {
        $this->listRepository->createList($user, $request->title, $request->description);

        return redirect()->back()->with('success', 'List created');
    }

    public function edit(User $user, UserLists $list): View
    {
        return view('lists.update', compact('user', 'list'));
    }

    public function update(User $user, UserLists $list, ListRequest $request): RedirectResponse
    {
        $this->listRepository->updateList($list, $request->title, $request->description);

        return redirect()->back()->with('success', $user->name . ', you have successfully updated the list: ' . $list->title);
    }
}
