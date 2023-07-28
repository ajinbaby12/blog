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
    <?php foreach($posts as $post): ?>
    <article>
        <h1><a href="/post/@php
                echo $post->slug;
            @endphp">
            @php
                echo $post->title;
            @endphp
        </a></h1>
        @php
            echo $post->excerpt;
        @endphp

    </article>
    <?php endforeach; ?>
</body>

</html>
