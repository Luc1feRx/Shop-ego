<?php

namespace App\Http\Storage\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderStorage{
    public function insert($request){
        try{
            $request->except('_token');
            Slider::create($request->input());
            session()->flash('success', 'Thêm Slider Thành Công');
        }catch(\Exception $e){
            session()->flash('error', $e);
            return false;
        }

        return true;
    }

    public function getList(){
        return Slider::orderby('id', 'desc')->paginate(15);
    }

    public function update(Request $request, Slider $slider){
        try{
            $slider->fill($request->input());
            $slider->save();
            session()->flash('success', 'Cập Nhật Slider Thành Công');
        }catch(\Exception $e){
            session()->flash('error', $e);
            return false;
        }

        return true;
    }

    public function show(){
        return Slider::where('active', 1)->orderBy('sort_by', 'desc')->get();
    }

    public function delete(Request $request){
        $slider = Slider::where('id', $request->input('id'))->first();
        if($slider){
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }

        return false;
    }
}
