<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                {{ __('Manajemen User') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700 shadow-sm">
                Tambah User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
            @endif

            @if(session('newUserCredentials'))
                 <div class="mb-4 p-4 bg-blue-100 border border-blue-300 text-blue-800 rounded-lg" x-data="{ email: '{{ session('newUserCredentials')['email'] }}', password: '{{ session('newUserCredentials')['password'] }}', emailCopied: false, passwordCopied: false }">
                    <h3 class="font-bold text-lg mb-2">Akun Baru Berhasil Dibuat!</h3>
                    <p>Silakan salin dan berikan kredensial berikut kepada pengguna:</p>
                    <div class="mt-3 space-y-2">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                            <span class="font-semibold w-20 shrink-0">Email:</span>
                            <input type="text" :value="email" readonly class="w-full sm:flex-grow bg-gray-50 border-gray-300 rounded-md p-1 text-sm">
                            <button @click="navigator.clipboard.writeText(email); emailCopied = true; setTimeout(() => emailCopied = false, 2000)" class="w-full sm:w-20 px-3 py-1 bg-gray-200 text-sm text-gray-800 rounded hover:bg-gray-300 text-center">
                                <span x-show="!emailCopied">Copy</span>
                                <span x-show="emailCopied" class="text-green-600 font-semibold">Copied!</span>
                            </button>
                        </div>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                            <span class="font-semibold w-20 shrink-0">Password:</span>
                            <input type="text" :value="password" readonly class="w-full sm:flex-grow bg-gray-50 border-gray-300 rounded-md p-1 text-sm">
                            <button @click="navigator.clipboard.writeText(password); passwordCopied = true; setTimeout(() => passwordCopied = false, 2000)" class="w-full sm:w-20 px-3 py-1 bg-gray-200 text-sm text-gray-800 rounded hover:bg-gray-300 text-center">
                                <span x-show="!passwordCopied">Copy</span>
                                <span x-show="passwordCopied" class="text-green-600 font-semibold">Copied!</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <table class="min-w-full responsive-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr>
                                    <td data-label="Nama">{{ $user->name }}</td>
                                    <td data-label="Email">{{ $user->email }}</td>
                                    <td data-label="Role">
                                        @foreach($user->getRoleNames() as $roleName)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleName == 'super-admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $roleName }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td data-label="Aksi">
                                        <div class="flex space-x-3 justify-end">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data user.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($users->hasPages())
                    <div class="p-4 bg-white border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    @media (max-width: 767px) {
        .responsive-table thead {
            display: none;
        }
        .responsive-table tr {
            display: block;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
        }
        .responsive-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            text-align: right;
            border-bottom: 1px solid #f3f4f6;
        }
        .responsive-table td:last-child {
            border-bottom: 0;
        }
        .responsive-table td::before {
            content: attr(data-label);
            font-weight: 600;
            text-align: left;
            margin-right: 1rem;
        }
    }

    @media (min-width: 768px) {
        .responsive-table th,
        .responsive-table td {
            padding: 0.75rem 1.5rem;
            white-space: nowrap;
        }
        .responsive-table th {
            text-align: left;
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .responsive-table td {
            font-size: 0.875rem;
        }
        .responsive-table td:last-child {
            text-align: right;
        }
        .responsive-table td:last-child > div {
            justify-content: flex-end;
        }
    }
</style>