<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class simple extends Model
{
    public static function ruleValidation ($merge = []) {
        return array_merge ([
            'name'          =>  'required|not_space_in_string|unique:simples,name', // tên là độc nhất và không có khoảng trắng
            'note'          =>  'required|string|max:1200',
            'image'         => 'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10.000 kb
            'video'         => 'mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime|required|max:1000000', // 100mb
            'from_date'     => 'required|date|date_format:Y-m-d|after:yesterday',
            'to_date'       => 'date|date_format:Y-m-d|after:from_date',
            'from_hour'     => 'required|string',
            'to_hour'       => 'string',
            // nếu sử dụng regex thì phải có ngoặc vuông
            // 'priority'   =>  ['required', 'regex:/^-?(?:\d+|\d*\.\d+)$/', 'config_priority'],
        ], $merge);
    }

    public static function ruleValidationUpdate ($id, $merge = []) {
        return array_merge ([
            'name'          =>  'required|not_space_in_string|unique:simples,name,'.$id, // tên là độc nhất và không có khoảng trắng
            'note'          =>  'required|string|max:1200',
            'image'         => 'mimes:jpeg,jpg,png,gif|max:10000', // max 10.000 kb
            'video'         => 'mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime|max:1000000', // 100mb
            'from_date'     => 'required|date|date_format:Y-m-d|after:yesterday',
            'to_date'       => 'date|date_format:Y-m-d|after:from_date',
            'from_hour'     => 'required|string',
            'to_hour'       => 'string',
            // nếu sử dụng regex thì phải có ngoặc vuông
            // 'priority'   =>  ['required', 'regex:/^-?(?:\d+|\d*\.\d+)$/', 'config_priority'],
        ], $merge);
    }

    public static function validation ($request) {
        $messages = [
            'name.required'                  => 'The name Is Required',
            'name.not_space_in_string'       => 'The name Is not space in string',
            'name.unique'                  => 'The name Is Unique',

            'note.required'                  => 'The note Is Required',
            'note.string'                  => 'The note Is string',
            'note.max'                  => 'The note Max Is 1200',

            'image.mimes'                  => 'The image have to Image',
            'image.required'                  => 'The image Is Required',
            'image.max'                  => 'The image Max Is 10.000 kb',

            'video.mimetypes'                  => 'The video type have to video/avi,video/mpeg,video/mp4,video/quicktime',
            'video.required'                  => 'The video Is Required',
            'video.max'                  => 'The video Max Is 100.000 kb',

            'from_date.date'                  => 'The from date have to Is Date',
            'from_date.required'                  => 'The from date Is Required',
            'from_date.date_format'                  => 'The from date Format Is Y-m-d example 2018-09-09',
            'from_date.after'                  => 'The from date is Bigest Yesterday',

            'to_date.date'                  => 'The to date have to Is Date',
            'to_date.date_format'                  => 'The to date Format Is Y-m-d example 2018-09-09',
            'to_date.after'                  => 'The to date is Bigest The From Date',

            'from_hour.required'                  => 'The from hour Is Required',
            'from_hour.string'                  => 'The from hour Is string',

            'to_hour.string'                  => 'The to hour Is string',
        ];

        $validators = Validator::make($request->all(), self::ruleValidation(), $messages);

        return $validators;
    }

    public static function validationUpdate ($request, $id) {
        $messages = [
            'name.required'                  => 'The name Is Required',
            'name.not_space_in_string'       => 'The name Is not space in string',
            'name.unique'                  => 'The name Is Unique',

            'note.required'                  => 'The note Is Required',
            'note.string'                  => 'The note Is string',
            'note.max'                  => 'The note Max Is 1200',

            'image.mimes'                  => 'The image have to Image',
            'image.required'                  => 'The image Is Required',
            'image.max'                  => 'The image Max Is 10.000 kb',

            'video.mimetypes'                  => 'The video type have to video/avi,video/mpeg,video/mp4,video/quicktime',
            'video.required'                  => 'The video Is Required',
            'video.max'                  => 'The video Max Is 100.000 kb',

            'from_date.date'                  => 'The from date have to Is Date',
            'from_date.required'                  => 'The from date Is Required',
            'from_date.date_format'                  => 'The from date Format Is Y-m-d example 2018-09-09',
            'from_date.after'                  => 'The from date is Bigest Yesterday',

            'to_date.date'                  => 'The to date have to Is Date',
            'to_date.date_format'                  => 'The to date Format Is Y-m-d example 2018-09-09',
            'to_date.after'                  => 'The to date is Bigest The From Date',

            'from_hour.required'                  => 'The from hour Is Required',
            'from_hour.string'                  => 'The from hour Is string',

            'to_hour.string'                  => 'The to hour Is string',
        ];

        $validators = Validator::make($request->all(), self::ruleValidationUpdate($id), $messages);

        return $validators;
    }
}
