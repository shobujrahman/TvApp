<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\TvCategory;
use App\UrlType;
use App\Country;
use App\TokenType;
use App\UserAgentType;
use App\Content;
use DB;
use Session;

class TvChannelController extends Controller
{
    public function index()
    {
        session::put('page','index');
        // $channels = TvChannel::all();
        $items = DB::table('items')
        ->leftJoin('tv_categories','items.cat_id', 'tv_categories.id')
        ->leftJoin('url_types','items.url_type', 'url_types.id')
        ->leftJoin('countries','items.cntry_id', 'countries.id')
        ->leftJoin('token_types','items.token_type', 'token_types.id')
        ->leftJoin('user_agent_types','items.agent_type', 'user_agent_types.id')
        ->select('items.*', 
                'tv_categories.tv_cat_name',
                'url_types.type_name',
                'countries.country_name',
                'token_types.token_name',
                'user_agent_types.agent_name'
        )
        ->orderBy('id', 'DESC')->get();
        return view('admin.channel_index',compact('items'))->with('no', 1);
    }

    public function create(){
        $tvcategories = TvCategory::all();
        $urltype = UrlType::all();
        $countries = Country::all();
        $tokentype = TokenType::all();
        $agenttype = UserAgentType::all();
        $contents = Content::all();
        return view('admin.channel_create',
        compact('tvcategories','urltype','countries','tokentype','agenttype','contents'));
    }

    public function store(Request $request)
    {
       
    //Channel Validations
            $rules = [
                
                'name' => 'required|max:55',
                'image' => 'required',
                'banner_image' => 'required',
                'tv_cat_name' => 'required',
                'url' => 'required',
                'type_name' => 'required',
                'country_name' => 'required'
                
            ];
            
            $this->validate($request, $rules);
              
            $chnlitem = new Item;
                
                if($request->watch_ads == 'paid'  || $request->watch_ads == 'rent' ){
                	    $rules = ['content_name' => 'required'];
                        $message=[
                	    	'content_name.required' => ' Monetization required',
                	    ];
            
                        $this->validate($request, $rules,$message);
            
                        $chnlitem->content_id = $request->input('content_name');
                        $chnlitem->subscription = $request->input('watch_ads');                  
                }
                else{
                    
                    if($request->watch_ads == 'free' || $request->watch_ads == 'yes'){
                        $chnlitem->content_id = $request->input('content_name');
                     $chnlitem->subscription = $request->input('watch_ads');
                    }
                }

                //Image
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('images/'), $imageName);
                $chnlitem->image = $imageName;
                //BannerIamge
                $bnnrImage = rand().'.'.$request->banner_image->extension(); 
                $request->banner_image->move(public_path('images/'), $bnnrImage);
                $chnlitem->banner_image = $bnnrImage;

                $chnlitem->name = $request->input('name');
                $chnlitem->cat_id = $request->input('tv_cat_name');
                $chnlitem->content_type = $request->input('content_type');
                $chnlitem->url = $request->input('url');
                $chnlitem->url_type = $request->input('type_name');
                $chnlitem->cntry_id = $request->input('country_name');
                $chnlitem->token = $request->input('token');
                $chnlitem->token_type = $request->input('token_type');
                $chnlitem->user_agent = $request->input('user_agent');
                $chnlitem->agent_type = $request->input('agent_type');
                $chnlitem->description = $request->input('description');
                
                
                $chnlitem->save();
                
                return redirect('admin/channel-index')->with('message','Channel Added Successfully!');
 
    }

    public function edit($id){
        $itemdata = Item::find($id);

        $tvcategories = TvCategory::all();
        $urltype = UrlType::all();
        $countries = Country::all();
        $tokentype = TokenType::all();
        $agenttype = UserAgentType::all();
        $contents = Content::all();
        return view('admin.channel_edit',compact('itemdata',
            'tvcategories',
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
                'tv_cat_name' => 'required',
                'url' => 'required',
                'type_name' => 'required',
                'country_name' => 'required'
                
            ];
            
            $this->validate($request, $rules);
            $chnlitem = Item::find($id);
        
            //get old img
            $old_img = $request->input('old_image');
            // Old Banner image
            $old_bnr_img = $request->input('old_banner_image');
            
            if($request->image){ 
                
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('images/'), $imageName);
                $chnlitem->image = $imageName;
                 // delete previous image
                $delete = unlink(public_path('images/') . "$old_img");
                $chnlitem->update();
            }
            else if($request->banner_image){ 
                $bnnrImage = rand().'.'.$request->banner_image->extension(); 
                $request->banner_image->move(public_path('images/'), $bnnrImage);
                $chnlitem->banner_image = $bnnrImage;
                 // delete previous image
                $delete = unlink(public_path('images/') . "$old_bnr_img");
                $chnlitem->update();
            }
            
            else if($request->watch_ads == 'paid'  || $request->watch_ads == 'rent' ){
                	
                    $rules = [ 'content_name' => 'required'];
                    $message=[
                	    	'content_name.required' => ' Monetization required',
                	    ];
            
                    $this->validate($request, $rules,$message);
            
                     $chnlitem->content_id = $request->input('content_name');
                     $chnlitem->subscription = $request->input('watch_ads');                  
            }
            
            else{
                    
                if($request->watch_ads == 'free' || $request->watch_ads == 'yes'){
                    $chnlitem->content_id = $request->input('content_name');
                    $chnlitem->subscription = $request->input('watch_ads');
                }
            }
            	
            
               

                $chnlitem->name = $request->input('name');
                $chnlitem->cat_id = $request->input('tv_cat_name');
                $chnlitem->url = $request->input('url');
                $chnlitem->url_type = $request->input('type_name');
                $chnlitem->cntry_id = $request->input('country_name');
                $chnlitem->token = $request->input('token');
                $chnlitem->token_type = $request->input('token_type');
                $chnlitem->user_agent = $request->input('user_agent');
                $chnlitem->agent_type = $request->input('agent_type');
                $chnlitem->description = $request->input('description');

                $chnlitem->update();
                
            
            return redirect('admin/channel-index')->with('message','Channel updated successfully!');
                
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
        return redirect()->back()->with('message', 'TvChannel has been deleted.');
    }
}
