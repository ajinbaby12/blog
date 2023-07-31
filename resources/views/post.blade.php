<x-layout>
    <article>
        <h1>{{$post->title}}</h1>
        <p>
            By <a href="/user/{{$post->author->id}}">{{$post->author->name}}</a>
            in <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
        </p>

        {!!$post->body!!} {{-- $post->body contains <p> tag which will be escaped if double curly braces is used --}}
    </article>

    <a href="/">Go back</a>
</x-layout>
