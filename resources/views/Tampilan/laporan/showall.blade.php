@extends('_temp.main')

@section('title', 'Pdf')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Laporan</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Laporan Page</h6>
    </nav>
@endsection

@section('container')
    <div class="container-fluid">

        <div class="card card-info card-outline">
            <div class="card-header">Lihat Data</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="label">Tanggal Awal</label>
                        <input type="date" name="tglawal" id="tglawal" class="form-control date" />
                    </div>
                    <div class="form-group">
                        <label for="label">Tanggal Akhir</label>
                        <input type="date" name="tglakhir" id="tglakhir" class="form-control date" />
                    </div>
                    <div class="form-group">
                        <a  onclick="this.href='/filter-laporan/'+ document.getElementById('tglawal').value +
                    '/' + document.getElementById('tglakhir').value " class="btn btn-primary col-md-12">
                            Lihat <i class="fas fa-print"></i>
                        </a>
                    </div>

                    {{-- Tabel --}}
                    <div class="card-body">
                        <div class="table-responsive">

                            @php
                               $tglawal = request()->segment(2);
                               $tglakhir = request()->segment(3);

                               $pdfonline = 'laporan/online_pdf';
                               $pdfdownload = 'laporan/download_pdf';

                               if(!is_null($tglawal) && !is_null($tglakhir)) {
                                   $pdfonline .= '?tglawal='. $tglawal .'&tglakhir='. $tglakhir;
                               }

                               if(!is_null($tglawal) && !is_null($tglakhir)) {
                                   $pdfdownload .= '?tglawal='. $tglawal .'&tglakhir='. $tglakhir;
                               }
                               
                            @endphp

                            <a href="{{ url($pdfonline) }}" class="btn btn-info" target="_blank">online PDF</a>
                            <a href="{{ url($pdfdownload) }}" class="btn btn-success" target="_blank">Download PDF</a>
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> No</th>
                                        <th> Nama Pelanggan</th>
                                        <th> Menu</th>
                                        <th> Jumlah</th>
                                        <th> Total </th>
                                        <th> Nama Pegawai</th>
                                        <th> Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_pelanggan }}</td>
                                        <td>{{ $item->nama_menu }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->total_harga }}</td>
                                        <td>{{ $item->nama_pegawai }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
        
                        </div>
                    </div>    
                </div>

    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
        $('.date').datetimepicker({
            format: 'DD/MM/YYYY',
            locale: 'id'
        });
    </script>
@endsection