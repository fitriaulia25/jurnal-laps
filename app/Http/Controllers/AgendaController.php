<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // Metode untuk menampilkan form input agenda
    public function create()
    {
        return view('agenda.create'); // Gantilah 'agenda.create' dengan nama view yang sesuai
    }

    // Metode untuk menyimpan data agenda
    public function store(Request $request)
    {
        // Dump dan berhenti untuk memeriksa data request
        dd($request->all());

        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        // Debug: Tampilkan data yang diterima
        \Log::info('Data diterima: ', $validatedData);

        // Membuat entri baru di tabel agendas
        try {
            Agenda::create($validatedData);
            \Log::info('Data berhasil disimpan.');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
        }

        // Redirect ke halaman yang diinginkan
        return redirect()->route('agenda.index')->with('success', 'Agenda created successfully!');
    }
}
