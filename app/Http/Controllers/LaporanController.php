<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class LaporanController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Transaksi::all();
        return view('Tampilan.laporan.showall', compact('laporan'));
    }

    public function showAll($tglawal, $tglakhir)
    {
        $laporan = Transaksi::with('user')->whereBetween('created_at', [$tglawal, $tglakhir])->orderBy('created_at','asc')->get();

        return view('Tampilan.laporan.showall' , compact('laporan'));

        
    }

    public function onlinePdf(Request $request)
    {
        // cetak pdf
        $laporan = Transaksi::all();

        if(isset($request->tglawal) && isset($request->tglakhir)) {
            $laporan = Transaksi::with('user')->whereBetween('created_at', [$request->tglawal, $request->tglakhir])->orderBy('created_at','asc')->get();
        }

        $pdf = PDF::loadView('Tampilan.laporan.cetakpdf', ['laporan' => $laporan]);

        // return $pdf->download('laporan-kafe.pdf');
        return $pdf->stream();
    }


    public function downloadPdf(Request $request)
    {
        // cetak pdf

        $laporan = Transaksi::all();

        if(isset($request->tglawal) && isset($request->tglakhir)) {
            $laporan = Transaksi::with('user')->whereBetween('created_at', [$request->tglawal, $request->tglakhir])->orderBy('created_at','asc')->get();
        }

        $pdf = PDF::loadView('Tampilan.laporan.cetakpdf', ['laporan' => $laporan]);

        // return $pdf->download('laporan-kafe.pdf');
        return $pdf->download('laporan.pdf');
    }


}