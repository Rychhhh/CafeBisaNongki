@extends('_temp.main')

@section('title', 'Kasir')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Transaksi</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Kasir</h6>
    </nav>
@endsection

@section('container')
    <livewire:transaksi.index></livewire:transaksi.index>
@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>

    <script>
        window.addEventListener('show-modal', event => {
            $('#exampleModal').modal('show');
        })
        
        window.addEventListener('hide-modal', event => {
            $('#exampleModal').modal('hide');
        })
        
        // Alert
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail.title,
                icon: event.detail.icon,
                text: event.detail.text,
            })
        })

          // Confirm Alert
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

        // fungsi untuk menentukan harga berdasarkan menu yang dipilih
        window.addEventListener('harga_menu', event => {
            document.getElementById('hargaperunit').value = event.detail;
        })

        // fungsi get Total Harga
        $('#jumlahPesanan').on('keyup', (e) => {
            const hargaperunit = $('#hargaperunit').val() // get ID harga per unit
            var jumlah = $('#jumlahPesanan').val()        // get ID jumlah barang

            var totalharga = hargaperunit * jumlah;       // harga * jumlah

            if(totalharga == 0) {                         // jika jumlah > stok yg ada
                return false;
            }

            $('#harga_menu').val(totalharga);             // tampilkan di view index
        })
    
    </script>
@endsection