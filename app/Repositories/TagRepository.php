<?php

namespace App\Repositories;

use App\Models\ListElements;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TagRepository
{
    /**
     * Get id's from input tags
     *
     * @param array $tags
     * @return Collection
     */
    public function getInputTagIds(array $tags): Collection
    {
        return Tag::whereIn('name', $tags)->pluck('id');
    }

    /**
     * Get elements ids from relation table
     *
     * @param Collection $tagIds
     * @return Collection
     */
    public function getElementsIdsFromPivot(Collection $tagIds): Collection
    {
        return DB::table("list_elements_tag")
            ->whereIn('tag_id', $tagIds)
            ->pluck('list_element_id');
    }

    /**
     * Get all list elements by tag
     *
     * @param Collection $elementsIds
     * @return Collection
     */
    public function getElemetsByTags(Collection $elementsIds): Collection
    {
        return ListElements::whereIn('id', $elementsIds)->get();
    }

    /**
     * Get all tag from list
     *
     * @param Collection $elements
     * @return Collection
     */
    public function getAllListTags(Collection $elements): Collection
    {
        $allElements = $elements->pluck('id');

        $pivotElementsIds = DB::table("list_elements_tag")
            ->whereIn('list_element_id', $allElements)
            ->pluck('tag_id');

        return Tag::whereIn('id', $pivotElementsIds)->distinct('name')->get();
    }
}
