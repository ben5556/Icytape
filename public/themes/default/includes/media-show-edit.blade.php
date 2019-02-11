<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" data-id="<?= $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?= Lang::get('lang.editing') ?> <?= $item->title ?></h4>
      </div>
      <div class="modal-body">
      
      	<form action="{{ route('post.update', $item) }}" method="POST">
      
		<ul>
	        <li>
	            <label for="title"><?= Lang::get('lang.title') ?></label>
	            <input type="text" class="form-control" name="title" id="title" value="<?= $item->title ?>" />
	        </li>

	        <li>
	        	<label for="title"><?= Lang::get('lang.category') ?></label>
	        	<select class="form-control" id="category" name="category">
	        		<?php foreach($categories as $category): ?>
	        			<option value="<?= $category->id ?>" <?php if($category->id == $item->category_id): ?> selected="selected" <?php endif; ?>><?= $category->name ?></option>
	        		<?php endforeach; ?>
	        	</select>
	        </li>


        	<li>
        		<label for="description">{{ __('lang.description') }}</label>
            	<p><textarea name="body" class="form-control" id="body" placeholder="{{ __('lang.description') }}">{{ $item->body }}</textarea></p>   
        	</li>

	        <li>
	            <label for="source"><?= Lang::get('lang.source') ?></label>
	            <input type="text" class="form-control" name="source" id="source" value="<?= $item->link_url ?>" />
	        </li>

	        <li>
	            <label for="tags"><?= Lang::get('lang.tags') ?></label>
	            <input class="form-control tags_input" name="tags" id="tags" value="<?= $item->tags ?>" style="width:100%; height:auto;" />
	        </li>

	        

	        <li>
				<label for="nsfw"><?= Lang::get('lang.nsfw') ?>:</label>

				<?php if(isset($item->nsfw)): ?><?php $nsfw = $item->nsfw ?><?php else: ?><?php $nsfw = 0 ?><?php endif; ?>
					<input type="checkbox" name="nsfw" @if($nsfw) checked @endif class="onoffswitch-checkbox" id="nsfw">				   
				    
			</li>

		</ul>
		<input type="hidden" id="id" name="id" value="<?= $item->id ?>" />
		<input type="hidden" name="_method" value="PATCH">
		{{ csrf_field() }}
		<input type="hidden" id="redirect" name="redirect" value="<?= Request::url() ?>" />

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?= Lang::get('lang.cancel') ?></button>
        <input type="submit" class="btn btn-color" value="<?= Lang::get('lang.update_media') ?>" />
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->