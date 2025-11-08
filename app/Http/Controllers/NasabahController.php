<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    private function authorizeOwnerOrAdmin(Nasabah $nasabah): void
    {
        $user = Auth::user();
        $isOwner = $nasabah->user_id === ($user->id ?? null);
        $isAdmin = ($user->role ?? null) === 'admin';
        abort_unless($isOwner || $isAdmin, 403, 'Tidak berhak mengakses data ini.');
    }

    public function create()
    {
        if (Auth::user()->nasabah) {
            return redirect()->route('dashboard')->with('info', 'Profil nasabah kamu sudah lengkap.');
        }
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        if ($request->user()->nasabah) {
            return redirect()->route('dashboard')->with('info', 'Profil nasabah kamu sudah ada.');
        }

        $validated = $request->validate([
            'nama'           => ['required','string','max:255'],
            'nik'            => ['required','digits:16','unique:nasabahs,nik'],
            'alamat'         => ['required','string'],
            'tempat_lahir'   => ['required','string','max:100'],
            'tanggal_lahir'  => ['required','date'],
            'no_hp'          => ['required','string','max:15'],
            'foto_ktp'       => ['required','image','mimes:jpg,jpeg,png','max:2048'],
        ]);

        $userId  = Auth::id();
        $tmpPath = null;

        try {
            // 1) Upload dulu (pakai userId biar pasti ada folder)
            $tmpPath = $request->file('foto_ktp')->store("nasabah/{$userId}/ktp", 'private');
            if (!$tmpPath) abort(422, 'Gagal menyimpan file KTP.');

            // 2) Create dengan path (kolom NOT NULL aman)
            $nasabah = DB::transaction(function () use ($validated, $userId, $tmpPath) {
                return Nasabah::create([
                    'user_id'        => $userId,
                    'nama'           => $validated['nama'],
                    'nik'            => $validated['nik'],
                    'alamat'         => $validated['alamat'],
                    'tempat_lahir'   => $validated['tempat_lahir'],
                    'tanggal_lahir'  => $validated['tanggal_lahir'],
                    'no_hp'          => $validated['no_hp'],
                    'foto_ktp'       => $tmpPath,
                ]);
            });

            // 3) (Opsional) Rapihin folder → based on nasabah ID
            $finalDir  = "nasabah/{$nasabah->id}/ktp";
            $fileName  = basename($tmpPath);
            $finalPath = "{$finalDir}/{$fileName}";

            if ($finalPath !== $tmpPath) {
                Storage::disk('private')->makeDirectory($finalDir);
                Storage::disk('private')->move($tmpPath, $finalPath);
                $nasabah->update(['foto_ktp' => $finalPath]);
            }

            return redirect()->route('dashboard')->with('success','Data nasabah berhasil dilengkapi!');
        } catch (\Throwable $e) {
            // Cleanup file kalau DB gagal
            if ($tmpPath && Storage::disk('private')->exists($tmpPath)) {
                Storage::disk('private')->delete($tmpPath);
            }
            throw $e;
        }
    }

    // DETAIL
    public function show(Nasabah $nasabah)
    {
        $this->authorizeOwnerOrAdmin($nasabah);
        return view('nasabah.show', compact('nasabah'));
    }
}
