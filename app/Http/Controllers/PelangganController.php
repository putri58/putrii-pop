<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\PelangganFile;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index(Request $request){
        $filterableColumns = ['gender'];
        $searchableColumns = ['first_name','last_name','email'];
        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
                    ->search($request, $searchableColumns)
                    ->paginate(10)
                    ->withQueryString();
        return view('admin.pelanggan.index',$data);
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'birthday'   => 'nullable|date',
            'gender'     => 'nullable|string',
            'email'      => 'required|email|unique:pelanggan,email',
            'phone'      => 'nullable|string',
            'files.*'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Simpan data pelanggan
        $pelanggan = Pelanggan::create($validated);

        // Simpan multiple file jika ada
        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $path = $file->store('pelanggan_files', 'public');
                PelangganFile::create([
                    'pelanggan_id' => $pelanggan->pelanggan_id,
                    'file_path'    => $path
                ]);
            }
        }

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        // Validasi data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'birthday'   => 'nullable|date',
            'gender'     => 'nullable|string',
            'email'      => 'required|email|unique:pelanggan,email,'.$pelanggan->pelanggan_id.',pelanggan_id',
            'phone'      => 'nullable|string',
            'files.*'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $pelanggan->update($validated);

        // Simpan multiple file baru jika ada
        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $path = $file->store('pelanggan_files', 'public');
                PelangganFile::create([
                    'pelanggan_id' => $pelanggan->pelanggan_id,
                    'file_path'    => $path
                ]);
            }
        }

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil diubah.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        // Hapus file yang terkait
        foreach($pelanggan->files as $file){
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil dihapus.');
    }
    public function upload(Request $request, Pelanggan $pelanggan)
{
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('pelanggan_files'); // storage/app/pelanggan_files
            $pelanggan->files()->create(['file_path' => $path]);
        }
    }

    return redirect()->back()->with('success', 'Files uploaded!');
}

}
