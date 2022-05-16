<?php require PATH . '/config/array.config.php';?>
<form method="post" class="form">
    <input type="hidden" name="_ACTION" value="filter">
    <div class="filter-toolbar">
        <?php if($FilterType == 1) { ?>
        <div class="filter-item" id="type">
            <label>
                <?php echo __('Type');?></label>
            <div class="filter-item-content dropdown-toggle" role="button" id="filter-type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input type="hidden" name="type" value="">
                <div class="filter-value"></div>
                <div class="dropdown-btn"></div>
            </div>
            <div class="dropdown-menu" aria-labelledby="filter-type">
                <li value="" <?php if(!$Filter['type']) echo 'class="selected"' ;?>>
                    <?php echo __('All');?>
                </li>
                <li value="movie" <?php if($Filter['type']=='movie' ) echo 'class="selected"' ;?>>
                    <?php echo __('Movie');?>
                </li>
                <li value="serie" <?php if($Filter['type']=='serie' ) echo 'class="selected"' ;?>>
                    <?php echo __('Serie');?>
                </li>
            </div>
        </div>
        <?php } ?>
        <div class="filter-item" id="category">
            <label>
                <?php echo __('Category');?></label>
            <div class="filter-item-content dropdown-toggle" role="button" id="filter-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input type="hidden" name="category" value="">
                <div class="filter-value"></div>
                <div class="dropdown-btn"></div>
            </div>
            <div class="dropdown-menu dropdown-2x" aria-labelledby="filter-category">
                <li value="" <?php if(!$Filter['category']) echo 'class="selected"' ;?>>
                    <?php echo __('All');?>
                </li>
                <?php foreach ($Categories as $Category) { ?>
                <li value="<?php echo $Category['id'];?>" <?php if($Category['id']==$Filter['category'] || $Category['id']==$SelectCategory['id']) echo 'class="selected"' ;?>>
                    <?php echo $Category['name'];?>
                </li>
                <?php } ?>
            </div>
        </div>
        <div class="filter-item" id="imdb">
            <label>
                <?php echo __('Imdb');?></label>
            <div class="filter-item-content dropdown-toggle" role="button" id="filter-imdb" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input type="hidden" name="imdb" value="">
                <div class="filter-value"></div>
                <div class="dropdown-btn"></div>
            </div>
            <div class="dropdown-menu" aria-labelledby="filter-imdb">
                <li value="" <?php if(!$Filter['imdb']) echo 'class="selected"' ;?>>
                    <?php echo __('Imdb');?>
                </li>
                <?php for ($i=4; $i <= 9; $i++) { ?>
                <li value="<?php echo $i;?>" <?php if($i==$Filter['imdb']) echo 'class="selected"' ;?>>
                    <?php echo $i.' '.__('and over');?>
                </li>
                <?php } ?>
            </div>
        </div>
        <div class="filter-item" id="quality">
            <label>
                <?php echo __('Quality');?></label>
            <div class="filter-item-content dropdown-toggle" role="button" id="filter-quality" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input type="hidden" name="quality" value="">
                <div class="filter-value"></div>
                <div class="dropdown-btn"></div>
            </div>
            <div class="dropdown-menu" aria-labelledby="filter-quality">
                <li value="" <?php if(!$Filter['quality']) echo 'class="selected"' ;?>>
                    <?php echo __('Quality');?>
                </li>
                <?php foreach ($Qualities as $Quality) { ?>
                <li value="<?php echo $Quality;?>" <?php if($Quality==$Filter['quality']) echo 'class="selected"' ;?>>
                    <?php echo $Quality;?>
                </li>
                <?php } ?>
            </div>
        </div>
        <div class="filter-item" id="year">
            <label>
                <?php echo __('Released');?></label>
            <div class="filter-item-content dropdown-toggle" role="button" id="filter-released" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input type="hidden" name="released" value="">
                <div class="filter-value"></div>
                <div class="dropdown-btn"></div>
            </div>
            <div class="dropdown-menu" aria-labelledby="filter-released">
                <li value="" <?php if(!$Filter['released']) echo 'class="selected"' ;?>>
                    <?php echo __('All');?>
                </li>
                <li value="2010-2020" <?php if('2010-'.date('Y')==$Filter['released']) echo 'class="selected"' ;?>>2010 -
                    <?php echo date('Y');?>
                </li>
                <li value="2000-2009" <?php if('2000-2009'==$Filter['released']) echo 'class="selected"' ;?>>2000 - 2009</li>
                <li value="1990-1999" <?php if('1990-1999'==$Filter['released']) echo 'class="selected"' ;?>>1990 - 1999</li>
                <li value="1980-1989" <?php if('1980-1989'==$Filter['released']) echo 'class="selected"' ;?>>1980 - 1989</li>
            </div>
        </div>
        <div class="filter-item" id="sorting">
            <label>
                <?php echo __('Sorting');?></label>
            <div class="filter-item-content dropdown-toggle" role="button" id="filter-sorting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input type="hidden" name="sorting" value="">
                <div class="filter-value"></div>
                <div class="dropdown-btn"></div>
            </div>
            <div class="dropdown-menu" aria-labelledby="filter-sorting">
                <li value="newest" <?php if('newest'==$Filter['sorting'] || !$Filter['sorting']) echo 'class="selected"' ;?>>
                    <?php echo __('Newest');?>
                </li>
                <li value="popular" <?php if('popular'==$Filter['sorting']) echo 'class="selected"' ;?>>
                    <?php echo __('Popular');?>
                </li>
                <li value="released" <?php if('featured'==$Filter['sorting']) echo 'class="selected"' ;?>>
                    <?php echo __('Featured');?>
                </li>
                <li value="released" <?php if('released'==$Filter['sorting']) echo 'class="selected"' ;?>>
                    <?php echo __('Released');?>
                </li>
                <li value="imdb" <?php if('imdb'==$Filter['sorting']) echo 'class="selected"' ;?>>
                    <?php echo __('Imdb');?>
                </li>
            </div>
        </div>
        <button type="submit" class="btn btn-theme btn-apply">
            <?php echo __('Apply');?></button>
    </div>
</form>
<div class="app-filter aside aside-lg aside-sm app-filter-md" id="filter">
    <div class="modal-dialog p-3">
        <button class="modal-close d-md-none d-block" data-dismiss="modal">
            <svg class="icon">
                <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#close';?>" />
            </svg>
        </button>
        <form method="post" class="pt-4">
            <input type="hidden" name="_ACTION" value="filter">
            <?php if($FilterType == 1) { ?>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Type');?></label>
                <select name="category" class="custom-select">
                    <option value="">
                        <?php echo __('All');?>
                    </option>
                    <option value="movie" <?php if($Filter['type']=='movie' ) echo 'selected="true"' ;?>>
                        <?php echo __('Movie');?>
                    </option>
                    <option value="serie" <?php if($Filter['type']=='serie' ) echo 'selected="true"' ;?>>
                        <?php echo __('Serie');?>
                    </option>
                </select>
            </div>
            <?php } ?>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Category');?></label>
                <select name="category" class="custom-select">
                    <option value="">
                        <?php echo __('Category');?>
                    </option>
                    <?php foreach ($Categories as $Category) { ?>
                    <option value="<?php echo $Category['id'];?>" <?php if($Category['id']==$Filter['category']) echo 'selected="true"' ;?>>
                        <?php echo $Category['name'];?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Imdb');?></label>
                <select name="imdb" class="custom-select change-ajax">
                    <option value="">
                        <?php echo __('Imdb');?>
                    </option>
                    <?php for ($i=4; $i <= 9; $i++) { ?>
                    <option value="<?php echo $i;?>" <?php if($i==$Filter['imdb']) echo 'selected="true"' ;?>>
                        <?php echo $i.' '.__('and over');?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Released');?></label>
                <select name="released" class="custom-select">
                    <option value="">
                        <?php echo __('Released');?>
                    </option>
                    <option value="2010-<?php echo date('Y');?>" <?php if('2010-'.date('Y')==$Filter['released']) echo 'selected="true"' ;?>>2010 -
                        <?php echo date('Y');?>
                    </option>
                    <option value="2000-2009" <?php if('2000-2009'==$Filter['released']) echo 'selected="true"' ;?>>2000 - 2009</option>
                    <option value="1990-1999" <?php if('1990-1999'==$Filter['released']) echo 'selected="true"' ;?>>1990 - 1999</option>
                    <option value="1980-1989" <?php if('1980-1989'==$Filter['released']) echo 'selected="true"' ;?>>1980 - 1989</option>
                </select>
            </div>
            <div class="form-group">
                <label class="custom-label">
                    <?php echo __('Sorting');?></label>
                <select name="sorting" class="custom-select">
                    <option value="newest" <?php if('newest'==$Filter['sorting']) echo 'selected="true"' ;?>>
                        <?php echo __('Newest');?>
                    </option>
                    <option value="popular" <?php if('popular'==$Filter['sorting']) echo 'selected="true"' ;?>>
                        <?php echo __('Popular');?>
                    </option>
                    <option value="released" <?php if('released'==$Filter['sorting']) echo 'selected="true"' ;?>>
                        <?php echo __('Released');?>
                    </option>
                    <option value="imdb" <?php if('imdb'==$Filter['sorting']) echo 'selected="true"' ;?>>
                        <?php echo __('Imdb');?>
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-theme">
                <?php echo __('Apply');?></button>
        </form>
    </div>
</div>