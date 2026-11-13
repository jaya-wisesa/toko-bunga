<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4">
    <h1 class="text-2xl font-bold mb-5">Tabel Item Toko Bunga</h1>

    {{-- Tombol buka modal tambah item --}}
    <button onclick="bukaModal()" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Tambah Item</button>

    {{-- Pesan sukses setelah simpan --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mt-5">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel data --}}
    <table class="w-full mt-5">
        <thead class="bg-gray-300">
            <tr>
                <th class="border p-2">Nama Item</th>
                <th class="border p-2">Harga</th>
                <th class="border p-2">Stok</th>
                <th class="border p-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="border p-2">{{ $product->nama_barang }}</td>
                    <td class="border p-2">Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td class="border p-2">{{ $product->stok }}</td>
                    <td class="border p-2">{{ $product->deskripsi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border p-2 text-center text-gray-500">Belum ada data item</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Modal form tambah item --}}
    <div id="modalTambah" class="fixed inset-0 bg-black/40 hidden items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold mb-4">Tambah Item Baru</h2>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <label class="block font-medium mb-1">Nama Item</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                       class="w-full border rounded p-2 mb-1">
                @error('nama_barang') <p class="text-red-500 text-sm mb-2">{{ $message }}</p> @enderror

                <label class="block font-medium mb-1 mt-3">Harga</label>
                <input type="number" name="harga" value="{{ old('harga') }}" min="0" required
                       class="w-full border rounded p-2 mb-1">
                @error('harga') <p class="text-red-500 text-sm mb-2">{{ $message }}</p> @enderror

                <label class="block font-medium mb-1 mt-3">Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}" min="0" required
                       class="w-full border rounded p-2 mb-1">
                @error('stok') <p class="text-red-500 text-sm mb-2">{{ $message }}</p> @enderror

                <label class="block font-medium mb-1 mt-3">Deskripsi</label>
                <textarea name="deskripsi" rows="3" required
                          class="w-full border rounded p-2 mb-1">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-sm mb-2">{{ $message }}</p> @enderror

                <div class="flex justify-end gap-2 mt-5">
                    <button type="button" onclick="tutupModal()" class="border px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modalTambah');

        function bukaModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function tutupModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // kalau validasi gagal, modal otomatis terbuka lagi
        @if ($errors->any())
            bukaModal();
        @endif
    </script>
</body>
</html>
