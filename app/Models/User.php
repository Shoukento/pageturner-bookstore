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
        'role',
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

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function hasPurchasedBook(Book $book)
    {
        return $this->orders()
            ->where('status', 'completed')
            ->whereHas('items', function ($query) use ($book) {
                $query->where('book_id', $book->id);
            })
            ->exists();
    }

    // Helper method
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}