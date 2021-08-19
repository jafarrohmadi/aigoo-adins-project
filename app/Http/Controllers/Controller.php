<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Controller extends
    BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $requestPhoto
     * @param $path
     * @return false|string
     */
    public function savePhoto(
        $requestPhoto,
        $path
    ) {
        $photos = [];

        foreach ($requestPhoto as $photo) {
            if ($photo != null) {
                $photos[] = $this->saveImage($photo, $path, $compress = true);
            }
        }

        return json_encode($photos);
    }

    /**
     * @param $file
     * @param $path
     * @return string
     */
    public function saveImage($file, $path, $compress = true
    ) {
        $base64 = false;
        if (preg_match('#^data:image/\w+;base64,#i', $file)) {
            $fileName = time().strtoupper(Str::random(20)).'.png';
            $paths    = public_path('img/'.$path.'/'.$fileName);
            $img      = preg_replace('#^data:image/\w+;base64,#i', '', $file);
            $img      = Image::make(base64_decode($img));
            if ($compress == true) {
                $width  = 500;
                $height = 500;
                $img->height() > $img->width() ? $img->heighten($height) : $img->widen($width);
            }

            $img->save($paths);

            $file   = asset('img/'.$path.'/'.$fileName);
            $base64 = true;
        } else {
            $fileName = time().".png";
        }


        if ($base64 == true) {
            return $fileName;
        } else {
            $path = public_path('img/'.$path.'/'.$fileName);
            if ($compress == true) {
                $width  = 500;
                $height = 500;
                $img    = Image::make($file);
                $img->height() > $img->width() ? $img->heighten($height) : $img->widen($width);
            } else {
                $img = Image::make($file);
            }

            if ($img->save($path)) {
                return $fileName;
            }
        }

    }
}
