@extends('layouts.app')

@section('title', $title = (!$data->exists ? 'Tambah ' : 'Edit ') . 'User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ !$data->exists ? 'Tambah User' : 'Edit User' }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ !$data->exists ? route('users.store') : route('users.update', $data->id) }}"
                                method="{{ !$data->exists ? 'POST' : 'POST' }}">
                                @csrf
                                @if ($data->exists)
                                    @method('PUT')
                                @endif
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name', $data->exists ? $data->name : '') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', $data->exists ? $data->email : '') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" {{ !$data->exists ? '' : 'disabled' }}>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone', $data->exists ? $data->phone : '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Peran</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="roles" value="admin"
                                                    class="selectgroup-input"
                                                    {{ $data->roles == 'admin' || !$data->exists ? 'checked' : '' }}>
                                                <span class="selectgroup-button">Admin</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="roles" value="dosen"
                                                    class="selectgroup-input"
                                                    {{ $data->roles == 'dosen' ? 'checked' : '' }}>
                                                <span class="selectgroup-button">Dosen</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="roles" value="mahasiswa"
                                                    class="selectgroup-input"
                                                    {{ $data->roles == 'mahasiswa' ? 'checked' : '' }}>
                                                <span class="selectgroup-button">Mahasiswa</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Alamat</label>
                                        <textarea class="form-control" data-height="150" name="address">{{ old('address', $data->exists ? $data->address : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
