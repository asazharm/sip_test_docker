<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function index(){

        $model = new File();

        $files = $model::paginate(10);

        $response = [
            'data' => $files
        ];

        return response()->json($response);
    }

    public function upload(Request $request){


        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:4096'
        ]);

        $model = new File;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_size = $request->file('file')->getSize();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $model->name = time().'_'.$request->file->getClientOriginalName();
            $model->size = $file_size;
            $model->path = '/storage/' . $file_path;
            $model->save();

            return response()->json(['success'=>'File uploaded successfully.']);
        }
    }
}
