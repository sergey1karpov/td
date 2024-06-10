<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\ListRequest;
use App\Models\User;
use App\Models\UserLists;
use App\Repositories\ListRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserListsController extends Controller
{
    public function __construct(
        private readonly ListRepository $listRepository,
        private readonly TagRepository $tagRepository
    ) {}

    public function create(User $user): View
    {
        return view('lists.create', compact('user'));
    }

    public function store(User $user, ListRequest $request): RedirectResponse
    {
        $this->listRepository->createList($user, $request->title, $request->description);

        return redirect()->route('profile', ['user' => $user->id])->with('success', 'Список создан');
    }

    public function edit(User $user, UserLists $list): View
    {
        return view('lists.update', compact('user', 'list'));
    }

    public function update(User $user, UserLists $list, ListRequest $request): RedirectResponse
    {
        $this->listRepository->updateList($list, $request->title, $request->description);

        return redirect()->route('profile', ['user' => $user->id])->with('success', 'Список обновлен');
    }

    public function delete(User $user, UserLists $list): RedirectResponse
    {
        $list->delete();

        return redirect()->route('profile', ['user' => $user->id])->with('success', 'Список удален');
    }

    public function show(User $user, UserLists $list): View
    {
        $authUserRole = Auth::user()->role->role;

        $elements = $list->elements;

        $users = User::where('id', '<>', auth()->user()->id)->get();

        $roles = array_diff(array_column(RoleEnum::cases(), 'value'), [RoleEnum::Admin->value]);

        $uniqElementTags = $this->tagRepository->getAllListTags($list->elements);

        return view('lists.list',
            compact('user', 'list', 'elements', 'users', 'roles', 'authUserRole', 'uniqElementTags')
        );
    }
}
