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
    <livewire:menu.index></livewire:menu.index>
@endsection

@section('script')
<script>

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

    window.addEventListener('alert' , event => {
            toastr.success(event.detail.message);
        })
    

</script>
@endsection