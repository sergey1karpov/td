<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ListElements;
use App\Models\ListUsers;
use App\Models\Tag;

class ListElementRepository
{
    /**
     * Save Image and Thumbnail
     *
     * @param string $imagePath
     * @param string $thumbnail
     * @param int $element_id
     * @return void
     */
    public function insertListItemImage(string $imagePath, string $thumbnail, int $element_id): void
    {
        Image::create([
            'image' => str_replace('public/', '/storage/', $imagePath),
            'thumbnail' => $thumbnail,
            'list_element_id' => $element_id
        ]);
    }

    /**
     * Update list item
     *
     * @param ListElements $element
     * @param string $description
     * @return void
     */
    public function updateListItem(ListElements $element, string $description): void
    {
        $element->update(['description' => $description]);
    }

    /**
     * Delete Image
     *
     * @param int $element_id
     * @return void
     */
    public function deleteListElementImage(int $element_id): void
    {
        Image::where('list_element_id', $element_id)->delete();
    }

    /**
     * Save list element tags
     *
     * @param string $tags
     * @param ListElements $element
     * @return void
     */
    public function saveListElementTags(string $tags, ListElements $element): void
    {
        $clearTagString = str_replace(" ", "", $tags);
        $tagArray = explode(",", $clearTagString);

        foreach ($tagArray as $tag) {
            $tagObj = Tag::create(['name' => $tag]);
            $element->tags()->attach($tagObj);
        }
    }

    /**
     * Share list for users
     *
     * @param int $list_id
     * @param int $user_id
     * @param string $role
     * @return void
     */
    public function shareList(int $list_id, int $user_id, string $role): void
    {
        ListUsers::updateOrCreate(
            ['list_id' => $list_id, 'user_id' => $user_id],
            ['user_id' => $user_id, 'list_id' => $list_id, 'role' => $role]
        );
    }
}
