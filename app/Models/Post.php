<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo // Laravel assumes that the foreign key is called category_id which is deduced from the function name
    {
        return $this->belongsTo(Category::class);
    }

    // public function user(): BelongsTo // foreign key is assumed to be user_id
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function author(): BelongsTo // foreign key is assumed to be author_id but overridden using parameter in belongsTo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
