<div class="col-md-4 col-lg-4" id="sidebar_container">

	@if(theme('sidebar_settings', 1))
		@include('theme::includes.sidebar_settings')
	@endif

	<div id="sidebar_inner">
		<div id="sidebar" <?php if(isset($single) && $single): ?>class="single_sidebar"<?php endif; ?>>

			<?php if(isset($single) && $single): ?>

				@include('theme::includes.sidebar-prev-next')
				<div class="clear"></div>
				@include('theme::includes.media-tags')

			<?php else: ?>

				<a class="spcl-button color" href="<?= URL::to('upload') ?>"><?= Lang::get('lang.submit_pic_or_video') ?></a>

				<div class="social_block">
					<img src="{{ theme_folder_url('/assets/img/social-loader.gif') }}" />
					<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F{{ setting('site.facebook_page') }}&amp;width&amp;height=220&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</div>

			<?php endif; ?>
			
			@include('theme::ads.sidebar-ad')
			@if(!isset($hide_sidebar_posts))
				@include('theme::includes.posts-sidebar')
			@endif	
		</div>
	</div>
</div>
<div style="clear:both"></div>