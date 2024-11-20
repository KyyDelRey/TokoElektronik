<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beli Barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-center mb-6 text-2xl font-extrabold text-gray-900">
            Beli Barang
        </h1>
        <form action="{{ route('transaksi.proses') }}" method="POST">
            @csrf
            <p class="mb-4">Barang yang dibeli:<br> <b>{{ $barang->nama_barang }}</b></p>
            <input type="hidden" name="beli_id" value="{{ $barang->id_barang }}">

            <p class="mb-4">Harga Satuan:<br> <b>{{ $barang->harga_barang }}</b></p>
            <input type="hidden" name="beli_harga" value="{{ $barang->harga_barang }}">

            <p class="mb-4">Stok tersedia:<br> <b>{{ $barang->jumlah_barang }}</b></p>
            <input type="hidden" name="beli_stok" value="{{ $barang->jumlah_barang }}">

            <div class="relative mb-4">
                <input type="number" id="beli_kuantitas" name="beli_kuantitas"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label for="beli_kuantitas"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Kuantitas
                    Beli:</label>
            </div>

            <button
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2"
                type="submit">Pesan</button>

            <a class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2"
                href="/barang">Kembali</a>
        </form>
    </div>
</body>

</html>
