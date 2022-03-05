@extends('_temp.main')

@section('title', 'Profile')

@section('container')
<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: {{ url('img/curved-images/curved0.jpg') }}; background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
  </div>
  <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="{{ asset('storage/profile_img/'. auth()->user()->image ) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ ucfirst(Auth::user()->name) }}
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            You role : {{  ucfirst(auth()->user()->role) }}
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
        <div class="nav-wrapper position-relative end-0">
          <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">

            {{-- Change Photo --}}
            <form action="{{ route('change-ava') }}" enctype="multipart/form-data" method="POST">
              @csrf
              @method('PUT')

              <div class="form-group">
                <label for="exampleFormControlFile1">Upload Image</label>
                <input type="file" name="image" class="form-control-file mb-2" id="exampleFormControlFile1"  style="display:none">
                <button type="submit" class="btn btn-success">Upload</button>
              </div>

            </form>

          </ul>
        </div>
      </div>
    </div>
  </div>

  {{-- Form --}}
  <div class="row">
    <div class="col-12 col-xl-8 mt-4 ml-5 ">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Form Edit Photo</h6>
        </div>
        <div class="card-body p-3">
         <form action="{{ route('change-prof') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")

           <label for="name">Name</label>
           <input type="text" name="name" class="form-control">
           <label for="name">Email</label>
           <input type="text" name="email" class="form-control">

           <button type="submit" class="btn btn-primary">Save</button>
         </form>
          </ul>
        </div>
      </div>
    </div>
@endsection