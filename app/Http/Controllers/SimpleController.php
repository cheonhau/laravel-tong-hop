<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\simple;
use App\Services\SimpleService;
use Illuminate\Support\Facades\Redirect;

class SimpleController extends Controller
{
    public function index () {
        // https://github.com/PHP-FFMpeg/PHP-FFMpeg
        // $ffmpeg = \FFMpeg\FFMpeg::create();
        // $video = $ffmpeg->open('uploads/1.mp4');

        // $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10))
        // ->save('uploads/frame.jpg');

        $simples = simple::all();

        return View('simple.index')->with('simples', $simples);
    }

    public function create(Request $request) {
        try {
            if( $request->isMethod('post') ) {
                // validation 
                $modelConfig = new simple();
                $validation = $modelConfig->validation($request);
                
                if($validation->fails()) {
                    return Redirect::back()->withInput()->withErrors($validation->messages());
                }
                
                // add vào database
                $simpleService = new SimpleService();
                $save = $simpleService->add($request);
                // nếu thành công di chuyển ra trang list
                if ($save) {
                    return Redirect::to('simple')->with('message', \Lang::get('message.success'));
                }
    
                // nếu trường hợp lỗi add vào database
                return Redirect::back()->withInput()->withErrors(['redirect' => \Lang::get('message.delete_not_success')]);
            }
    
            return View('simple.add');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Request $request, $id) {
        try {
            $simple = simple::findOrFail($id);

            if( $request->isMethod('post') ) {
                $result = '';
                // validation 
                $modelConfig = new simple();
                $validation = $modelConfig->validationUpdate($request, $id);
                
                if($validation->fails()) {
                    return Redirect::back()->withInput()->withErrors($validation->messages());
                }
                
                // add vào database
                $simpleService = new SimpleService();
                $save = $simpleService->edit($request, $id);
                // nếu thành công di chuyển ra trang list
                if ($save) {
                    return Redirect::to('simple')->with('message', \Lang::get('message.success'));
                }
    
                // nếu trường hợp lỗi add vào database
                return Redirect::back()->withInput()->withErrors(['redirect' => \Lang::get('message.delete_not_success')]);
            }

            return View('simple.edit')->with('simple', $simple);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete ( $id ) {
        $simpleService = new SimpleService();
        $remove = $simpleService->remove($id);
        if ( $remove ) {
            return Redirect::back()->with('message', \Lang::get('message.success'));
        }

        return Redirect::back()->withInput()->withErrors(['redirect' => \Lang::get('message.delete_not_success')]);
    }

    public function paginate () {
        $simples = simple::paginate(1);

        return View('simple.paginate', ['simples' => $simples]);
    }
}
