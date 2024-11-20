<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div
        class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-2xl font-extrabold dark:text-white text-center mb-6">Detail Data Barang</h2>
        <p class="mb-3 text-lg text-gray-500 md:text-xl dark:text-gray-400">Nama Barang:
            <b>{{ $barang->nama_barang }}</b>
        </p>
        <p class="mb-3 text-lg text-gray-500 md:text-xl dark:text-gray-400">Harga Barang:
            <b>{{ $barang->harga_barang }}</b>
        </p>
        <p class="mb-3 text-lg text-gray-500 md:text-xl dark:text-gray-400">Stok Barang:
            <b>{{ $barang->jumlah_barang }}</b>
        </p>
        <div class="text-center flex justify-self-start space-x-4">
            <a href="{{ route('barang.index') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Kembali
            </a>
        </div>
    </div>
</body>

</html>
