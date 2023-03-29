<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FileUpload;
use App\Http\Resources\FileUploadResource;


class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', []);
    }
    
    public function showAll(Request $request)
    {
        
        $fileupload = FileUpload::all();

        if ($request->get('related_id', 0)) {
            $fileupload = $fileupload->where('related_id', '=', $request->get('related_id'));
        }
        
        return FileUploadResource::collection($fileupload);
    }

    public function showOne($id)
    {
        return new FileUploadResource(FileUpload::find($id));
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'upload' => 'required',
        ]);
        
        $fileupload = new FileUpload;
        
        if($request->hasFile('upload')) {

            $fileName = $request->file('upload')->getClientOriginalName();
            $fileExt = $request->file('upload')->getClientOriginalExtension();

            $idFile = Str::uuid()->toString();

            $upload = $idFile . '.' . $fileExt;

            $folderUpload = '/upload/';

            $request->file('upload')->move('.' . $folderUpload, $upload);

            if ($request->name) {
                $fileupload->name=$request->name;
            } else {
                $fileupload->name=$fileName;
            }

            if ($request->related_id) {
                $fileupload->related_id=$request->related_id;
            }
            
            $fileupload->url=$folderUpload . $upload ;

            $fileupload->save();
            
            return new FileUploadResource($fileupload);
        } 

        return response()->json("Error file upload", 400);

    }


    public function delete($id)
    {
        $fileupload = FileUpload::findOrFail($id);
        
        $filePath = base_path('public') . $fileupload->url;

        if(file_exists($filePath)) {
            unlink($filePath);
        }

        $fileupload->delete();
        return response('Deleted Successfully', 200);
    }

}
