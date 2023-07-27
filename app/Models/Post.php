<?php
// This model is responsible for interacting with the 'posts' database
// Will fetch, insert, edit posts etc.

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Post
{
    public static function all()
    {
        $files = File::files(resource_path("posts"));
        return array_map(function ($file) {
            return $file->getContents();
        }, $files);
    }

    public static function find($slug)
    {

        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        $post = Cache::remember("posts.{$slug}", 5, function () use ($path) {
            return file_get_contents($path); // this function is expensive and is called each time a user accesses the post.
        }); // caches the file. Thus file_get_contents is only called after the expiry of the cache(5 seconds here)

        return $post;
    }
}

?>
