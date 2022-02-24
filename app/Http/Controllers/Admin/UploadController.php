<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Storage\Upload\UploadStorage;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $upload;

    public function __construct(UploadStorage $uploadStorage){
        $this->upload = $uploadStorage;
    }

    public function store(Request $request){
        $url = $this->upload->store($request);
        if($url != false){
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

}
