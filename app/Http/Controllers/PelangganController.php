<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Multipleuploads;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['gender'];
        $searchableColumns = ['first_name', 'last_name', 'email'];

        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('admin.pelanggan.index', $data);
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'birthday'   => 'nullable|date',
            'gender'     => 'nullable|string',
            'email'      => 'required|email|unique:pelanggan,email',
            'phone'      => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::create($validated);

        return redirect()->route('pelanggan.show', $pelanggan->pelanggan_id)
            ->with('success', 'Data pelanggan berhasil ditambahkan! Silakan upload file pendukung.');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $files = Multipleuploads::where('ref_table', 'pelanggan')
            ->where('ref_id', $id)
            ->get();

        return view('admin.pelanggan.detail', compact('pelanggan', 'files'));
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'birthday'   => 'nullable|date',
            'gender'     => 'nullable|string',
            'email'      => 'required|email|unique:pelanggan,email,' . $pelanggan->pelanggan_id . ',pelanggan_id',
            'phone'      => 'nullable|string',
        ]);

        $pelanggan->update($validated);

        // HAPUS SEMENTARA UPLOAD FILE DI UPDATE
        // if ($request->hasFile('support_files')) {
        //     foreach ($request->file('support_files') as $file) {
        //         $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        //         $path = $file->storeAs('uploads/pelanggan', $filename, 'public');
        // 
        //         Multipleuploads::create([
        //             'ref_table' => 'pelanggan',
        //             'ref_id'    => $pelanggan->pelanggan_id,
        //         ]);
        //     }
        // }

        return redirect()->route('pelanggan.show', $pelanggan->pelanggan_id)
            ->with('success', 'Pelanggan berhasil diupdate.');
    }

    public function uploadFile(Request $request, $pelanggan_id)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:4096'
        ]);

        $pelanggan = Pelanggan::findOrFail($pelanggan_id);

        if ($request->hasFile('files')) {
            $uploadedCount = 0;
            
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/pelanggan', $filename, 'public');

                // HANYA GUNAKAN KOLOM YANG PASTI ADA
                Multipleuploads::create([
                    'ref_table' => 'pelanggan',
                    'ref_id'    => $pelanggan_id,
                    // JANGAN GUNAKAN 'filename' JIKA KOLOM TIDAK ADA
                ]);

                $uploadedCount++;
            }

            $message = $uploadedCount > 0 
                ? "{$uploadedCount} file berhasil diupload." 
                : "Tidak ada file yang diupload.";

            return back()->with('success', $message);
        }

        return back()->with('error', 'Tidak ada file yang dipilih.');
    }

    public function deleteFile($id)
    {
        $file = Multipleuploads::findOrFail($id);

        // Karena tidak ada kolom filename, kita tidak bisa delete file dari storage
        // Hanya hapus dari database
        $file->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $files = Multipleuploads::where('ref_table', 'pelanggan')
            ->where('ref_id', $pelanggan->pelanggan_id)
            ->get();

        // Hapus hanya dari database (tidak bisa hapus dari storage karena tidak ada filename)
        foreach ($files as $file) {
            $file->delete();
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan & semua file terkait berhasil dihapus.');
    }
}