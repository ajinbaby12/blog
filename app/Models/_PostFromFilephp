<?php
// This model is responsible for interacting with the 'posts' database
// Will fetch, insert, edit posts etc.

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    public $title;

    public $excerpt;

    public $date;

    public $slug;

    public $body;

    public function __construct($title, $excerpt, $date, $slug, $body)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->slug = $slug;
        $this->body = $body;
    }

    public static function all()
    { // finds all the blog posts sorted by their date
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts")))
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                ->map(
                    fn($document) =>
                    new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->slug,
                        $document->body()
                    )
                )
                ->sortByDesc('date');
        });
        // returns a collection of Post objects
    }


    public static function find($slug)
    { // finds the blog post with matching slug
        if(! file_exists(resource_path("posts/{$slug}.html"))){
            throw new ModelNotFoundException();
        }
        return static::all()->firstWhere('slug', $slug);
    }
}

?>
