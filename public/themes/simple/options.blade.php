<style type="text/css">

	.option_row{
		padding:10px;
		padding-bottom:20px;
		margin-bottom:15px;
		border-bottom:1px solid #eaeaf1;
	}

	.option_row:after{
		content: '';
	    position: relative;
	    display: block;
	    clear: both;
	    width: 100%;
	    height: 1px;
	}

	.option_row hr{
		border:0px;
		margin:0px;
	}

</style>
<?php 

	$like_icon_options = json_encode(
		array("default" => "fa-thumbs-up", "options" => array(
			"fa-thumbs-up" => "Thumbs Up", "fa-star" => "Star", "fa-heart" => "Heart", "fa-sun-o" => "Sun", "fa-smile-o" => "Smile", "fa-check" => "Checkmark"
		)));

	$custom_js_options = json_encode(
		array("language" => "js"));

	$custom_css_options = json_encode(
		array("language" => "css"));
?>

<div class="option_row">
	{!! theme_field('image', 'logo', 'Logo') !!}
</div>

<div class="option_row">
	{!! theme_field('color', 'default_color', 'Default Color', '#EE222E') !!}
</div>

<div class="option_row">
	{!! theme_field('select_dropdown', 'like_icon', 'Post Like Icon', '', $like_icon_options) !!}
</div>

<div class="option_row">
	{!! theme_field('image', 'social_share_image', 'Social Share Image, (when your site is shared on Social Networks, this image will show)') !!}
</div>

<div class="option_row">
	{!! theme_field('text_area', 'ad_post_top', 'Top of Post Advertisement') !!}
</div>

<div class="option_row">
	{!! theme_field('text_area', 'ad_post_top_mobile', 'Top of Post Mobile Advertisement') !!}
</div>

<div class="option_row">
	{!! theme_field('code_editor', 'custom_css', 'Custom CSS Styles', '', $custom_css_options) !!}
</div>

<div class="option_row">
	{!! theme_field('code_editor', 'custom_js', 'Custom Javascript', '', $custom_js_options) !!}
</div>