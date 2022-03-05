@extends('_temp.main')

@section('title', 'Manager')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Menu</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Menu Page</h6>
    </nav>
@endsection


@section('container')

        <form action="{{ url('menu') }}" method="POST" enctype="multipart/form-data" onsubmit="
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cek lagi data anda !!!',
            showConfirmButton: false,
            timer: 2500
          })">

            @csrf

            <div class="mb-3">
                <label for="nama_menu" class="col-form-label">Nama Menu :</label>
            <input type="text" name="nama_menu" class="form-control  @error('nama_menu') is-invalid @enderror" name="nama_menu">

            
            @error('nama_menu')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div> 

        <label for="harga" class="col-form-label">Harga :</label>
        <div class="input-group mb-3 flex flex-co">
            <span class="input-group-text">Rp.</span>
            <input type="number" name="harga" class="form-control  @error('harga') is-invalid @enderror" name="harga">
            <span class="input-group-text">.00</span>

            @error('harga')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> 

        <div class="form-floating">
            <textarea class="form-control  @error('desc') is-invalid @enderror" name="desc" placeholder="Leave a desc here" name="desc" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Description</label>

            
            @error('desc')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>
        
        <div class="mb-3">
            <label for="stok" class="col-form-label  @error('stok') is-invalid @enderror">Stok :</label>
            <input type="number" name="stok" class="form-control" name="stok">
            
            
            @error('stok')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="photo" class="col-form-label">Photo :</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" name="photo">
        
            
            @error('photo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                
            <button type="submit" class="btn btn-success mt-4">Submit</button>
        </div> 
    </form>
        
@endsection


@section('script')
{{-- Sweet ALert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>


    <script>
        window.addEventListener('show-modal', event => {
            $('#exampleModal').modal('show');
        })
        
        window.addEventListener('hide-modal', event => {
            $('#exampleModal').modal('hide');
        })

        // // Alert
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail.title,
                icon: event.detail.icon,
                text: event.detail.text,
            })
        })

        //   // Confirm Alert
        window.addEventListener('swal:confirm', event => {
        
            try {
                Swal.fire({
                'title': event.detail.title,
                'text': event.detail.text,
                'icon': event.detail.icon,
                'showCancelButton': true,
                'confirmButtonColor': '#3085d6',
                'cancelButtonColor': '#d33',
                'confirmButtonText': 'Yes!'
            })
                .then((result) => {
                    if(result.isConfirmed) {
                        window.livewire.emit('delete' , event.detail.id);
                    }
                })
            } catch (error) {
                console.log(error);
            }
            
        });
    
    </script>
@endsection