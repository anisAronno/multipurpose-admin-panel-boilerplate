<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CommonController extends Controller
{
    public function fileDelete(Request $request)
    {
        try {
            $id = $request->id;
            $table = $request->table;
            $field = $request->field;
            $result = DB::table($table)->where('id', $id)->update([$field=>null]);
            if ($result==true) {
                FileHelpers::deleteFile($request->oldFile);
                return Redirect::back()->with('message', 'Deleted successfull');
            } else {
                return Redirect::back()->with('message', 'Something went wrong!');
            }
        } catch (\Throwable $th) {
            return Redirect::back()->with('message', 'Something went wrong!');
        }
    }
}
