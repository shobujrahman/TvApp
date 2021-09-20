<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use App\Item;
use DB;
use Session;

class SliderController extends Controller
{
    public function index(){
        session::put('page','slider');
        
       
        $sliders = DB::table('sliders')
        ->leftJoin('items','sliders.item_id', 'items.id')
        ->select('sliders.*', 'items.name')
        ->orderBy('id', 'DESC')->get();
        return view('admin.slider', compact('sliders'))->with('no',1);
    }

   
    public function create(){
        $items = Item::get();
        return view('admin.slidecreate',compact('items'));
    } 

     public function store(Request $request)
    {
       
            

    //Slider Validations
            $rules = [
                
                'sname' => 'required|max:55',
                'image' => 'required',
                'slider_type' => 'required',
                
            ];
            
            $this->validate($request, $rules);
              
            $slider = new Slider;

                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('images/'), $imageName);
                
            
                
                

                if($request->slider_type == 'tvChannel' && $request->chnl_name !=null){
                     $slider->sname = $request->input('sname');
                     $slider->image = $imageName;
                $slider->slider_type = $request->input('slider_type');
                $slider->item_id = $request->input('chnl_name');
                }
                elseif($request->slider_type == 'video' && $request->video_name !=null){
                    $slider->sname = $request->input('sname');
                     $slider->image = $imageName;
                $slider->slider_type = $request->input('slider_type');
                $slider->item_id = $request->input('video_name');
                }else {
                    $slider->sname = $request->input('sname');
                    return redirect()->back()->with('error','please select video or channel items!');
                }
                
                $slider->save();
                
                return redirect('admin/slider')->with('message', 'Slider added successfully!');
 
    }

    public function edit($id)
    {
       $items = Item::all();
       
        $slideEdit=DB::table('sliders')->where('id',$id)->first();
       return view('admin.slideedit',compact('slideEdit','items'));
    }

    public function update(Request $request,  $id){
            $slider = Slider::find($id);
        
            //get old img
            $old_img = $request->input('old_image');
                
                if($request->image){
                    $imageName = time().'.'.$request->image->extension();  
                    $request->image->move(public_path('images/'), $imageName);
                    $slider->image = $imageName;
                    
                    $delete = unlink(public_path('images/') . "$old_img");
                }
                else if($request->slider_type == 'tvChannel' && $request->chnl_name !=null){
                     $slider->sname = $request->input('sname');
                     $slider->slider_type = $request->input('slider_type');
                     $slider->item_id = $request->input('chnl_name');
                     
                     
                }
                elseif($request->slider_type == 'video' && $request->video_name !=null){

                    $slider->sname = $request->input('sname');
                    $slider->slider_type = $request->input('slider_type');
                    $slider->item_id = $request->input('video_name');
                }else {
                    $slider->sname = $request->input('sname');
                    return redirect()->back()->with('error','please select video or channel items!');
                }               
            $slider->update();
            return redirect('admin/slider')->with('message', 'Slider Updated successfully!');
                
    }

    public function destroy( $id){
        $data = Slider::find($id);
         $image = unlink(public_path('images/'). $data->image);
         $data->delete();
        return redirect()->back()->with('message', 'Slider has been deleted.');
    } 

}