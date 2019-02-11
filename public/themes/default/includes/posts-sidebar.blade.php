@php
	$sidebar_posts = App\Models\Post::where('active', '=', 1)->inRandomOrder()->take(6)->get();
@endphp

<ul class="sidebar_posts">
	@foreach($sidebar_posts as $sidebar_post)

		<li>
			<a href="{{ url($sidebar_post->slug) }}">
				<img alt="{{ stripslashes($sidebar_post->title) }}" src="{{ $sidebar_post->sidebarImage() }}">
				<span>{{ stripslashes($sidebar_post->title) }}</span>
			</a>
		</li>

	@endforeach
</ul>