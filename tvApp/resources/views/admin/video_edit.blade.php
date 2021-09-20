@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Videos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/video-index') }}">Edit Video</a></li>
                        <li class="breadcrumb-item active">Edit Video</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
                <x-alert />
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Edit Video</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-remove"></i></button>
                    </div>
                </div>

                <form name="editVideoForm" id="editVideoForm" action="{{ url('admin/video-update/'.$itemdata->id) }}" method="post"
                    enctype="multipart/form-data">@csrf
                    <input type="hidden" name="old_image" value="{{$itemdata->image}}">
                    <input type="hidden" name="old_banner_image" value="{{$itemdata->banner_image}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Video Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                         value="{{$itemdata->name}}" placeholder="Enter Video Name">
                                </div>
                            </div>
                                    <!-- -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Video Category</label>
                                    <select name="video_cat_name" id="video_cat_name" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($vdocategories as $vdo)
                                        <option value="{{$vdo->id}}" <?php if($vdo->id==$itemdata->cat_id){
                                        echo "selected";
                                    } ?>>{{$vdo->video_cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                    <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image">Video Image</label>
                                    <div class="input-group">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        <br>
                                        <div>
                                            <img style="width:150px; height:150px;"
                                                src="{{asset('images/'.$itemdata->image)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="banner_image">Banner Image</label>
                                    <div class="input-group">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="banner_image" name="banner_image">
                                        </div>
                                        <br>
                                        <div>
                                            <img style="width:150px; height:150px;"
                                                src="{{asset('images/'.$itemdata->banner_image)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6"> 
                                <div class="form-group">
                                    <label>Content Type</label>
                                    <select name="content_type" id="content_type" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>    
                                        <option  value='channel' <?php if($itemdata->content_type=='channel'){
                                        echo "selected";
                                    } ?>>Channel</option>    
                                        <option  value='video' <?php if($itemdata->content_type=='video'){
                                        echo "selected";
                                    } ?>>Video</option>    
                                    </select>
                                </div> 
                            </div> 
                                <!--  -->
                            <div class="col-12 col-sm-6"> 
                                <div class="form-group">
                                    <label for="url">Video Url</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="url" name="url"
                                            value="{{$itemdata->url}}"
                                            placeholder=" https://www.youtube.com/watch?v=II2EO3">
                                    </div>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Url Type</label>
                                    <select name="url_type" id="url_type" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($urltype as $url)
                                        <option value="{{$url->id}}" <?php if($url->id==$itemdata->url_type){
                                        echo "selected";
                                    } ?>>{{$url->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select name="country_name" id="country_name" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}" <?php if($country->id==$itemdata->cntry_id){
                                        echo "selected";
                                    } ?>>{{$country->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Unlock Content</label>
                                    <select name="watch_ads" id="watch_ads" class="form-control select2"
                                        style="width: 100%;">
                                        <!-- <option disabled selected value>Select an --option</option> -->
                                        <option value='free' <?php if($itemdata->subscription=='free'){
                                        echo "selected";
                                    } ?>>Free</option>    
                                        <option value='yes' <?php if($itemdata->subscription=='yes'){
                                        echo "selected";
                                    } ?>>Watch With Ads</option>    
                                        <option value='paid' <?php if($itemdata->subscription=='paid'){
                                        echo "selected";
                                    } ?>>Subscription</option>    
                                        <option value='rent' <?php if($itemdata->subscription=='rent'){
                                        echo "selected";
                                    } ?>>Rent</option>        
                                    </select>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group" style="display: none;"  id='content'>
                                    <label>Monetization</label>
                                    <select name="content_name" id="content_name" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($contents as $content)
                                        
                                        <option value="{{$content->id}}" <?php if($content->id==$itemdata->content_id){
                                        echo "selected";
                                    } ?>>{{$content->prdct_name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4>Optional:</h4>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="token">Token</label>
                                    <input type="text" class="form-control" name="token" id="token"
                                         value="{{$itemdata->token}}" placeholder="Enter Token">
                                </div>
                            </div>
                                <!-- -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Token Type</label>
                                    <select name="token_type" id="token_type" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($tokentype as $tkntyp)
                                        <option value="{{$tkntyp->id}}" <?php if($tkntyp->id==$itemdata->token_type){
                                        echo "selected";
                                    } ?>>{{$tkntyp->token_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="user_agent">User Agent</label>
                                    <input type="text" class="form-control" name="user_agent" id="user_agent"
                                         value="{{$itemdata->user_agent}}" placeholder="Enter User Agent">
                                </div>
                            </div>
                                <!-- -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Agent Type</label>
                                    <select name="agent_type" id="agent_type" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($agenttype as $agntype)
                                        <option value="{{$agntype->id}}" <?php if($agntype->id==$itemdata->agent_type){
                                        echo "selected";
                                    } ?>>{{$agntype->agent_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- description -->
                        <br>
                        <div class="form-group">
                            <label for="description">
                                 Description
                            </label>
                            <textarea class="textarea" placeholder="Place some text here" name="description" 
                                required
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$itemdata->description}}
                            </textarea>
                        </div>
                        <!-- /.description -->
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection