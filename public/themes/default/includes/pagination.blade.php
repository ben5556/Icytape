<div class="pagination-outter pull-right {{ theme('pagination_type') }}">
	<?php if(theme('pagination_type') == 'load_more'): ?>
		<div class="btn btn-color load-more-btn" data-href="<?= Request::url() ?>?page=<?php if(Input::get('page') != ''): ?><?= intval(Input::get('page') + 1) ?><?php else: ?><?= '2'; ?><?php endif; ?><?php if(isset($search)): echo '&search='.$search; endif; ?>">
			<p>Load More</p>
			<span class="ouro">
			  <span class="left"><span class="anim"></span></span>
			  <span class="right"><span class="anim"></span></span>
			</span>
		</div>
		<div id="hidden_load_content"></div>
	<?php else: ?>
		<?php if(isset($search)): ?>
			<?php echo $posts->appends(array('search' => $search))->links(); ?>
		<?php else: ?>
			<?php echo $posts->links(); ?>
		<?php endif; ?>
		
	<?php endif; ?>
</div>