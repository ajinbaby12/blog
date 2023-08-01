<x-layout>

    <x-posts-header :categories="$categories" />
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <x-post-featured-card :post="$posts[0]" />

        @if ($posts->count())
            <x-posts-grid :posts="$posts" />
        @else
            <p>No posts yet</p>
        @endif

    </main>

    {{-- @foreach ($posts as $post)
    <article>
        <h1>
            <a href="/post/{{$post->slug}}">
                {{$post->title}}
            </a>
        </h1>
        <p>
            By <a href="/authors/{{$post->author->username}}">{{$post->author->name}}</a>
            in <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}
            </a>
        </p>
        {{$post->excerpt}}
    </article>
    @endforeach --}}
</x-layout>
