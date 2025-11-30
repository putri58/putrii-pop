@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg></a></li>
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap mb-4">
        <div>
            <h1 class="h4">Edit Pelanggan</h1>
            <p class="mb-0">Form untuk mengubah data pelanggan</p>
        </div>
        <div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            {{-- Tambahkan enctype untuk file upload --}}
            <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="row mb-3">
                            {{-- Foto Profil Tunggal --}}
                            <div class="col-12 mb-3">
                                <label for="profile_picture">Foto Profil:</label>
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                            </div>

                            {{-- Multiple Upload --}}
                            <div class="col-12 mb-3">
                                <label for="files">Upload Multiple Files:</label>
                                <input type="file" name="files[]" id="files" class="form-control" multiple>
                            </div>
                            
                            {{-- Input Data Pelanggan --}}
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name"
                                    value="{{ old('first_name', $pelanggan->first_name) }}" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name"
                                    value="{{ old('last_name', $pelanggan->last_name) }}" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                    value="{{ old('birthday', $pelanggan->birthday) }}" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" disabled>-- Pilih --</option>
                                    <option value="Male" {{ old('gender', $pelanggan->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $pelanggan->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $pelanggan->gender) == 'Other' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $pelanggan->email) }}" required>
                            </div>

                            <div class="col-lg-6 col-sm-12 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $pelanggan->phone) }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="reset" class="btn btn-outline-warning">Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
