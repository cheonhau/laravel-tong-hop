<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\simple;
use App\Services\ImageService;

class SimpleService
{
    public function add(Request $request) {
        try {
            $simple = new simple();
        
            // upload ảnh
            $image = ''; $thumbnail = '';
            if($request->hasFile('image')) {
                $imageService = new ImageService();
                $upload = $imageService->uploadImage($request->file('image'));
                if($upload) {
                    $image = $upload['file_main'];
                    $thumbnail = $upload['file_thumb'];
                }
            }
            // upload video
            $filename_video = '';
            if ( $request->hasFile( 'video' ) ) {
                $file = $request->file('video');
                $filename_video = rand(0, 99) . $file->getClientOriginalName();
                $path = public_path() . "/uploads/";

                if (!file_exists($path) && !is_dir( $path )) { // Write folder if not exists
                    mkdir( $path, 0777, true);
                }

                $file->move( $path, $filename_video );
            }
            

            $simple->name = $request->get('name');
            $simple->note = $request->get('note');
            $simple->image = $image;
            $simple->thumbnail = $thumbnail;
            $simple->video = $filename_video;
            // $simple->thumbnail_video = $thumbnail_video;
            $simple->from_date = $request->get('from_date');
            $simple->to_date = $request->get('to_date');
            $simple->from_hour = $request->get('from_hour');
            $simple->to_hour = $request->get('to_hour');
            


            if($simple->save()) {
                return 1;
            }

            return 0;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Request $request, $id) {
        try {
            $simple = simple::find($id);
            // upload ảnh
            $image = ''; $thumbnail = '';
            // lấy thông tin ảnh cũ
            $image_old = $simple->image;
            $image_old_thumbnail = $simple->thumbnail;
            $pathUpload = 'uploads/image';
            if($request->hasFile('image')) {
                $imageService = new ImageService();
                $upload = $imageService->uploadImage($request->file('image'));
                if($upload) {
                    $image = $upload['file_main'];
                    $thumbnail = $upload['file_thumb'];
                }

                // xóa ảnh cũ
                if($image_old) {
                    unlink($pathUpload . '/' . $image_old);
                }
                if($image_old_thumbnail) {
                    unlink($pathUpload . '/' . $image_old_thumbnail);
                }
            } else {
                $image = $image_old; $thumbnail = $image_old_thumbnail;
            }
            // upload video
            // lấy thông tin video cũ
            $video_old = $simple->video;
            $filename_video = '';
            if ( $request->hasFile( 'video' ) ) {
                $file = $request->file('video');
                $filename_video = rand(0, 99) . $file->getClientOriginalName();
                $path = public_path() . "/uploads/";
                $file->move( $path, $filename_video );

                // xóa video cũ
                if($video_old) {
                    unlink( 'uploads/' . $video_old);
                }
            } else {
                $filename_video = $video_old;
            }
                

            $simple->name = $request->get('name');
            $simple->note = $request->get('note');
            $simple->image = $image;
            $simple->thumbnail = $thumbnail;
            $simple->video = $filename_video;
            // $simple->thumbnail_video = $thumbnail_video;
            $simple->from_date = $request->get('from_date');
            $simple->to_date = $request->get('to_date');
            $simple->from_hour = $request->get('from_hour');
            $simple->to_hour = $request->get('to_hour');


            if($simple->save()) {
                return 1;
            }

            return 0;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
    * xóa data : REDIRECT TỚI NHỮNG URL CỤ THỂ TỪ NHỮNG URL RÁC
    * 
    * @param interger id : id của dữ liệu cần xóa
    *
    * @throws Log không ghi lại log
    * @author HUYNH
    * @return boolean
    */

    public function remove ($id) {
        $simple = simple::findOrFail($id);
        $pathUpload = 'uploads/image';
        // lấy thông tin ảnh cũ
        $image_old = $simple->image;
        $image_old_thumbnail = $simple->thumbnail;

        // lấy thông tin video cũ
        $video_old = $simple->video;

        if($video_old) {
            unlink( 'uploads/' . $video_old);
        }

        if ( $image_old ) {
            unlink($pathUpload . '/' . $image_old);
        }

        if($image_old_thumbnail) {
            unlink($pathUpload . '/' . $image_old_thumbnail);
        }

        

        if ( $simple->delete() ) {
            return 1;
        }

        return 0;
    }

    public static function _substr($str, $length, $minword = 3)
    {
        $sub = '';
        $len = 0;
        foreach (explode(' ', $str) as $word)
        {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($word) > $minword && strlen($sub) >= $length) {
                break;
            }
        }
        return $sub . (($len < strlen($str)) ? '...' : '');
    }
    
}
