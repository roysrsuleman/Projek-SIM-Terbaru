@extends('layouts.admin')
@section('title', 'Tambah Pejabat Desa')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pejabat-desa.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_pejabat">Nama Lengkap (beserta gelar)</label>
                    <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat"
                        value="{{ old('nama_pejabat') }}">
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}"
                        placeholder="Contoh: KEPALA DESA">
                </div>
                <div class="form-group">
                    <label>NIP (Opsional)</label>
                    <input type="text" class="form-control" name="nip" value="{{ old('nip', $pejabat->nip ?? '') }}"
                        placeholder="Kosongkan jika tidak ada">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir (Untuk Hitung Umur)</label>
                    <input type="date" class="form-control" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $pejabat->tanggal_lahir ?? '') }}">
                </div>
                <a href="{{ route('pejabat-desa.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection