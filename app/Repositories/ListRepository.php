<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserLists;

class ListRepository
{
    /**
     * Add new user list
     *
     * @param User $user
     * @param string $title
     * @param string $description
     * @return void
     */
    public function createList(User $user, string $title, string $description): void
    {
        $list = UserLists::create([
            'title' => $title,
            'description' => $description,
        ]);

        $user->lists()->attach($list);
    }
}
