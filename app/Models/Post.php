<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter(Builder $query, array $filters): void // in the future when posts needs to be filtered using any other keys, the $filters array can be used
    {
        $query->when(
            // only execute callback function if the condition/when is true
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query
                ->where( // Logical grouping of queries: https://laravel.com/docs/10.x/queries#logical-grouping
                    fn($query) =>
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%')
                )

        );

        // above code is equivalent to this
        // if ($filters['search'] ?? false) {
        //     $query
        //         ->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
            $query
                // ->whereExists(
                //     fn($query) =>
                //     $query
                //         ->from('categories')
                //         ->whereColumn('categories.id', 'posts.category_id')
                //         ->where('categories.slug', $category)
                // );
                ->whereHas(
                    'category',
                    fn($query) => // The 'category' refers to a relationship of the Post model, ie, line 47
                    $query->where('slug', $category) // find the category [of the posts] where the category.slug is equal to the slug entered in the query ($category) and return the posts of the category that was just found
                ) // This is functionally equivalent to the above commented whereExists() query but shorter and easier to read
        );

        $query->when(
            $filters['author'] ?? false,
            fn($query, $author) => // only execute callback function if the condition/when is true
            $query
                ->whereHas(
                    'author',
                    fn($query) =>
                    $query->where('username', $author)
                )
        );
    }

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

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
