<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionBook extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_book';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'book_id',
        'created_at',
        'updated_at'
    ];
}
