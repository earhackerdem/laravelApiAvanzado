<?php

namespace App\Models;

use App\Utils\CanBeRate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, CanBeRate;

    protected $guarded = [];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
