<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Storage;

class CommonController extends Controller
{
    public static function imageUpload($slug = true, $image_name = false, $image, $directory, $size = ['width' => null, 'height' => null], $old_image = null)
    {
        $currentDate = Carbon::now()->toDateString();

        if ($slug){
            $image_name = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        }

        // check is exits directory
        if (!Storage::disk('public')->exists($directory)){

            Storage::disk('public')->makeDirectory($directory);
        }

        // resize image for upload
        $resized_image = Image::make($image)->resize($size['width'], $size['height'])->stream();
        Storage::disk('public')->put($directory.'/'.$image_name, $resized_image);

        if ($old_image){
            self::deleteImage($directory, $old_image);
        }

        return $image_name;
    }

    public static function deleteImage($directory, $image_name){

        if (Storage::disk('public')->exists($directory.'/'.$image_name)){

            Storage::disk('public')->delete($directory.'/'.$image_name);
        }
    }
}
