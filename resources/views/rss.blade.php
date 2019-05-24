{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}

<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:media="http://search.yahoo.com/mrss/">

    <channel>

        <title>{{ config('app.name') }}</title>

        <link>{{ route('base') }}</link>

        <description><![CDATA["News Portal Application"]]></description>

        <atom:link href="{{asset('storage/rss.xml')}}" rel="self" type="application/rss+xml" />

        <language>{{ app()->getLocale() }}</language>

        <lastBuildDate>{{ $lastBuildDate }}</lastBuildDate>

        @foreach($articles as $article)

            <item>

                <title><![CDATA[{!! $article->title !!}]]></title>

                <link>{{ route('articles.show', ['id' => $article->id]) }}</link>

                <guid isPermaLink="true">{{ route('articles.show', ['id' => $article->id]) }}</guid>

                <description><![CDATA[{!! $article->preview( app()->make(\App\Services\Summarizers\RssSummarizer::class)) !!}]]></description>

                <content:encoded><![CDATA[{!! $article->body !!}]]></content:encoded>

                <dc:creator xmlns:dc="http://purl.org/dc/elements/1.1/">{{ $article->author->name }}</dc:creator>

                <pubDate>{{ $article->created_at->format(DateTime::RSS) }}</pubDate>

            </item>

        @endforeach

    </channel>

</rss>
