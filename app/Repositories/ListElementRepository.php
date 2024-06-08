<?php

namespace App\Repositories;

use App\Models\Image;

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
}
