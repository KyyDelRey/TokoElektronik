<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::getTransaksiWithBarang();
        return view('transaksi.index', compact('transaksi'));
    }
    public function beli(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('transaksi.beli', compact('barang'));
    }
    public function proses(Request $request)
    {
        $request->validate([
            'beli_id' => 'required|numeric',
            'beli_harga' => 'required|numeric',
            'beli_stok' => 'required|numeric',
            'beli_kuantitas' => 'required|numeric'
        ]);

        $stok_akhir = $request->beli_stok - $request->beli_kuantitas;
        $jumlah_bayar = $request->beli_kuantitas * $request->beli_harga;

        Transaksi::create([
            'id_barang' => $request->beli_id,
            'tgl_transaksi' => Carbon::now(),
            'jumlah_beli' => $request->beli_kuantitas,
            'jumlah_bayar' => $jumlah_bayar,
            'stok_barang' => $stok_akhir,
            'kembalian' => 0,
            'keterangan' => 'BELUM LUNAS',
            'bayar' => 0
        ]);
        $barang = Barang::findOrFail($request->beli_id);
        $barang->update([
            'jumlah_barang' => $stok_akhir,
        ]);

        return redirect()->route('transaksi.index')->with(['success' => 'Berhasil menyimpan transaksi']);
    }
    public function bayar(Request $request)
    {
        $request->validate([
            'bayar' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::findOrFail($request->id_transaksi);

        $jumlah_bayar = $transaksi->jumlah_bayar;
        $bayar_sebelumnya = $transaksi->bayar ?? 0;
        $bayar_sekarang = $request->bayar;
        $total_bayar = $bayar_sebelumnya + $bayar_sekarang;

        if ($total_bayar < $jumlah_bayar) {
            // Pembayaran parsial
            $transaksi->update([
                'tgl_transaksi' => Carbon::now(),
                'bayar' => $total_bayar,
                'kembalian' => 0,
                'keterangan' => 'BELUM LUNAS'
            ]);

            return redirect()->route('transaksi.index')
                ->with(['error' => 'Pembayaran masih kurang dari total yang harus dibayar']);
        } elseif ($total_bayar == $jumlah_bayar) {
            // Pembayaran tepat
            $transaksi->update([
                'tgl_transaksi' => Carbon::now(),
                'bayar' => $total_bayar,
                'kembalian' => 0,
                'keterangan' => 'LUNAS'
            ]);

            return redirect()->route('transaksi.index')
                ->with(['success' => 'Transaksi berhasil dibayar lunas']);
        } else {
            // Pembayaran lebih
            $kembalian = $total_bayar - $jumlah_bayar;

            $transaksi->update([
                'tgl_transaksi' => Carbon::now(),
                'bayar' => $total_bayar,
                'kembalian' => $kembalian,
                'keterangan' => 'LUNAS'
            ]);

            return redirect()->route('transaksi.index')
                ->with(['success' => 'Transaksi berhasil dibayar dengan kembalian']);
        }
    }
}