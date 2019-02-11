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

        <link rel="stylesheet" href="/{{ theme_folder('/assets/app.css') }}" />
        <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css"-->

        @yield('css')
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        @include('theme::functions')
        {!! dynamic_styles(); !!}

        @if(theme('custom_css'))
            <style>
                {!! theme('custom_css') !!}
            </style>
        @endif

        <link rel="icon" href="{{ Voyager::image( setting('site.favicon') ) }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ Voyager::image( setting('site.favicon') ) }}" type="image/x-icon">
        
    </head>
    <body class="{{ theme('color_scheme') }} @if(isset($show_random_bar) && $show_random_bar){{ 'random-bar' }}@endif @if(!Request::is('/')){{ str_replace('/', '-', Request::path()) }}@endif @if(isset($post_display)){{ $post_display }}@endif">
        <nav class="navbar navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">{{ __('lang.toggle_navigation') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logo" href="/">
                        <img src="{{ Voyager::image( theme('logo_dark') ) }}" class="logo-dark" />
                        <img src="{{ Voyager::image( theme('logo_light') ) }}" class="logo-light" />
                    </a>
                    
                    <div class="mobile-menu-toggle"><i class="fa fa-bars"></i></div>
                    <!-- MOBILE NAV -->
                    <div class="mobile-menu">
                        @if(!Auth::guest())
                            @php 
                                $user_profile = ''; 
                                if(isset($user->username)): $user_profile = $user; endif;
                                $user = Auth::user();
                                $user_points = DB::table('points')->where('user_id', '=', $user->id)->sum('points');
                            @endphp
                        
                            <a href="{{ url('user') . '/' . $user->username }}" class="usr-avatar"><img src="{{ Voyager::image($user->avatar) }}?version={{ uniqid() }}" alt="{{ $user->username }}" class="img-circle user-avatar-large"></a>
                            <a href="{{ url('user') . '/' . $user->username }}" class="username"><h2>@if(strlen(Auth::user()->username) > 14){{ substr(Auth::user()->username, 0, 14) . '...' }}@else{{ Auth::user()->username }}@endif</h2></a>
                            <p class="points"><i class="fa fa-star" style="color:gold"></i> {{ $user_points }} points</p>
                            <div id="avatar-bg"></div>
                        @endif

                        {{ menu('main', 'bootstrap', ['icon' => true]) }}

                        <ul class="nav navbar-nav navbar-right">
                            @if(Auth::guest())
                                <li class="@if(Request::is('login')){{ 'active' }}@endif"><a href="{{ url('login') }}">{{ __('lang.sign_in') }}</a></li>
                                <li class="@if(Request::is('signup')){{ 'active' }}@endif"><a href="{{ url('signup') }}">{{ __('lang.sign_up') }}</a></li>
                            @else
                                @php $user_points = DB::table('points')->where('user_id', '=', Auth::user()->id)->sum('points'); @endphp
                                <li class="dropdown">
                                    <a href="#" class="user-menu dropdown-toggle" data-toggle="dropdown"><b class="caret"></b><div id="user-info"><h4><i class="fa fa-gear"></i> {{ __('lang.settings') }}</h4></div> </a>
                                    <ul class="dropdown-menu">
                                        @if(Voyager::can('browse_admin'))
                                            <li><a href="{{ url('admin') }}" class="admin_link_mobile"><i class="fa fa-bolt"></i> {{ __('lang.admin') }}</a></li>
                                        @endif
                                        <li><a href="{{ url('user') . '/' . Auth::user()->username }}"><i class="fa fa-user"></i> {{ __('lang.my_profile') }}</a></li>
                                        <li><a href="{{ url('logout') }}" id="user_logout_mobile"><i class="fa fa-power-off"></i> {{ __('lang.logout') }}</a></li>
                                    </ul>
                                </li>
                            @endif
                                <li><a href="{{ url('upload') }}" class="upload-btn"><i class="fa fa-cloud-upload"></i> {{ __('lang.upload') }}</a></li>
                        </ul>
                    </div>
                </div>

                {{-- REGULAR MENU --}}
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    
                    {{ menu('main', 'bootstrap', ['icon' => true]) }}

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown dropdownNotifi">
                            @if(Auth::guest())
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i>
                                </a>
                            @else
                                <a href="#" class="dropdown-toggle readNotifi" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i>
                                    @php
                                        $notifications = DB::table('notifications')->where('user_id', '=', Auth::user()->id)->where('is_read','=',0)->get();
                                        $read_notifications = DB::table('notifications')->where('user_id', '=', Auth::user()->id)->where('is_read','=',1)->take(10)->orderBy('created_at', 'DESC')->get();
                                        $count =  count($notifications);
                                    @endphp
                                    @if($count > 0) 
                                        <span class="notifications">{{ $count }}</span> 
                                    @endif
                                </a>
                            @endif
                        </li>
                        <li><a href="{{ url('random') }}" class="random"><i class="fa fa-random"></i></a></li>
                        <li><a href="{{ url('upload') }}" class="upload-btn upload-btn-desktop"><i class="fa fa-cloud-upload"></i> {{ __('lang.upload') }}</a></li>

                        @if(Auth::guest())
                        
                            <li class="@if(Request::is('login')){{ 'active' }}@endif"><a href="{{ url('login') }}" id="login-button-desktop">{{ __('lang.sign_in') }}</a><div class="nav-border-bottom"></div></li>
                            <li class="@if(Request::is('signup')){{ 'active' }}@endif"><a href="{{ url('signup') }}" id="signup-button-desktop">{{ __('lang.sign_up') }}</a><div class="nav-border-bottom"></div></li>
                      
                        @else
                            @php $user_points = DB::table('points')->where('user_id', '=', Auth::user()->id)->sum('points'); @endphp
                            <li class="dropdown">
                                <a href="#" class="user-menu user-menu-desktop dropdown-toggle" data-toggle="dropdown"><img src="{{ Voyager::image(Auth::user()->avatar) }}" class="img-circle" /><b class="caret"></b><div id="user-info"><h4>@if(strlen(Auth::user()->username) > 8){{ substr(Auth::user()->username, 0, 8) . '...' }}@else{{ Auth::user()->username }}@endif</h4><p>{{ $user_points }} {{ __('lang.points') }}</p></div> </a>
                                <ul class="dropdown-menu dropdown-user-menu">
                                    @if(Voyager::can('browse_admin'))
                                        <li><a href="{{ url('admin') }}" class="admin_link_mobile"><i class="fa fa-bolt"></i> {{ __('lang.admin') }}</a></li>
                                    @endif
                                    <li><a href="{{ url('user') . '/' . Auth::user()->username }}" class="user-profile-link-desktop"><i class="fa fa-user"></i> {{ __('lang.my_profile') }}</a></li>
                                    <li><a href="{{ url('logout') }}" id="user_logout_desktop"><i class="fa fa-power-off"></i> {{ __('lang.logout') }}</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
        
        @if(theme('random_bar'))
            @include('theme::includes.random-bar')
        @endif
        
        {{-- If we are on the homepage show the social, search, and settings bar --}}
        @if(Request::is('/'))
            <div class="navbar gallery-sub-header" style="z-index:9;">
                <div class="container">
                    <div class="pull-left desc-follow">
                        <p class="website_desc pull-left">{{ setting('site.description') }}</p>
                        
                        <!-- HOME SOCIAL SECTION -->
                        @if(setting('site.twitter_username'))
                            <div class="twitter-follow pull-left">
                                <a href="https://twitter.com/{{ setting('site.twitter_username') }}" class="twitter-follow-button" data-show-count="false">{{ __('lang.follow_at') }}{{ setting('site.twitter_username') }}</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                            </div>
                        @endif

                        @if(setting('site.facebook_page'))
                            <div class="facebook-like pull-left">
                                <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2F{{ setting('site.facebook_page') }}&amp;width=&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:95px; height:21px;" allowTransparency="true"></iframe>
                            </div>
                        @endif

                        @if(setting('site.google_page'))
                            <div class="google-follow pull-left">
                                <!-- Place this tag where you want the widget to render. -->
                                <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/{{ setting('site.google_page') }}" data-rel="author"></div>
                                <!-- Place this tag after the last widget tag. -->
                                <script type="text/javascript">
                                (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/platform.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                })();
                                </script>
                            </div>
                        @endif
                        <!-- END HOME SOCIAL SECTION -->
                    </div>
                    <div class="pull-right mobile-pull-right">
                        <form class="navbar-form search-form col-xs-12" role="search" style="margin:0px; padding-top:4px;" action="{{ url('/') }}" method="GET">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="{{ __('lang.search') }}" style="-webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; height:30px;">
                            </div>
                        </form>
                        <div class="search_settings">
                            <i class="fa fa-search"></i>
                            @if(theme('sidebar_settings', 1))
                                <i class="fa fa-cog option-sidebar-toggle"><span class="cog-arrow-up fa fa-caret-up"></span><span class="cog-arrow-down fa fa-caret-down"></span></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>{{-- .navbar --}}
        @endif
        {{-- End if on the homepage --}}
                
        @yield('above_alert')
                
        @if(Session::get('note') != '' && Session::get('note_type') != '')
            <div class="container">
                <div class="alert alert-{{ Session::get('note_type') }}" style="margin-right:15px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('note') }}
                </div>
            </div>
            @php 
                Session::forget('note');
                Session::forget('note_type');
            @endphp
        @endif
                
        @yield('content')
                
        <div class="auth-modal auth-effect">
            <div class="auth-content" id="auth"></div>
        </div>
                
        <div id="modal_backdrop">
            <div class="la-ball-clip-rotate">
                <div></div>
            </div>
            <div id="modal">
                <div id="modal_close">&times;</div>
                <div id="modal_content">
                </div>
            </div>
        </div>
                
        <div class="auth-overlay">
            <div class="la-ball-clip-rotate">
                <div></div>
            </div>
        </div>

        @if(!Auth::guest())
            <div id="notibar">

                <div class="notibackground"></div>
                <div class="notisidebar">
                    <div class="notititlebar">
                        <p><i class="fa fa-bell"></i> Notifications</p>
                        <div class="noticlose">&times;</div>
                    </div>

                    <ul>
                    @foreach ($notifications as $notification)
                        <li class="unread">
                          <a id="{{ $notification->id }}" href="{{ $notification->url }}">
                            <i class="fa fa-bell"></i> {{ $notification->content }}
                          </a>
                        </li>
                    @endforeach
                    @foreach ($read_notifications as $read_notification)
                        <li class="read">
                          <a id="{{ $read_notification->id }}" href="{{ $read_notification->url }}">
                            <i class="fa fa-bell"></i>{{ $read_notification->content }}
                          </a>
                        </li>
                    @endforeach
                    </ul>

                </div>

            </div>
        @endif
                
        <div id="footer">&copy; {{ date('Y') . ' ' . setting('site.title') }}</div>
                
        <script type="text/javascript" src="/{{ theme_folder('/assets/app.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.viewing_options i').click(function(){
                    window.location = $(this).data('url');
                });
            });

            $(document).ready(function(){
                $('.option-sidebar-toggle').click(function(){
                    $(this).toggleClass('clicked');
                    $('.options_sidebar').slideToggle();
                    $('.cog-arrow-down').toggle();
                    $('.cog-arrow-up').toggle();
                });
                $('.fa-search').click(function(){
                    $('.search-form').toggle();
                    $('.search-form input').focus();
                });
            });

            $('document').ready(function(){

                $('#login-button-desktop, #signup-button-desktop').not('.login #login-button-desktop, .signup #login-button-desktop, .password-reset #login-button-desktop, .login #signup-button-desktop, .signup #signup-button-desktop, .password-reset #signup-button-desktop').click(function(event){
                    event.preventDefault();
                    $('.auth-overlay .la-ball-clip-rotate').show();
                    $('.auth-overlay').addClass('auth-show');
                    $( "#auth" ).load( $(this).attr('href') + ' .form-signin', function() {
            
                        $('.auth-modal').css('margin-top', -$('.form-signin').data('height')/2);
                        $('.auth-modal').css('margin-left', -$('.form-signin').data('width')/2);
                        $('.auth-modal').css('width', $('.form-signin').data('width'));
                        $('.auth-modal').css('height', $('.form-signin').data('height'));
                        $('.auth-modal').prepend('<i class="auth-overlay-close">&times;</i>');
                        $('.auth-overlay-close').click(function(){
                            $(this).remove();
                            $('.auth-overlay, .auth-modal').removeClass('auth-show');
                        });
                        
                        setTimeout(function(){
                            $('.auth-modal').addClass('auth-show');
                            $('.auth-overlay .la-ball-clip-rotate').hide();
                            setTimeout(function(){
                                $('.auth-modal').find("[data-focus='true']").focus();
                            }, 100);
                        }, 300);
            
                    });
                });
            
                $('.auth-overlay').click(function(){
                    $('.auth-overlay-close').remove();
                    $('.auth-overlay, .auth-modal').removeClass('auth-show');
                });
                
                $('.dropdown').hover(function(){
                    $(this).addClass('open');
                }, function(){
                    $(this).removeClass('open');
                });
                
                $('.dropdownNotifi').hover(function(){
                    $(this).removeClass('open');
                });
                
                $('.dropdownNotifi a').click(function(){
                    $(this).parent().find('.dropdown-menu').toggle();
                });
                
                NProgress.start();
                var slide_pos = 1;
                
                $('#random-right').click(function(){
                    if(slide_pos < 3){
                        $('#random-slider').css('left', parseInt($('#random-slider').css('left')) - parseInt($('.random-container').width()) -28 + 'px') ;
                        slide_pos += 1;
                    }
                });
                
                $('#random-left').click(function(){
                    if(slide_pos > 1){
                        $('#random-slider').css('left', parseInt($('#random-slider').css('left')) + parseInt($('.random-container').width()) +28 + 'px') ;
                        slide_pos -= 1;
                    }
                });
            });
            
            $(window).load(function () {
                NProgress.done();
            });

            $(window).resize(function(){
                jquery_sticky_footer();
            });

            $(window).bind("load", function() {
                jquery_sticky_footer();
            });
            
            function jquery_sticky_footer(){
                var footer = $("#footer");
                var pos = footer.position();
                var height = $(window).height();
                height = height - pos.top;
                height = height - footer.outerHeight();
            
                if (height > 0) {
                    footer.css({'margin-top' : height+'px'});
                }
            }

            /********** Mobile Functionality **********/
            var mobileSafari = '';
            $(document).ready(function(){
                $('.mobile-menu-toggle').click(function(){
                    $('.mobile-menu').toggleClass('mobile-menu-visible');
                    $('body').toggleClass('mobile-margin').toggleClass('body-relative');
                    $('.navbar').toggleClass('mobile-margin');
                    $('.mobile-menu').css('height', '100%');
                });
                // Assign a variable for the application being used
                var nVer = navigator.appVersion;
                // Assign a variable for the device being used
                var nAgt = navigator.userAgent;
                var nameOffset,verOffset,ix;
                
                
                // First check to see if the platform is an iPhone or iPod
                if(navigator.platform == 'iPhone' || navigator.platform == 'iPod'){
                // In Safari, the true version is after "Safari"
                    if ((verOffset=nAgt.indexOf('Safari'))!=-1) {
                        // Set a variable to use later
                        mobileSafari = 'Safari';
                    }
                }
            
            });

            /********** End Mobile Functionality **********/
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

            <script>
                var infScroll = '';
                @php $cur_page = (Input::get("page")) ? intval(Input::get('page')) + 1 : 2; @endphp
                var cur_page = '{{ $cur_page }}';
                @php $last_page = (isset($posts) && $posts->lastPage()) ? intval($posts->lastPage()) - intval($cur_page) : 1; @endphp
                var last_page = '{{ $last_page }}';
                /********** POST LIST JS **********/
                $('document').ready(function(){
                    $(".timeago").timeago();
                    
                    $.each($('.item'), function(index, value){
                        item_click_events($(value));
                    });

                    $('.readNotifi').click(function(){
                        $('#notibar').fadeIn('fast', function(){
                            $('.notisidebar').addClass('notishow');
                            $.post('/notification', { _token: $('meta[name="csrf-token"]').attr('content') }, function(data){
                                $('.notifications').fadeOut();
                            });
                        });
                    });

                    $('.notibackground, .noticlose').click(function(){
                        $('.notisidebar').removeClass('notishow');
                        $('#notibar').fadeOut();
                    });
                });

                @if(theme('pagination_type') != 'pagination')
                    $(document).ready(function(){
                        var $container = $('#posts');
                        var no_more_posts = "No More Posts to load";
                        var loading_more_posts = "Loading More Posts";
                
                        @if( $post_display != 'list' )
                            $container.imagesLoaded(function(){
                                $grid = $container.masonry();
                            });
                        @endif
                
                        $container.infiniteScroll({
                        
                            path: function() {
                                if ( parseInt(last_page) == -1 || this.loadCount > (parseInt(last_page)+1) ) {
                                    this.destroy();   
                                }
                                var nextPage = parseInt(cur_page) + (this.loadCount);
                                @if(isset($search))
                                    return '{{ Request::url('/') }}/?search=' + '{{ $search }}&page=' + nextPage;
                                @else
                                    return '{{ Request::url('/') }}/?page=' + nextPage;
                                @endif
                                
                            },
                    
                            prefill: false,
                            append: '.item',
                            status: '.page-load-status',
                            checkLastPage: false,
                            animate:false,
                            scrollThreshold: 1500,
                            history: false,
                    
                            @if(theme('pagination_type') == 'load_more')
                            
                                loadOnScroll: false,
                                button: '.load-more-btn',
                    
                            @endif
                        });

                        infScroll = $container.data('infiniteScroll');
                
                        $container.on( 'append.infiniteScroll', function( event, response, path, items ) {
                    
                            $.each($(items), function(index, value){
                                item_click_events($(value));
                            });
                        
                            @if( $post_display != 'list' )
                                $( items ).css({ opacity: 0 });
                                $(items).imagesLoaded(function(){
                                    var $newElems = $( items );
                                    $newElems.animate({ opacity: 1 });
                                    $('#posts').masonry( 'appended', $newElems, true);
                                });
                            @endif

                            if ( parseInt(last_page) == -1 || infScroll.loadCount > (parseInt(last_page)+1) ) {
                                    
                                    $('.page-load-status').show();
                                    $('.page-load-status .infinite-scroll-request').hide();
                                    $('.page-load-status .infinite-scroll-last').show();
                                }

                        });
                    });


                
                @endif

                function toggle_gif(img, icon){
                
                    if($(img).data('state') == 0){
                        play_gif(img, icon);
                    } else {
                        stop_gif(img, icon);
                    }
                }

                function play_gif(img, icon){
                    $(img).attr('src', $(img).data('animation'));
                    $(img).data('state', 1);
                    $(icon).fadeOut();
                }

                function stop_gif(img, icon){
                    $(img).attr('src', $(img).data('original'));
                    $(img).data('state', 0);
                    $(icon).fadeIn();
                }

                function item_click_events(item){
                    //if($(item).find('.video_container').length){
                    $(item).find('.video_container').fitVids();
                    //}
                    item_gif_vine_events(item);
                
                    post_like = $(item).find('.home-post-like');
                
                    $(post_like).click(function(){
                        if($(this).data('authenticated') == false){
                            window.location = '{{ url("signup") }}';
                        }
                
                        this_object = $(this);
                        $(this).children('i').removeClass('animated').removeClass('rotateIn');
                        $(this_object).toggleClass('active');
                
                        var like_count = $(this_object).parent().find('.home-like-count span');
                
                        if($(this_object).hasClass('active')){
                            $(this_object).children('i').addClass('animated').addClass('bounceIn');
                            like_count.text( parseInt(like_count.text()) + 1 );
                        } else {
                            like_count.text( parseInt(like_count.text()) - 1 );
                        }
               
                        $.post("{{ url('post') . '/add_like' }}", { post_id: $(this).data('id') }, function(data){ });
                    });
                }

                function item_gif_vine_events(object){
                
                    var gifs = $(object).find('.animated-gif .animation');
                    var gif_play = $(object).find('.gif-play');
                    gif_click(gifs);
                    gif_click(gif_play);
                    var vine = $(object).find('.vine-thumbnail');
                    var vine_play = $(object).find('.vine-thumbnail-play');
                    vine_click(vine);
                    vine_click(vine_play);
                }

                function gif_click(object){
                    $(object).click(function(){
                        animated_gif = $(this).parent('.animated-gif').find('.animation');
                        play_icon = $(this).parent('.animated-gif').find('.gif-play');
                        toggle_gif(animated_gif, play_icon);
                    });
                }
                
                function vine_click(object){
                    $(object).click(function(){
                        var embed = $(this).data('embed');
                        $(this).parent('.video_container').html('<iframe class="vine-embed" src="' + embed + '" width="100%" height="600" frameborder="0"></iframe>');
                    });
                }
            </script>
        
        @yield('javascript')
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script-->
    </body>
</html>