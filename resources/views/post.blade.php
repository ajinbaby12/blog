<x-layout>
    <article>
        <h1>{{$post->title}}</h1>

        {!!$post->body!!} {{-- $post->body contains <p> tag which will be escaped if double curly braces is used --}}
    </article>

    <a href="/">Go back</a>
</x-layout>
