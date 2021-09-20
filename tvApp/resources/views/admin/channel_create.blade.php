@extends('layouts.admin_layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tv Channels</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/channel-index') }}">Tv Channels</a></li>
                        <li class="breadcrumb-item active">Add Channel</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
                <x-alert />
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Channel</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <form name="channelForm" id="channelForm" action="{{ url('admin/channel-submit') }}" method="post"
                    enctype="multipart/form-data">@csrf
                    <div class="card-body">
                        <!-- 1st row -->
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Channel Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                         value="{{ old('name') }}" placeholder="Enter Channel Name">
                                </div>
                            </div>
                                    <!-- -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Channel Category</label>
                                    <select name="tv_cat_name" id="tv_cat_name" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($tvcategories as $tv)
                                        <option value="{{$tv->id}}">{{$tv->tv_cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                    <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="image">Channel Image</label>
                                    <div class="input-group">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="image" name="image">
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
                                        <option  value='channel' selected>Channel</option>    
                                        <option disabled value='video'>Video</option>    
                                    </select>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6"> 
                                <div class="form-group">
                                    <label for="url">Channel Url</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="url" name="url"
                                            value="{{ old('url') }}"
                                            placeholder=" https://www.youtube.com/watch?v=II2EO3">
                                    </div>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Url Type</label>
                                    <select name="type_name" id="type_name" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select an --option</option>
                                        @foreach($urltype as $url)
                                        <option value="{{$url->id}}">{{$url->type_name}}</option>
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
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
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
                                        <option value='free'>Free</option> 
                                        <option value='yes'>Watch with Ads</option>    
                                        <option value='paid'>Subscription</option>
                                        <option value='rent'>Rent</option>     
                                          
                                    </select>
                                </div>
                            </div>
                                <!--  -->
                                
                            <div class="col-12 col-sm-6">
                                <div class="form-group" style="display: none;"  id='content'>
                                    <label>Monetization</label>
                                    <select name="content_name" id="content_name" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected value>Select Price</option>
                                        @foreach($contents as $content)
                                        
                                        <option value="{{$content->id}}">{{$content->prdct_name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <br>
                        <h4>Optional:</h4>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="token">Token</label>
                                    <input type="text" class="form-control" name="token" id="token" value="{{ old('token') }}" placeholder="Enter Token">
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
                                        <option value="{{$tkntyp->id}}">{{$tkntyp->token_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <!--  -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="user_agent">User Agent</label>
                                    <input type="text" class="form-control" name="user_agent" id="user_agent"
                                        value="{{ old('user_agent') }}" placeholder="Enter User Agent">
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
                                        <option value="{{$agntype->id}}">{{$agntype->agent_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>           
                        <!--  -->
                        <div class="form-group">
                            <label for="description">
                                 Description
                            </label>
                            <textarea class="textarea" placeholder="Place some text here" name="description" 
                                required
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{Request::old('description')}}
                            </textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection