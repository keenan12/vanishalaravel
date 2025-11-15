<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'theme',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * ✅ PERBAIKAN: Get avatar URL dengan path yang benar
     * Avatar di database disimpan sebagai: avatars/xxx.jpg
     * Jadi langsung pakai: storage/{avatar}
     */
    public function getAvatarUrl()
    {
        if ($this->avatar) {
            // ✅ BENAR - Langsung pakai path dari database
            return asset('storage/' . $this->avatar);
        }
        // Fallback ke UI Avatars dengan ukuran 240px (bukan 40px)
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=667eea&color=fff&size=240';
    }

    /**
     * Get user initials (2 huruf pertama dari nama)
     */
    public function getInitials()
    {
        $parts = explode(' ', $this->name);
        $initials = '';
        foreach ($parts as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    /**
     * Check apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check apakah user adalah customer
     */
    public function isCustomer()
    {
        return $this->role === 'customer';
    }
}
