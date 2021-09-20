<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\VideoCategory;
use App\UrlType;
use App\Country;
use App\TokenType;
use App\UserAgentType;
use App\Content;
use DB;
use Session;

class VideoController extends Controller
{
    public function index()
    {
        session::put('page','video');
        $videos = DB::table('items')
        ->leftJoin('video_categories','items.cat_id', 'video_categories.id')
        ->leftJoin('url_types','items.url_type', 'url_types.id')
        ->leftJoin('countries','items.cntry_id', 'countries.id')
        ->leftJoin('token_types','items.token_type', 'token_types.id')
        ->leftJoin('user_agent_types','items.agent_type', 'user_agent_types.id')
        ->select('items.*', 
                'video_categories.video_cat_name',
                'url_types.type_name',
                'countries.country_name',
                'token_types.token_name',
                'user_agent_types.agent_name'
        )
        ->orderBy('id', 'DESC')->get();
        return view('admin.video_index',compact('videos'))->with('no', 1);
    }

    public function create(){
        $vdocategories = VideoCategory::all();
        $urltype = UrlType::all();
        $countries = Country::all();
        $tokentype = TokenType::all();
        $agenttype = UserAgentType::all();
        $contents = Content::all();

        return view('admin.video_create',
        compact('vdocategories','urltype','countries','tokentype','agenttype','contents'));
        
    }

    public function store(Request $request)
    {
       
    //Video Validations
            $rules = [
                
                'name' => 'required|max:55',
                'image' => 'required',
                'banner_image'=>'required',
                'video_cat_name' => 'required',
                'url' => 'required',
                'url_type' => 'required',
                'country_name'=> 'required'
                
                
            ];
            
            $this->validate($request, $rules);
              
            $video = new Item;

                

             if($request->watch_ads == 'paid'  || $request->watch_ads == 'rent' ){
                	    $rules = ['content_name' => 'required'];

                	    $message=[
                	    	'content_name.required' => ' Monetization required',
                	    ];
            
                        $this->validate($request, $rules,$message);
            
                        $video->content_id = $request->input('content_name');
                        $video->subscription = $request->input('watch_ads');                  
                }
                else{
                    
                    if($request->watch_ads == 'free' || $request->watch_ads == 'yes'){
                        $video->content_id = $request->input('content_name');
                     	$video->subscription = $request->input('watch_ads');
                    }
                }

                //image
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('images/'), $imageName);
                $video->image = $imageName;
                //bannerImage
                $bnnrImage = rand().'.'.$request->banner_image->extension(); 
                $request->banner_image->move(public_path('images/'), $bnnrImage);
                $video->banner_image = $bnnrImage;
            
                $video->name = $request->input('name');
                $video->cat_id = $request->input('video_cat_name');
                $video->url = $request->input('url');
                $video->url_type = $request->input('url_type');
                $video->cntry_id = $request->input('country_name');
                $video->content_type = $request->input('content_type');
                $video->token = $request->input('token');
                $video->token_type = $request->input('token_type');
                $video->user_agent = $request->input('user_agent');
                $video->agent_type = $request->input('agent_type');
                // $video->watch_ads = $request->input('watch_ads');
                // $video->subscription = $request->input('subscription');
                $video->description = $request->input('description');
                
                
                $video->save();
                
                return redirect('admin/video-index')->with('message','Video Added Successfully!');
 
    }
    public function edit($id){
        $itemdata = Item::find($id);

        $vdocategories = VideoCategory::all();
        $urltype = UrlType::all();
        $countries = Country::all();
        $tokentype = TokenType::all();
        $agenttype = UserAgentType::all();
         $contents = Content::all();
        return view('admin.video_edit',compact('itemdata',
            'vdocategories',
            'urltype',
            'countries',
            'tokentype',
            'agenttype',
            'contents'
            ));
    }

     public function update(Request $request,  $id){

         $rules = [
                
               'name' => 'required|max:55',
                'video_cat_name' => 'required',
                'url' => 'required',
                'url_type' => 'required',
                'country_name'=> 'required'
                
            ];
            
            $this->validate($request, $rules);
            $video = Item::find($id);
        
            //get old img
            $old_img = $request->input('old_image');
            //old Banner Image
            $old_bnr_img = $request->input('old_banner_image');
            
            if($request->image){ 
                
                 $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('images/'), $imageName);
                $video->image = $imageName;
                 // delete previous image
                $delete = unlink(public_path('images/') . "$old_img");
                $video->update();
            }
               else if($request->banner_image){ 
                $bnnrImage = rand().'.'.$request->banner_image->extension(); 
                $request->banner_image->move(public_path('images/'), $bnnrImage);
                $video->banner_image = $bnnrImage;
                 // delete previous image
                $delete = unlink(public_path('images/') . "$old_bnr_img");
                $video->update();
            }
            else if($request->watch_ads == 'paid'  || $request->watch_ads == 'rent' ){
                	
                    $rules = [ 'content_name' => 'required'];
                    $message=[
                	    	'content_name.required' => ' Monetization required',
                	    ];
            
                    $this->validate($request, $rules,$message);
            
                     $video->content_id = $request->input('content_name');
                     $video->subscription = $request->input('watch_ads');                  
            }
            
            else{
                    
                if($request->watch_ads == 'free' || $request->watch_ads == 'yes'){
                    $video->content_id = $request->input('content_name');
                    $video->subscription = $request->input('watch_ads');
                }
            }


                $video->name = $request->input('name');            
                $video->cat_id = $request->input('video_cat_name');
                $video->url = $request->input('url');
                $video->url_type = $request->input('url_type');
                $video->cntry_id = $request->input('country_name');
                $video->token = $request->input('token');
                $video->token_type = $request->input('token_type');
                $video->user_agent = $request->input('user_agent');
                $video->agent_type = $request->input('agent_type');
                // $video->watch_ads = $request->input('watch_ads');
                // $video->subscription = $request->input('subscription');
                $video->description = $request->input('description');

                $video->update();
                
            
            return redirect('admin/video-index')->with('message','Video updated successfully!');
                
    }

    public function destroy($id){
        $data = Item::find($id);
            $image = public_path('images/'. $data->image);
            $image2 = public_path('images/'. $data->banner_image);
            if(file_exists($image)){
                @unlink($image);
            }
            if(file_exists($image2)){
                @unlink($image2);
            }
         $data->delete();
        return redirect()->back()->with('message', 'Video has been deleted.');
    } 
}
