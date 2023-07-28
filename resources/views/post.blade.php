<x-layout>
    <article>
        <h1>{{$post->title}}</h1>

        <p>
            {!!$post->body!!} {{-- $post->body contains <p> tag which will be escaped if double curly braces is used --}}
        </p>
    </article>

    <a href="/">Go back</a>
</x-layout>
