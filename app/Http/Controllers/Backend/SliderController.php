<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Trait\QueryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    use QueryTrait;
    public function AllSlider(){
        $slider = $this->getitemById(new Slider, 1);
        return view('admin.backend.slider.get_slider')->with('slider', $slider);
    }

    public function UpdateSlider(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'link' => 'nullable|url'
        ]);

        try{
                $slider = $this->getitemById(new Slider, $request->id);
                $path = $slider->image;
            if ($request->file('image')) {
                if ($slider->image && Storage::exists($slider->image)) {
                    Storage::delete($slider->image);
                }
              $path = Storage::putFile('slider', $request->file('image'));

            }

            $slider->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $path,
                'link' => $request->link,
            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('get.slider')->with($notification);
        }catch(\Exception $e){
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => $e->getMessage()
            );
            return redirect()->back()->with($notification);
        }
    }

    public function EditSlider(Request $request,$id)
    {
        $slider = $this->getitemById(new Slider , $id);
        if($request->has('title')){
            $slider->title = $request->title;
        }
        if($request->has('description')){
            $slider->description = $request->description;

        }
        $slider->save();
        return response()->json(['success'=>true]);
    }
    
}
