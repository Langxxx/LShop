<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/11
 * Time: 10:42
 */

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

function uploadOne($file, $dirName, $quality = 90, $thumb = array()) {

    if ($file == null) {
        return ['status' => false, 'error' => '不存在图片'];
    }
    if(!$file->isValid()){
        return ['status' => false, 'error' => '上传图片出错'];
    }
    $image = Image::make($file);

    $clientName = $file->getClientOriginalName();
    $newName = md5(date('ymdhis').$clientName) . '.' . $file ->
    getClientOriginalExtension();
    $path = 'uploads/'. $dirName .date('Y-m-d') . '/'; //DIRECTORY_SEPARATOR

    if (!File::exists($path)) {
        File::makeDirectory($path, 0755, true);
    }

    $oImage = $image->save($path . $newName, $quality);
    $ret['images'][0] = $oImage->dirname . '/' . $oImage->basename;
    //制作缩略图
    if (isset($thumb)) {
        foreach ($thumb as $k => $item) {
            $tImage = $image->resize($item[0], $item[1])->save($path . 'thumb_' . $k . $newName);
            $ret['images'][$k + 1] = $tImage->dirname . '/' . $tImage->basename;
        }
    }
    $ret['status'] = true;
    return $ret;
}

function deleteImages($images) {
//    $basePath = '/';
    foreach ($images as $image) {
        @unlink($image);
    }
}

function showImg($url, $width='', $height='') {
    $url = \Illuminate\Support\Facades\Config::get('app.url') . '/' . $url;
    if ($width){
        $width = "width='$width'";
    }
    if ($height) {
        $height = "height='$height'";
    }
    echo "<img src='$url' $width $height>";
}