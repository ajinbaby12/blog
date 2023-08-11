<?=
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0">
    <channel>
        @foreach ($posts as $post)
            <item>
                <title>
                    <![CDATA[{{ $post->title }}]]>
                </title>
                <link>{{ $post->slug }}</link>
                <description>
                    <![CDATA[{!! $post->body !!}]]>
                </description>
                <category>{{ $post->category }}</category>
                <author>
                    <![CDATA[{{ $post->author->username }}]]>
                </author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
