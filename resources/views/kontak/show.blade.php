<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pesan') }}
            </h2>
            <a href="{{ route('admin.kontak.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Kembali ke Kotak Masuk') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 bg-white border-b border-gray-200">
                    
                    <!-- Header Pesan: Informasi Pengirim -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg leading-6 font-bold text-gray-900">
                                {{ $kontak->nama_lengkap }}
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                <a href="mailto:{{ $kontak->email }}" class="text-indigo-600 hover:underline">{{ $kontak->email }}</a>
                            </p>
                            @if($kontak->telepon)
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    {{ $kontak->telepon }}
                                </p>
                            @endif
                        </div>
                        <div class="text-right flex-shrink-0 ml-4">
                             <p class="text-sm text-gray-500" title="{{ $kontak->created_at->format('d F Y, H:i:s') }}">
                                {{ $kontak->created_at->diffForHumans() }}
                            </p>
                            <p class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $kontak->tipe_pesan }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <hr class="my-6">

                    <!-- Isi Pesan -->
                    <div class="prose max-w-none text-gray-800">
                        <p>
                            {{-- Fungsi nl2br akan mengubah baris baru (\n) menjadi tag <br> agar format paragraf tetap terjaga --}}
                            {!! nl2br(e($kontak->isi_pesan)) !!}
                        </p>
                    </div>

                    <hr class="my-6">

                    <!-- Tombol Aksi di Bawah -->
                    <div class="flex justify-end">
                        <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST" onsubmit="return confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-trash-alt mr-2"></i>
                                {{ __('Hapus Pesan') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi konfirmasi hapus menggunakan SweetAlert2
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form dikirim langsung
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pesan ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Jika dikonfirmasi, kirim form
                }
            });
        }
    </script>
</x-app-layout>