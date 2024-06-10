<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ImageService
{
    /**
     * Save full-size Image
     *
     * @param UploadedFile $file
     * @return string
     */
    public function uploadImage(UploadedFile $file): string
    {
        return $file->store('public');
    }

    /**
     * Create Thumbnail from full-size image
     *
     * @param UploadedFile $file
     * @param string $imagePath
     * @return string
     */
    public function createThumbnail(UploadedFile $file, string $imagePath): string
    {
        $filename = Str::random(20) . $file->getClientOriginalName();

        ImageManager::imagick()->read(storage_path('app/' . $imagePath))
            ->resize(150, 150)
            ->save(storage_path('app/public/'. $filename));

        return '/storage/' . $filename;
    }

    /**
     * Save Thumbnail in db
     *
     * @param UploadedFile $file
     * @return array
     */
    public function saveThumbnail(UploadedFile $file): array
    {
        $imagePath = $this->uploadImage($file);
        $thumbnailPath = $this->createThumbnail($file, $imagePath);
        return ['imagePath' => $imagePath, 'thumbnailPath' => $thumbnailPath];
    }
}
