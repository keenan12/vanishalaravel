@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / Kategori
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>Daftar Kategori</span>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary" style="padding: 4px 8px; font-size: 12px;">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 12px;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #999;">Tidak ada data kategori</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
