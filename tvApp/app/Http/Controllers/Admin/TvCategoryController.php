<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TvCategory;
use Session;

class TvCategoryController extends Controller
{
    public function index(){
    session::put('page','tvcat');

       $tvcategories = TvCategory::orderBy('id', 'DESC')->get();
        return view('admin.tv_category',compact('tvcategories'))->with('no', 1);
    }

    public function create(){
        return view('admin.tv_category_create');
    }

    public function store(Request $request){

        //Tv channel Category Validations
            $rules = [
                
                'tv_cat_name' => 'required|max:55',
                'tv_cat_image' => 'required',  
            ];
            
            $this->validate($request, $rules);

        $tvcategory= new TvCategory;
        
        
        $imageName = time().'.'.$request->tv_cat_image->extension();  
        $request->tv_cat_image->move(public_path('images/'), $imageName);

        $tvcategory->tv_cat_image = $imageName;
        $tvcategory->tv_cat_name = $request->input('tv_cat_name');

        $tvcategory->save();
        return redirect()->back()->with('message','Category Added Successfully!');
    }

    public function edit($id){
        $channeldata = TvCategory::find($id);
        return view('admin.tv_category_edit',compact('channeldata'));
    }

    public function update(Request $request,  $id){

        //Tv channel Category Validations
            $rules = [
                
                'tv_cat_name' => 'required|max:55'
            ];
            
            $this->validate($request, $rules);

            $tvcategory = TvCategory::find($id);
        
            //get old img
            $old_img = $request->input('old_image');
            
           
            if($request->tv_cat_image){
                $imageName = time().'.'.$request->tv_cat_image->extension();  
                $request->tv_cat_image->move(public_path('images/'), $imageName);

                $tvcategory->tv_cat_image = $imageName;
                // delete previous image
                $delete = unlink(public_path('images/') . "$old_img");
                $tvcategory->tv_cat_name = $request->input('tv_cat_name');
                $tvcategory->update();
            }else{
                $tvcategory->tv_cat_name = $request->input('tv_cat_name');
                $tvcategory->update();
            }
            
            return redirect('admin/tvcat-index')->with('message','Category updated successfully!');
                
    }

    public function destroy($id){
         $data = TvCategory::find($id);
         $image = unlink(public_path('images/'). $data->tv_cat_image);
         $data->delete();
         return redirect()->back()->with('message', 'Category has been deleted.');
    } 
}
