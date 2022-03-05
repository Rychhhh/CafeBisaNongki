@extends('_temp.main')

@section('title', 'Dashboard')


@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Dashboard</h6>
    </nav>
@endsection

@section('container')
    <livewire:dashboard></livewire:dashboard>
@endsection


@section('script')
    @include('sweetalert::alert')

    {{-- Sweet ALert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <script>
        window.addEventListener('alert' , event => {
            toastr.event.detail.toastr(event.detail.message);
        })
    </script>

@endsection