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
        <h1>@php
            echo $post->title;
        @endphp</h1>

        <p>
            @php
                echo $post->body;
            @endphp
        </p>
    </article>

    <a href="/">Go back</a>
</body>

</html>
