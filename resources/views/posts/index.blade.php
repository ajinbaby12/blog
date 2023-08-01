<x-layout>
    <x-posts-header :categories="$categories" />
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        @if ($posts->count())
            <x-post-featured-card :post="$posts[0]" />
            <x-posts-grid :posts="$posts" />
        @else
            <p>No posts yet</p>
        @endif

    </main>
</x-layout>
