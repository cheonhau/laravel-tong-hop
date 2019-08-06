<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Storage;

class ImageService {
    public function uploadImage($request_file, $path = 'uploads/image/')
	{
		try
		{
            ini_set('memory_limit','256M');
            // Tạo tên cho file
			$imageFileName 	= time() . rand(1, 10000) . '.' . $request_file->getClientOriginalExtension();
			// đường dẫn cuối cùng của file
			$filePath 		= $path . $imageFileName;
			// Modify: nếu file > 1MB sẽ tự động resize ảnh
			$fileSize  = $request_file->getClientSize();
            $limitSize = 1048576; // this unit is Byte = 1 MB.
            $resizeImg 	= \Image::make($request_file);
            // $resizeImg->save($filePath);
            list($width, $height) 	= getimagesize($request_file);
            $sizeResize = 1080;
			if ($fileSize > $limitSize || $width >= $sizeResize || $height >= $sizeResize) {
                
				if ($width > $height && $width >= $sizeResize) {
					// Resize with width is 1920px
					$resizeImg->resize($sizeResize, null, function ($constraint) {
					    $constraint->aspectRatio();
					});
				} else if ($height > $width && $height >= $sizeResize) {
					// Resize with height is 1920px
					$resizeImg->resize(null, $sizeResize, function ($constraint) {
					    $constraint->aspectRatio();
					});
                }
                
            }
            // bắt đầu upload file
            $resizeImg->save($filePath);
            
            // Tạo thumbnail
            //---------------------------------------
            $filePathThumb 	= $path . '_thumb_' . $imageFileName;
            $imageThumb 	= \Image::make($request_file);
            // $imageThumb->save($filePathThumb);
             $imgSize 	= getimagesize($request_file);
             $width 	= $imgSize[0];
             $height 	= $imgSize[1];

             $x = 0;
             $y = 0;
             if($width<$height) {
                 $cropsize = $width;
                 $y        = intval(($height-$width)/2);
             }else{
                 $cropsize = $height;
                 $x        = intval(($width-$height)/2);
             }

             $thumnailHeight = 400;
             $thumbnailWidth = 400;

             // crop & resize image
             
             //$imageThumb    = $imageThumb->stream();
             $imageThumb->crop($cropsize, $cropsize, $x, $y);
             $imageThumb->resize($thumnailHeight, $thumbnailWidth);
             $imageThumb->save($filePathThumb);

             $file_result = array(
                 'file_main'    => $imageFileName,
                 'file_thumb'   => '_thumb_' . $imageFileName
             );

			return $file_result ;
		} catch(\Exception $e)
		{
            dd($e);
			// echo $e->getMessage();
		}
    }
    public function uploadVideo($request_file, $path = 'uploads/image/')
	{
		try
		{
            // Tạo tên cho file
			$imageFileName 	= time() . rand(1, 10000) . '.' . $request_file->getClientOriginalExtension();
			// đường dẫn cuối cùng của file
            $filePath 		= $path . $imageFileName;
            // resize video

			
            
            // bắt đầu upload file
            $resizeImg->save($filePath);
            
            // Tạo thumbnail
            //---------------------------------------
            

             $file_result = array(
                 'file_main'    => $imageFileName,
                 'file_thumb'   => '_thumb_' . $imageFileName
             );

			return $file_result ;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
    }
}