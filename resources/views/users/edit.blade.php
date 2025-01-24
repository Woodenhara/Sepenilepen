@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="page-heading">
    <h3>Edit User</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</section>
@endsection
