@extends('layouts.admin.app')

@section('content')
<div class="py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
        </ol>
    </nav>

    {{-- Judul --}}
    <div class="d-flex justify-content-between w-100 flex-wrap mb-4">
        <div>
            <h1 class="h4">Edit Pelanggan</h1>
            <p class="mb-0">Form untuk mengedit data pelanggan</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.show', $pelanggan->pelanggan_id) }}" class="btn btn-info me-2">
                Lihat Detail
            </a>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card Form --}}
    <div class="row">
        <div class="col-12 mb-4">

            <form action="{{ route('pelanggan.update', $pelanggan->pelanggan_id) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Data Pelanggan</h5>
                    </div>
                    <div class="card-body">

                        {{-- Row 1 --}}
                        <div class="row mb-3">
                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label class="form-label">First name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                       value="{{ old('first_name', $pelanggan->first_name) }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label class="form-label">Last name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                       value="{{ old('last_name', $pelanggan->last_name) }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label class="form-label">Birthday</label>
                                <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror"
                                       value="{{ old('birthday', $pelanggan->birthday) }}">
                                @error('birthday')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Row 2 --}}
                        <div class="row mb-3">
                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">Pilih Gender</option>
                                    <option value="Male" {{ old('gender', $pelanggan->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $pelanggan->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $pelanggan->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $pelanggan->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-12 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $pelanggan->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Upload file section --}}
                        <div class="row mb-4">
                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">Upload Files (Opsional)</label>
                                <input type="file" name="support_files[]" 
                                       class="form-control @error('support_files.*') is-invalid @enderror" 
                                       multiple 
                                       accept="image/*,.pdf,.doc,.docx">
                                
                                @error('support_files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <div class="form-text">
                                    File yang diupload akan tampil di halaman detail. 
                                    Format: Gambar, PDF, Word. Maksimal 4MB per file.
                                </div>
                            </div>
                            
                            {{-- Tampilkan file yang sudah ada --}}
                            @php
                                $existingFiles = \App\Models\Multipleuploads::where('ref_table', 'pelanggan')
                                    ->where('ref_id', $pelanggan->pelanggan_id)
                                    ->get();
                            @endphp
                            
                            @if($existingFiles->count() > 0)
                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">File yang Sudah Diupload</label>
                                <div class="border rounded p-3 bg-light">
                                    @foreach($existingFiles as $file)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <small>
                                                <i class="fas fa-file me-1"></i>
                                                {{ $file->file_name }}
                                            </small>
                                            <a href="{{ route('pelanggan.deleteFile', $file->id) }}" 
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Hapus file ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-end pt-3">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                            <a href="{{ route('pelanggan.show', $pelanggan->pelanggan_id) }}" class="btn btn-outline-warning">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection