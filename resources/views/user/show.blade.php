<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('resources/css/style.css') }}">
<x-layout>
    <div class="container d-flex justify-content-center align-items-center">

        <div class="card">

            <div class="upper" style="width: 100px">

                <img src="https://avatar.iran.liara.run/public/?username={{ $author->username }}" class="img-fluid">

            </div>

            <div class="user text-center">

            </div>


            <div class="mt-5 text-center">

                <h4 class="mb-0">{{ $author->name }}</h4>

                @if (auth()->id() !== $author->id)
                    <form action="/author/{{ $author->id }}/follow" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm follow">Follow</button>
                    </form>

                    <form action="{{ route('unfollow.author', $author) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Unfollow</button>
                    </form>
                @endif

                <div class="d-flex justify-content-between align-items-center mt-4 px-4 space-x-3">

                    <div class="stats">
                        <h6 class="mb-0">Following</h6>
                        <span>{{ count($author->follows) }}</span>

                    </div>

                    <div class="stats">
                        <h6 class="mb-0">Followers</h6>
                        <span>{{ count($author->followers) }}</span>

                    </div>


                    <div class="stats">
                        <h6 class="mb-0"><a href="/?author={{ $author->username }}">Posts</a></h6>
                        <span>{{ count($author->posts) }}</span>

                    </div>

                </div>

            </div>

        </div>

    </div>
</x-layout>
