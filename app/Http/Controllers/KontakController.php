<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KontakController extends Controller
{

    /**
     * Menampilkan formulir kontak kepada pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $pageTitle = 'Hubungi Kami';

        // Membuat pertanyaan captcha sederhana
        $num1 = rand(1, 9);
        $num2 = rand(1, 5);
        session(['captcha_answer' => $num1 + $num2]);
        $captchaQuestion = "$num1 + $num2";

        return view('user-views.kontak', compact('pageTitle', 'captchaQuestion'));
    }

    /**
     * Menyimpan pesan baru dari formulir kontak.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'tipe_pesan' => 'required|string|in:Pertanyaan,Saran,Kritik,Lainnya',
            'isi_pesan' => 'required|string|max:5000',
            'captcha' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ((int) $value !== session('captcha_answer')) {
                    $fail('Jawaban verifikasi salah.');
                }
            }],
        ]);

        // Buat entri baru di database
        Kontak::create($validated);

        // Hapus jawaban captcha dari session setelah berhasil
        $request->session()->forget('captcha_answer');

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan Anda telah berhasil terkirim. Terima kasih!');
    }

    /**
     * Menampilkan daftar semua pesan masuk di halaman admin.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        // Ambil semua data kontak, urutkan dari yang terbaru, dan paginasi
        $kontaks = Kontak::latest()->paginate(15);
        return view('kontak.index', compact('kontaks'));
    }

    /**
     * Menampilkan detail satu pesan dan menandainya sebagai sudah dibaca.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\View\View
     */
    public function showAdmin(Kontak $kontak)
    {
        if (is_null($kontak->read_at)) {
            $kontak->read_at = Carbon::now();
            $kontak->save();
        }
        
        // Tampilkan halaman detail pesan
        return view('kontak.show', compact('kontak'));
    }

    /**
     * Menghapus pesan dari database.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAdmin(Kontak $kontak)
    {
        $kontak->delete();
        
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}

