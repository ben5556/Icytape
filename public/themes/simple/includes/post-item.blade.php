<div class="item">

	<h3><a href="{{ url($item->slug) }}" alt="{{ $item->title }}">{{ $item->title }}</a></h3>
	<h4>{{ strtolower(__('lang.posted_by')) }}: 
		<a href="{{ url('user') . '/' . $item->user()->username }}">{{ $item->user()->username }}</a> <span class="time">{{ date("F j, Y", strtotime($item->created_at)) }}</span>
		<i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}"></i> <span class="like-count">{{ count($item->post_likes) }}</span>
		<i class="fa fa-comments"></i> <span>{{ count($item->comments) }}</span>
		<i class="fa fa-eye"></i> <span>@if(isset($view_increment) && $view_increment == true ){{ $item->views + 1 }}@else{{ $item->views }}@endif</span>
	</h4>
	
	<!-- Media Like Button -->
	@if(!Auth::guest())
		@php $liked = App\Models\PostLike::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $item->id)->first(); @endphp
	@endif

	<div class="media-like @if(isset($liked->id)){{ 'active' }}@endif" data-authenticated="@if(Auth::guest()){{ 'false' }}@else{{ 'true' }}@endif" data-id="{{ $item->id }}"><i class="fa {{ theme('like_icon', 'fa-thumbs-up') }}"></i></div>

	<div class="post-item">
		@if($item->vid != 1)
			@include('theme::includes.image')
		@else
			@include('theme::includes.video')
		@endif
	</div>

</div>