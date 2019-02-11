<!DOCTYPE html>
<html>
<head>

	@if(isset($seo_title))
        <title>{{ $seo_title }}</title>
    @else
        <title>{{ setting('site.title') }} - {{ setting('site.description') }}</title>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Social Share Open Graph Meta Tags --}}
    @if(isset($seo_title) && isset($seo_description) && isset($seo_image))
        <meta property="og:title" content="{{ $seo_title }}">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:image" content="{{ $seo_image }}">
        <meta property="og:type" content="article">
        <meta property="og:description" content="{{ $seo_description }}">
        <meta property="og:site_name" content="{{ setting('site.title') }}">

        <meta itemprop="name" content="{{ $seo_title }}">
        <meta itemprop="description" content="{{ $seo_description }}">
        <meta itemprop="image" content="{{ $seo_image }}">

        @if(isset($seo_image_w) && isset($seo_image_h))
            <meta property="og:image:width" content="{{ $seo_image_w }}">
            <meta property="og:image:height" content="{{ $seo_image_h }}">
        @endif
    @endif

    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">

    @if(isset($seo_description))
        <meta name="description" content="{{ $seo_description }}">
    @endif

    <link rel="stylesheet" href="/{{ theme_folder('/assets/css/style.css') }}" />
    <link rel="stylesheet" href="/{{ theme_folder('/assets/css/font-awesome.min.css') }}" />
    @include('theme::functions')
    {!! dynamic_styles(); !!}

    @if(theme('custom_css'))
        <style>
            {!! theme('custom_css') !!}
        </style>
    @endif
    <script type="text/javascript" src="/{{ theme_folder('/assets/js/jquery-1.11.1.min.js') }}"></script>
    <meta name="viewport" content="width=640, initial-scale=1">

</head>
<body>
<header>
	<a class="navbar-brand logo" href="{{ url('/') }}"><img src="{{ Voyager::image( theme('logo') ) }}" /></a>

	<ul id="auth">

		<li><a href="{{ url('upload') }}" class="primary_color_background"><i class="fa fa-cloud-upload"></i> <?= Lang::get('lang.upload') ?></a></li>
		

		@if(Auth::guest())
			<li><a href="<?= URL::to('signup') ?>"><?= Lang::get('lang.sign_up') ?></a></li>
			<li><a href="<?= URL::to('login') ?>"><?= Lang::get('lang.sign_in') ?></a></li>
		@else
				
	        @if(Voyager::can('browse_admin'))
	          <li><a href="<?= URL::to('admin') ?>" class="admin_link_mobile"><i class="fa fa-bolt"></i> <?= Lang::get('lang.admin') ?></a></li>
	        @endif
	        <li><a href="<?= URL::to('user') . '/' . Auth::user()->username; ?>"><i class="fa fa-user"></i> <?= Lang::get('lang.profile') ?></a></li>
	        <li><a href="<?= URL::to('logout') ?>" id="user_logout_mobile"><i class="fa fa-power-off"></i> <?= Lang::get('lang.logout') ?></a></li>
		
		@endif
	</ul>
</header>

<div class="clear"></div>

<subheader>
	<h2>{{ setting('site.description') }}</h2>
</subheader>

<?php if (Session::has('note')): ?>
    <span class="notification {{ Session::get('note_type') }}"><?= Session::get('note'); ?></span>
<?php endif; ?>

<div id="menu_wrap">
	<div id="menu">
		{{ menu('main', 'theme::menu') }}
	</div>

	<form class="navbar-form search-form col-xs-12" role="search" style="margin:0px; padding-top:4px;" action="<?= URL::to('/') ?>" method="GET">
		<div class="form-group">
	    	<input type="text" id="search" class="form-control" name="search" placeholder="<?= strtolower(Lang::get('lang.search')) ?>">
		</div>
	</form>
</div>

<div class="clear"></div>

@yield('content')


<script type="text/javascript" src="/{{ theme_folder('/assets/js/jquery.fitvid.js') }}"></script>
<script>
$(document).ready(function(){
	$('.item').find('.video_container').fitVids();

	$('.vine-thumbnail, .vine-thumbnail-play').click(function(){
		console.log('test');
		var embed = $(this).data('embed');
		$(this).parent('.video_container').html('<iframe class="vine-embed" src="' + embed + '" width="100%" height="600" frameborder="0"></iframe>');
	});
});
</script>

<script>
$(document).ready(function(){
	$('img.animation, .gif-play').click(function(){
		$(this).parent().find('.animation-play').show();
		$(this).parent().find('.gif-play').hide();
		$(this).parent().find('.animation').hide();
	});

	$('img.animation-play').click(function(){
		$(this).parent().find('.animation-play').hide();
		$(this).parent().find('.gif-play').show();
		$(this).parent().find('.animation').show();
	});
});
</script>

<script>

// Media Like Click Functionality
$(document).ready(function(){

	$('.media-like').click(function(){
		// If user is not logged in redirect them to the signup page
		if($(this).data('authenticated') == false){
			window.location = '<?= URL::to("signup") ?>';
		}

		// Toggle the Active Class
		$(this).toggleClass('active');
		
		// Increment or Decrement the Like Count
		like_count = $(this).parent().find('.like-count');
		if($(this).hasClass('active')){
			like_count.text( parseInt(like_count.text()) + 1 );
		} else {
			like_count.text( parseInt(like_count.text()) - 1 );
		}

		// POST THE LIKE
		$.post("{{ url('post') . '/add_like' }}", { post_id: $(this).data('id') });
	});
});

</script>

@if(theme('custom_js'))
    <script>
        {!! theme('custom_js') !!}
    </script>
@endif

@if(setting('site.google_analytics_tracking_id'))

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', '{{ setting("site.google_analytics_tracking_id") }}', 'auto');
        ga('send', 'pageview');
    </script>

@endif

</body>
</html>