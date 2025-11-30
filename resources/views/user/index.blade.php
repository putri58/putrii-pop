@extends('layouts.admin.app')

@section('content')

<div class="py-4">

    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Volt</a></li>
            <li class="breadcrumb-item active" aria-current="page">User / Tabel User</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data User</h1>
            <p class="mb-0">Tabel dari list user</p>
        </div>
        <div>
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                Tambah User
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">

                    {{-- FILTER & SEARCH --}}
                    <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="verified" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="verified" {{ request('verified') == 'verified' ? 'selected' : '' }}>
                                        Unverified
                                    </option>
                                    <option value="unverified" {{ request('verified') == 'unverified' ? 'selected' : '' }}>
                                        Verified
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Search">

                                    <button type="submit" class="input-group-text">Search</button>

                                    @if (request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                            class="btn btn-outline-secondary ms-2">
                                            Clear
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- TABLE --}}
                    <table id="table-user" class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th>Detail</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    {{-- TOMBOL DETAIL --}}
                                    <td>
                                        <a href="{{ route('profile.show', $item->id) }}" 
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    </td>

                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->password }}</td>

                                    <td>

                                        {{-- TOMBOL EDIT --}}
                                        <a href="{{ route('user.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                            ✏️ Edit
                                        </a>

                                        {{-- TOMBOL DELETE --}}
                                        <form action="{{ route('user.destroy', $item->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                🗑️ Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $user->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
