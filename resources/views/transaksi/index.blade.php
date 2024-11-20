<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-blue-500 text-white text-center py-4">
            <h1 class="text-2xl font-bold">Nota Transaksi</h1>
        </div>

        {{-- Pesan Error/Success --}}
        <div class="px-6 pt-4">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        @forelse ($transaksi as $dt)
            <div class="p-6">
                <form method="POST" action="{{ route('transaksi.bayar') }}" class="space-y-4">
                    @csrf
                    <div class="text-center">
                        <h2
                            class="text-xl font-semibold text-gray-800 
                            {{ $dt->keterangan == 'BELUM LUNAS' ? 'text-yellow-600' : 'text-green-600' }}">
                            {{ $dt->keterangan }}
                        </h2>
                    </div>

                    <div class="border-b pb-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Barang Dibeli</span>
                            <span class="font-bold">{{ $dt->nama_barang }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga Satuan</span>
                            <span class="font-bold">Rp {{ number_format($dt->harga_barang) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kuantitas</span>
                            <span class="font-bold">{{ $dt->jumlah_beli }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Harga</span>
                            <span class="font-bold text-blue-600">Rp {{ number_format($dt->jumlah_bayar) }}</span>
                        </div>

                        {{-- Tambahan informasi pembayaran untuk BELUM LUNAS --}}
                        @if ($dt->keterangan == 'BELUM LUNAS')
                            <div class="flex justify-between mt-2">
                                <span class="text-gray-600">Telah Dibayar</span>
                                <span class="font-bold text-yellow-600">
                                    Rp {{ number_format($dt->bayar ?? 0) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sisa Pembayaran</span>
                                <span class="font-bold text-red-600">
                                    Rp {{ number_format($dt->jumlah_bayar - ($dt->bayar ?? 0)) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    @if ($dt->keterangan == 'BELUM LUNAS')
                        <div class="space-y-2">
                            <input type="hidden" name="jumlah_bayar" value="{{ $dt->jumlah_bayar }}">
                            <input type="hidden" name="id_transaksi" value="{{ $dt->id_transaksi }}">

                            <label class="block text-gray-700 font-bold">Pembayaran</label>
                            <input type="number" name="bayar" min="0" placeholder="Masukkan jumlah pembayaran"
                                required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                            <button type="submit"
                                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                Bayar Sekarang
                            </button>
                        </div>
                    @else
                        <div class="border-t pt-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Lunas</span>
                                <span class="font-bold">{{ $dt->tgl_transaksi }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kembalian</span>
                                <span class="font-bold text-green-600">
                                    Rp {{ number_format($dt->kembalian) }}
                                </span>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        @empty
            <div class="text-center p-6 text-gray-500">
                Tidak ada transaksi
            </div>
        @endforelse

        <div class="bg-gray-100 p-4 text-center">
            <a href="/barang" class="text-blue-500 hover:underline">Kembali ke Daftar Barang</a>
        </div>
    </div>
</body>

</html>
