<div class="d-flex">
    <div class="flex-fill">
        <div class="card card-list module-element">
            <a data-toggle="collapse" href="#c1" role="button" aria-expanded="true" aria-controls="c1" class="card-header">
                <?php echo __('Movies');?>
            </a>
            <div class="collapse show" id="c1">
                <div class="card-body">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Movies Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][movies_title]" class="form-control" placeholder="<?php echo __('Movies Title');?>" value="<?php echo get($Settings, 'data.movies_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Movies Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][movies_description]" class="form-control" placeholder="<?php echo __('Movies Description');?>" value="<?php echo get($Settings, 'data.movies_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Movies Category Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][movies_category_title]" class="form-control" placeholder="<?php echo __('Movies Category Title');?>" value="<?php echo get($Settings, 'data.movies_category_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Movies Category Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][movies_category_description]" class="form-control" placeholder="<?php echo __('Movies Category Description');?>" value="<?php echo get($Settings, 'data.movies_category_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Movie Detail Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][movie_title]" class="form-control" placeholder="<?php echo __('Movie Detail Title');?>" value="<?php echo get($Settings, 'data.movie_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Movie Detail Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][movie_description]" class="form-control" placeholder="<?php echo __('Movie Detail Description');?>" value="<?php echo get($Settings, 'data.movie_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-list module-element">
            <a data-toggle="collapse" href="#c2" role="button" aria-expanded="false" aria-controls="c2" class="card-header"><?php echo __('Series');?></a>
            <div class="collapse" id="c2">
                <div class="card-body">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Series Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][series_title]" class="form-control" placeholder="<?php echo __('Series Title');?>" value="<?php echo get($Settings, 'data.series_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Series Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][series_description]" class="form-control" placeholder="<?php echo __('Series Description');?>" value="<?php echo get($Settings, 'data.series_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Series Category Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][series_category_title]" class="form-control" placeholder="<?php echo __('Series Category Title');?>" value="<?php echo get($Settings, 'data.series_category_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Series Category Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][series_category_description]" class="form-control" placeholder="<?php echo __('Series Category Description');?>" value="<?php echo get($Settings, 'data.series_category_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Serie Detail Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][serie_title]" class="form-control" placeholder="<?php echo __('Serie Detail Title');?>" value="<?php echo get($Settings, 'data.serie_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Serie Detail Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][serie_description]" class="form-control" placeholder="<?php echo __('Serie Detail Description');?>" value="<?php echo get($Settings, 'data.serie_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Serie Profile Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][serie_profile_title]" class="form-control" placeholder="<?php echo __('Serie Profile Title');?>" value="<?php echo get($Settings, 'data.serie_profile_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Serie Profile Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][serie_profile_description]" class="form-control" placeholder="<?php echo __('Serie Profile Description');?>" value="<?php echo get($Settings, 'data.serie_profile_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-list module-element">
            <a data-toggle="collapse" href="#c3" role="button" aria-expanded="false" aria-controls="c3" class="card-header"><?php echo __('Category');?></a>
            <div class="collapse" id="c3">
                <div class="card-body">
                    <div class="form-group ">
                        <label class="custom-label"><?php echo __('Category Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][category_title]" class="form-control" placeholder="<?php echo __('Category Title');?>" value="<?php echo get($Settings, 'data.category_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Category Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][category_description]" class="form-control" placeholder="<?php echo __('Category Description');?>" value="<?php echo get($Settings, 'data.category_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-list module-element">
            <a data-toggle="collapse" href="#c4" role="button" aria-expanded="false" aria-controls="c4" class="card-header"><?php echo __('Actor');?></a>
            <div class="collapse" id="c4">
                <div class="card-body">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Actor Profile Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][actor_title]" class="form-control" placeholder="<?php echo __('Actor Profile Title');?>" value="<?php echo get($Settings, 'data.actor_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Actor Profile Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][actor_description]" class="form-control" placeholder="<?php echo __('Actor Profile Description');?>" value="<?php echo get($Settings, 'data.actor_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-list module-element">
            <a data-toggle="collapse" href="#c5" role="button" aria-expanded="false" aria-controls="c5" class="card-header"><?php echo __('Discovery');?></a>
            <div class="collapse" id="c5">
                <div class="card-body">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Discovery Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][discovery_title]" class="form-control" placeholder="<?php echo __('Discovery Title');?>" value="<?php echo get($Settings, 'data.discovery_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Discovery Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][discovery_description]" class="form-control" placeholder="<?php echo __('Discovery Description');?>" value="<?php echo get($Settings, 'data.discovery_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-list module-element">
            <a data-toggle="collapse" href="#c6" role="button" aria-expanded="false" aria-controls="c6" class="card-header"><?php echo __('TV Channels');?></a>
            <div class="collapse" id="c6">
                <div class="card-body">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('TV Channels Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][channels_title]" class="form-control" placeholder="<?php echo __('Discovery Title');?>" value="<?php echo get($Settings, 'data.channels_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('TV Channels Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][channels_description]" class="form-control" placeholder="<?php echo __('Discovery Description');?>" value="<?php echo get($Settings, 'data.channels_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('TV Channel Detail Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][channel_title]" class="form-control" placeholder="<?php echo __('Discovery Title');?>" value="<?php echo get($Settings, 'data.channel_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('TV Channel Detail Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][channel_description]" class="form-control" placeholder="<?php echo __('Discovery Description');?>" value="<?php echo get($Settings, 'data.channel_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                </div>
            </div>
        </div>
         <div class="card card-list module-element">
            <a data-toggle="collapse" href="#c7" role="button" aria-expanded="false" aria-controls="c7" class="card-header"><?php echo __('Anime');?></a>
            <div class="collapse" id="c7">
                <div class="card-body">
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_title]" class="form-control" placeholder="<?php echo __('Anime Title');?>" value="<?php echo get($Settings, 'data.anime_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_description]" class="form-control" placeholder="<?php echo __('Anime Description');?>" value="<?php echo get($Settings, 'data.anime_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Category Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_category_title]" class="form-control" placeholder="<?php echo __('Anime Category Title');?>" value="<?php echo get($Settings, 'data.anime_category_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Category Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_category_description]" class="form-control" placeholder="<?php echo __('Anime Category Description');?>" value="<?php echo get($Settings, 'data.anime_category_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Detail Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_title]" class="form-control" placeholder="<?php echo __('Anime Detail Title');?>" value="<?php echo get($Settings, 'data.anime_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Detail Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_description]" class="form-control" placeholder="<?php echo __('Anime Detail Description');?>" value="<?php echo get($Settings, 'data.anime_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Profile Title');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_profile_title]" class="form-control" placeholder="<?php echo __('Anime Profile Title');?>" value="<?php echo get($Settings, 'data.anime_profile_title', $key);?>" maxlength="255" autofocus="true">
                    </div>
                    <div class="form-group">
                        <label class="custom-label"><?php echo __('Anime Profile Description');?></label>
                        <input type="text" name="data[<?php echo $key;?>][anime_profile_description]" class="form-control" placeholder="<?php echo __('Anime Profile Description');?>" value="<?php echo get($Settings, 'data.anime_profile_description', $key);?>" maxlength="255" autofocus="true">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-aside-right">
        <div class="card-document">
            <div class="attr">${title}</div>
            <div class="text"><?php echo __('You can get the title with variable');?></div>
        </div>
        <div class="card-document">
            <div class="attr">${category}</div>
            <div class="text"><?php echo __('You can get the category with variable');?></div>
        </div>  
    </div>
</div>
