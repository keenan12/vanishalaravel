@extends('layouts.app')

@section('breadcrumb')
    Dashboard / User Management
@endsection

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <span>👥 Manajemen User</span>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th> <!-- ⭐ TAMBAHKAN INI -->
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <!-- ⭐ TAMBAHKAN INI -->
                    <td>
                        @if($user->role == 'admin')
                            <span style="background: #667eea; color: white; padding: 3px 8px; border-radius: 4px; font-size: 11px;">Admin</span>
                        @else
                            <span style="background: #95a5a6; color: white; padding: 3px 8px; border-radius: 4px; font-size: 11px;">Customer</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada user</td> <!-- ⭐ UPDATE COLSPAN -->
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding: 15px; display: flex; justify-content: center;">
        {{ $users->links() }}
    </div>
</div>

@endsection
