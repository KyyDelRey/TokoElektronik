<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Elektronik Wonosobo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <h1
        class="text-center mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
        Toko Elektronik Wonosobo</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nomor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stok
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Opsi
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @forelse ($barang as $data)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $no++ }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $data->id_barang }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $data->nama_barang }}
                        </td>
                        <td class="px-6 py-4">
                            Rp {{ number_format($data->harga_barang, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $data->jumlah_barang }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('barang.destroy', $data->id_barang) }}" method="POST"
                                onsubmit="return confirm('Yakin Hapus?')">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('transaksi.beli', $data->id_barang) }}"
                                    class="font-medium text-green-600 dark:text-green-500 hover:underline">Beli</a>
                                <a href="{{ route('barang.show', $data->id_barang) }}"
                                    class="font-medium text-purple-600 dark:text-purple-500 hover:underline">Detail</a>
                                <a href="{{ route('barang.edit', $data->id_barang) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <button type="submit"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <td class="px-6 py-4">
                        Data Masih Kosong
                    </td>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex items-center space-x-4 mt-4">
        <a href="{{ route('barang.create') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Tambah Barang
        </a>
        <a href="{{ route('transaksi.index') }}"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Riwayat Transaksi
        </a>
    </div>

</body>

</html>
