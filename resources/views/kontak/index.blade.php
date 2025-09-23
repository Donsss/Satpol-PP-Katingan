<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
            {{ __('Kotak Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Menampilkan notifikasi sukses setelah menghapus pesan --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-200 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    {{-- Daftar Pesan --}}
                                    <ul class="divide-y divide-gray-200">
                                        @forelse ($kontaks as $kontak)
                                            <li class="relative">
                                                {{-- Pesan yang belum dibaca akan memiliki background sedikit berbeda --}}
                                                <div class="block hover:bg-gray-50 {{ is_null($kontak->read_at) ? 'bg-blue-50' : '' }}">
                                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                                        <div class="min-w-0 flex-1 flex items-center">
                                                            {{-- Indikator Titik Biru untuk pesan belum dibaca --}}
                                                            @if(is_null($kontak->read_at))
                                                                <div class="flex-shrink-0 mr-4">
                                                                    <div class="w-2.5 h-2.5 bg-blue-500 rounded-full" aria-hidden="true"></div>
                                                                </div>
                                                            @else
                                                                {{-- Placeholder agar sejajar --}}
                                                                <div class="flex-shrink-0 mr-4">
                                                                    <div class="w-2.5 h-2.5" aria-hidden="true"></div>
                                                                </div>
                                                            @endif

                                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                                <div>
                                                                    {{-- Nama pengirim akan tebal jika belum dibaca --}}
                                                                    <p class="text-sm font-medium text-indigo-600 truncate {{ is_null($kontak->read_at) ? 'font-bold' : '' }}">
                                                                        {{ $kontak->nama_lengkap }}
                                                                    </p>
                                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                        <i class="far fa-envelope mr-2"></i>
                                                                        <span class="truncate">{{ $kontak->email }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="hidden md:block">
                                                                    <div>
                                                                        <p class="text-sm text-gray-900">
                                                                            <span class="font-semibold">Tipe:</span>
                                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                                {{ $kontak->tipe_pesan }}
                                                                            </span>
                                                                        </p>
                                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                            <i class="far fa-clock mr-2"></i>
                                                                            <span>Diterima {{ $kontak->created_at->diffForHumans() }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            {{-- Tombol hapus --}}
                                                            <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST" onsubmit="return confirmDelete(event)">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 focus:outline-none">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Tautan ini membuat seluruh baris bisa diklik untuk membuka detail --}}
                                                <a href="{{ route('admin.kontak.show', $kontak) }}" class="absolute inset-0" aria-label="Lihat pesan dari {{ $kontak->nama_lengkap }}"></a>
                                            </li>
                                        @empty
                                            <li>
                                                <div class="text-center py-10 px-4 sm:px-6">
                                                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                                                    <h3 class="text-sm font-medium text-gray-900">Tidak ada pesan</h3>
                                                    <p class="mt-1 text-sm text-gray-500">Kotak masuk Anda kosong.</p>
                                                </div>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                                {{-- Link Paginasi --}}
                                <div class="mt-4">
                                    {{ $kontaks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Fungsi konfirmasi hapus menggunakan SweetAlert2
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form dikirim langsung
            event.stopPropagation(); // Mencegah tautan di belakangnya terpicu
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