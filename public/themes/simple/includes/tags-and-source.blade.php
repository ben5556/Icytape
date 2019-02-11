@php $tags = array_filter(explode(',', $item->tags)); @endphp
	
@if(count($tags) >= 1 && !empty($tags))

	<div class="media_tags">
		
		<h4><i class="fa fa-tags"></i> {{ strtolower(__('lang.tags')) }}:</h4>

		<ul class="tags">
			@php $count = 0; @endphp
			@foreach($tags as $tag)
				
				@php $count += 1; @endphp
				
				<li><a href="{{ url('tags') . '/' . $tag }}">{{ $tag }}</a>@if(count($tags) != $count),@endif</li>

			@endforeach
		</ul>

	</div>

@endif

@if(isset($item->link_url) && $item->link_url != '')
	<div class="media_source">
		<i class="fa fa-globe"></i> {{ strtolower(__('lang.source')) }}: <a href="{{ $item->link_url }}" target="_blank" class="label label-success" style="margin-top:6px;">{{ $item->link_url }}</a>
	</div>
@endif

<br />