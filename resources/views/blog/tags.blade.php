@unless ($blog->tags->isEmpty())
	<p><small><i><strong>Labels:</strong>
	@foreach($blog->tags as $tag)
		<a href="{{ action('BlogController@tags', [$tag->name]) }}">{{ $tag->name }}@unless($loop->last),
		@endunless</a>
	@endforeach</i></small>
@endif