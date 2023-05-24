<?php

namespace App\Traits;

use App\Model\Image as Img;
use File;
use Image;
use Request;

trait ImageTrait
{
    public function uploadImage($dir, $input, $type = null)
    {
        $directory = storage_path('app/public' . $dir);

        if (!is_dir($directory)) {
            \File::makeDirectory($directory, $mode = 0755, true);
        }

        $fileName = uniqid() . '.' . $input->getClientOriginalExtension() ?? 'png';
        $webpFileName = str_replace($input->getClientOriginalExtension(), 'webp', $fileName);
        $image = Image::make($input);
        $image->save($directory . '/' . $fileName, 40, 'png');
        $image->encode('webp')->save($directory . '/' . $webpFileName, 40);

        return $fileName;
    }
}
