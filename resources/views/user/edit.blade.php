<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.admin.css')
</head>

<body>

    @include('layouts.admin.sidebar')

    <main class="content">

        @include('layouts.admin.header')

        <div class="py-4">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Edit User</h1>
                    <p class="mb-0">Perbarui data pengguna</p>
                </div>
                <div>
                    <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12 mb-4">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card border-0 shadow components-section">
                        <div class="card-body">

                            @if (session('success'))
                                <div class="alert alert-info">
                                    {!! session('success') !!}
                                </div>
                            @endif

                            <div class="row mb-4">
<label for="profile_picture">Foto Profil:</label>
<input type="file" name="profile_picture" id="profile_picture" class="form-control">

                                {{-- Name --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                               value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>

                                {{-- Password (optional) --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label>Password (opsional)</label>
                                        <input type="password" class="form-control" name="password"
                                               placeholder="Isi jika ingin mengganti password">
                                    </div>
                                </div>

                                {{-- Password confirmation --}}
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label>Password Confirmation</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                               placeholder="Ulangi password baru (jika diganti)">
                                    </div>
                                </div>

                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark me-2">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-outline-warning">Batal</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>

        @include('layouts.admin.footer')

    </main>

    @include('layouts.admin.js')

</body>

</html>
