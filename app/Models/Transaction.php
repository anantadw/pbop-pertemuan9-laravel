<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * The books that belong to the transaction.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'transaction_book', 'transaction_id', 'book_id');
    }

    /**
     * Get the borrower of the transaction.
     */
    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }
}
