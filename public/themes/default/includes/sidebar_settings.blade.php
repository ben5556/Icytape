<!-- OPTIONS BAR -->

<div class="options_sidebar">

	<h2>Viewing Options:</h2>

	<div class="viewing_options">
	  <i class="fa fa-th-list <?php if($post_display == 'list'){ echo 'active'; } ?>" data-url="<?= URL::to('view/list'); ?>"></i>
	  <i class="fa fa-th-large <?php if($post_display == 'grid_large'){ echo 'active'; } ?>" data-url="<?= URL::to('view/grid_large'); ?>"></i>
	  <i class="fa fa-th <?php if($post_display == 'grid'){ echo 'active'; } ?>" data-url="<?= URL::to('view/grid'); ?>"></i>

	  <i class="fa sidebar-toggle <?php if($sidebar){ echo 'fa-arrow-circle-right'; }else{ echo 'fa-arrow-circle-left'; } ?>" data-url="<?= URL::to('view/sidebar_toggle'); ?>"><?php if($sidebar){ echo '<span>Close Sidebar</span>'; }else{ echo '<span>Open Sidebar</span>'; } ?></i>
	</div>
	<div style="clear:both"></div>
	
</div>

<!-- END OPTIONS BAR -->