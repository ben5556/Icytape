@extends('theme::app')

@section('content')


<div id="wrap" class="upload">

     <form method="POST" action="{{ url('post') }}" id="media-form" accept-charset="UTF-8" file="1" enctype="multipart/form-data">
                
        <h2><i class="fa fa-cloud-upload"></i> <?= Lang::get('lang.upload') ?></h2>

        

        <!-- Select between an image or a video -->
        <div class="pic_or_video">
            <label><input type="radio" name="pic" id="pic" checked><span><i class="fa fa-picture-o"></i>  <?= Lang::get('lang.image') ?></span></label>
            <label><input type="radio" name="vid" id="vid"><span><i class="fa fa-film"></i> <?= Lang::get('lang.video') ?></span></label>
        </div>

        <div style="clear:both"></div>

        <div class="upload_container">

            <p><input name="title" class="form-control" type="text" id="title" placeholder="<?= Lang::get('lang.title') ?>"></p>

            <select name="category_id" id="category_id" class="form-control">
            <option value="1"><?= Lang::get('lang.select_category') ?></option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
            
           
            <div style="clear:both"></div>
            <div id="img_upload">
                <i class="fa fa-picture-o" style="font-size:50px; color:#aaa; float:left"></i>
                <p style="margin-left:65px; margin-bottom:6px;"><input type="file" multiple="true" id="pic_url" name="pic_url" style="" /></p>
                <h4 style="margin-left:65px; padding-top:0px;"><?= Lang::get('lang.or_enter_url') ?></h4>
                <p><input type="text" class="form-control" id="img_url" name="img_url" style="" placeholder="<?= Lang::get('lang.image_url') ?>" /></p> 
            </div>

            <div id="vid_upload" style="display:none;">
                    <br />
                    <i class="fa fa-film" style="font-size:50px; color:#aaa; float:left"></i> 
                    <p style="margin-left:65px; margin-bottom:6px; font-weight:normal; margin-top:2px;"><?= Lang::get('lang.add_a_video') ?></p>
                    <h4 style="margin-left:65px; padding-top:0px; margin-top:8px;"><?= Lang::get('lang.add_video_types_below') ?>:</h4>
                    
                <label for="vid_url"></label>
                <p><input type="text" name="vid_url" class="form-control" id="vid_url" placeholder="<?= Lang::get('lang.add_url_here') ?>" /></p>
            </div>
            
            <?php if($settings->media_description): ?>
                <p><textarea name="description" class="form-control" id="description" placeholder="<?= Lang::get('lang.description') ?>"></textarea></p>   
            <?php endif; ?>

            <p><input name="link_url" class="form-control" type="text" id="link_url" placeholder="<?= Lang::get('lang.source_optional') ?>" /></p>
            
            <p><input name="tags" class="form-control" id="tags" placeholder="<?= Lang::get('lang.tags_optional') ?>" /></p>      
            
            <p>
                <label for="nsfw"><?= Lang::get('lang.nsfw') ?></label>

                <?php if(isset($item->nsfw)): ?><?php $nsfw = $item->nsfw ?><?php else: $nsfw = 0; endif; ?>
                    <input type="checkbox" name="nsfw" class="onoffswitch-checkbox" id="nsfw">                     
                    
            </p>

            <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= Auth::user()->id ?>" />

        </div><!-- .upload_container -->
        <br />
        <input class="btn primary_color_background" type="submit" value="<?= __('lang.submit') ?>">
        <br />
        <br />

        {{ csrf_field() }}

    </form>

</div>

<script type="text/javascript" src="/{{ theme_folder('/assets/js/jquery.tagsinput.js') }}"></script>

<script>

$(document).ready(function(){

    $('#tags').tagsInput();

    $('#pic').change(function(){
        $('#vid').prop('checked', false);
        $('#vid_upload').hide();
        $('#img_upload').show();

    });

    $('#vid').change(function(){
        $('#pic').prop('checked', false);
        $('#vid_upload').show();
        $('#img_upload').hide();
    });
});

</script>

@stop