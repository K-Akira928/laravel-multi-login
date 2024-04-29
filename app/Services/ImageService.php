<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
  public static function upload($imageFile, $folderName)
  {
    if (is_array($imageFile)) {
      $file = $imageFile['image'];
    } else {
      $file = $imageFile;
    }

    $manager = new ImageManager(new Driver());
    $redizedImage = $manager->read($file)->resize(1920, 1080)->encode();

    $fileName = uniqid(rand() . '_');
    $extension = $file->extension();
    $fileNameToStore = $fileName . '.' . $extension;

    Storage::put('public/' . $folderName . '/' . $fileNameToStore, $redizedImage);

    return $fileNameToStore;
  }
}
