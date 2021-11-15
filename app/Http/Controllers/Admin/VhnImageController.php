<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class VhnImageController
{
    public function saveImg($request,$link,$date) {
        $image = $request->avatar;
        $name_image = 'admin_'.strtotime($date);
        $avatar  = NULL;
        if (strlen($image) >= 100){
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $name_image . '.jpg';

            Storage::disk('public')->put(storage_link($link,$date).$imageName, base64_decode($image));
            $avatar = $imageName;
        }else{
            $avatar = $request->avatar;
        }
        if ($image == "default") {
            Storage::disk('public')->delete(storage_link($link,$date).$name_image. '.jpg');
            $avatar = NULL;
        }
        return $avatar;
    }
    public function saveFile($request,$link,$date) {
        $file_hidden = $request->file_hidden;
        $file = NULL;
        if ($request->file('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('phieu', date_img($date).'/phieu_'.strtotime($date).$filename, 'public');
            $file = 'phieu_'.strtotime($date).$filename;
        }else{
            $file = $file_hidden;
        }
        if ($file_hidden == "default") {
            Storage::disk('public')->delete(storage_link($link,$date).$file_hidden);
            $file = NULL;
        }
        return $file;
    }
    public function saveImgProduct($request,$link,$date) {
        $image_hidden = $request->image_hidden;
        $image = NULL;
        if ($request->file('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('product', date_img($date).'/product_'.strtotime($date).$filename, 'public');
            $image = 'product_'.strtotime($date).$filename;
        }else{
            $image = $image_hidden;
        }
        if ($image_hidden == "default") {
            Storage::disk('public')->delete(storage_link($link,$date).$image_hidden);
            $image = NULL;
        }
        return $image;
    }
    public function saveImgLocation($request,$link,$date) {
        $image_hidden = $request->location_image_hidden;
        $image = NULL;
        if ($request->file('location_image')) {
            $filename = $request->file('location_image')->getClientOriginalName();
            $request->file('location_image')->storeAs('location', date_img($date).'/location_'.strtotime($date).$filename, 'public');
            $image = 'location_'.strtotime($date).$filename;
        }else{
            $image = $image_hidden;
        }
        if ($image_hidden == "default") {
            Storage::disk('public')->delete(storage_link($link,$date).$image_hidden);
            $image = NULL;
        }
        return $image;
    }

}

