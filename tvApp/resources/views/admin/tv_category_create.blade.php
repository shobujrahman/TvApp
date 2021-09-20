@extends('layouts.admin_layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tv Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/tvcat-index') }}">Tv Category</a></li>
            <li class="breadcrumb-item active">Add Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center mt-5">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Category</h3>
              </div>
              <br>
              <x-alert/>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="categoryForm" id="categoryForm"  action="{{ url('admin/tvcat-submit') }}"   method="post" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="tv_cat_name">Category Name</label>
                    <input type="text" class="form-control" id="tv_cat_name" name="tv_cat_name" value="{{ old('tv_cat_name') }}" placeholder="Enter Category Name" >
                  </div>
                  <div class="form-group">
                    <label for="tv_cat_image">Category Image</label>
                    <div class="input-group">
                      <div class="input-group">
                        <input type="file" class="form-control" id="tv_cat_image" name="tv_cat_image" >
                      </div>
                    </div>  
                  </div>
                </div>
                <!-- /.card-body -->
                

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
</div>
<!-- /.content-wrapper -->

@endsection