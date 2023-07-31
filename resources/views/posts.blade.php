<x-layout>
    @foreach ($posts as $post)
    <article>
        <h1>
            <a href="/post/{{$post->slug}}">
                {{$post->title}}
            </a>
        </h1>
        <p>
            By <a href="#">{{$post->user->name}}</a>
            in <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}
            </a>
        </p>
        {{$post->excerpt}}
    </article>
    @endforeach
</x-layout>
