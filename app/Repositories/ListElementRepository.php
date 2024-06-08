<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ListElements;

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
}
