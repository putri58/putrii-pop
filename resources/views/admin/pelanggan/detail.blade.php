@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Detail Pelanggan</h3>
        <div>
            <a href="{{ route('pelanggan.edit', $pelanggan->pelanggan_id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- ALERTS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- INFORMASI PELANGGAN -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> Informasi Pelanggan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Lengkap:</strong><br>
                    {{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</p>
                    
                    <p><strong>Email:</strong><br>
                    {{ $pelanggan->email }}</p>
                    
                    <p><strong>Telepon:</strong><br>
                    {{ $pelanggan->phone ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jenis Kelamin:</strong><br>
                    {{ $pelanggan->gender ?? '-' }}</p>
                    
                    <p><strong>Tanggal Lahir:</strong><br>
                    {{ $pelanggan->birthday ? \Carbon\Carbon::parse($pelanggan->birthday)->format('d/m/Y') : '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- GAMBAR/FILE PELANGGAN -->
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span>
                <i class="fas fa-images"></i> File & Gambar 
                @if($files && count($files) > 0)
                    <span class="badge bg-light text-dark ms-2">{{ count($files) }}</span>
                @endif
            </span>
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-plus"></i> Upload File
            </button>
        </div>
        <div class="card-body">
            @if($files && count($files) > 0)
                <div class="row">
                    @foreach($files as $file)
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            @if(in_array($file->mime_type, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']))
                                <img src="{{ Storage::url($file->file_path) }}" 
                                     class="card-img-top" 
                                     alt="{{ $file->file_name }}"
                                     style="height: 200px; object-fit: cover; cursor: pointer;"
                                     onclick="openImageModal('{{ Storage::url($file->file_path) }}')">
                            @else
                                <div class="card-body text-center d-flex flex-column justify-content-center" style="height: 200px;">
                                    <i class="fas fa-file fa-3x text-secondary mb-2"></i>
                                    <small class="text-muted">{{ pathinfo($file->file_name, PATHINFO_EXTENSION) }}</small>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title text-truncate" title="{{ $file->file_name }}">
                                    {{ $file->file_name }}
                                </h6>
                                <small class="text-muted">
                                    {{ number_format($file->file_size / 1024, 2) }} KB<br>
                                    {{ $file->created_at->format('d/m/Y H:i') }}
                                </small>
                                <div class="mt-2 d-flex gap-1">
                                    <a href="{{ Storage::url($file->file_path) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-info flex-fill">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('pelanggan.deleteFile', $file->id) }}" 
                                          method="POST" 
                                          class="d-inline flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" 
                                                onclick="return confirm('Hapus file ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada file atau gambar yang diupload</p>
                </div>
            @endif
        </div>
    </div>

</div>

<!-- Modal Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    new bootstrap.Modal(document.getElementById('imageModal')).show();
}
</script>
@endpush