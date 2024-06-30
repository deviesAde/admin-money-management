<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'tanggal',
        'amount',
        'description',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);

    }
    //scope expense
    public function scopeExpense($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->where('is_expense', true);
        });
    }

    //scope income
    public function scopeIncome($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->where('is_expense', false);
        });
    }
}

