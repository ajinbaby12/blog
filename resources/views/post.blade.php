<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Blog</title>

    <link rel="stylesheet" href="/app.css">
</head>

<body>
    <article>
        <h1>{{$post->title}}</h1>

        <p>
            {!!$post->body!!} {{-- $post->body contains <p> tag which will be escaped if double curly braces is used --}}
        </p>
    </article>

    <a href="/">Go back</a>
</body>

</html>
