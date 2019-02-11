<div class="video_container @if(strpos($item->vid_url, 'vine') > 0){{ 'vine' }}@endif" @if(!empty($view) && $view == 'single')itemprop="video" itemscope itemtype="http://schema.org/VideoObject"@endif>
					
	@if(!empty($view) && $view == 'single')
		<meta itemprop="thumbnailUrl" content="{{ Voyager::image($item->pic_url) }}" />
		<meta itemprop="embedUrl" content="{{ $item->vid_url }}" />
		<meta itemprop="name" content="{{ stripslashes($item->title) }}" />
		@if($settings->media_description && isset($item->description) && !empty($item->description))
			<span itemprop="description">{{ $item->description }}</span>
		@endif
	@endif


	<!-- YOUTUBE VIDEO -->
	@if(strpos($item->vid_url, 'youtube') > 0 || strpos($item->vid_url, 'youtu.be') > 0)
        
		<iframe title="YouTube video player" class="youtube-player" type="text/html" width="640"
height="360" src="http://www.youtube.com/embed/{{ $item->youtubeVideoId() }}?theme=light&rel=0" frameborder="0"
allowFullScreen></iframe>

   

    <!-- VIMEO VIDEO -->
    @elseif(strpos($item->vid_url, 'vimeo') > 0)
        @php 
        	$vimeo_id = (int)substr(parse_url($item->vid_url, PHP_URL_PATH), 1);
        @endphp

        <iframe src="//player.vimeo.com/video/{{ $vimeo_id }}" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    
    <!-- VINE Video -->
    @elseif(strpos($item->vid_url, 'vine') > 0)
    	@php 
    		$include_embed = (strpos($item->vid_url, '/embed') > 0) ? '' : '/embed'; 
    	@endphp

    	<img class="single-media vine-thumbnail" style="cursor:pointer;" alt="..." src="{{ Voyager::image($item->pic_url) }}" data-embed="{{ $item->vid_url . $include_embed }}/simple?audio=1" />
    	<p class="vine-thumbnail-play" data-embed="{{ $item->vid_url . $include_embed }}/simple?audio=1" style="color:#fff; color:rgba(255, 255, 255, 0.6); font-size:50px; position:absolute; z-index:999; width:50px; height:50px; top:50%; left:50%; margin:0px; padding:0px; margin-left:-30px; margin-top:-30px; cursor:pointer;"><i class="fa fa-play-circle-o"></i></p>
    	
    @endif

</div> <!-- .video_container -->


