<div class="comments app-section pt-0" data-content="<?php echo $Config['id'];?>" data-type="<?php echo $Config['type'];?>">
    <div class="app-heading">
        <div class="text"><?php echo __('Comments');?></div>
    </div>
    <?php if($AuthUser['id']) { ?>
    <form method="POST" class="post-form">
        <div class="postbox">
            <div class="comment-form">
                <div class="comment-avatar">
                    <?php echo trim(gravatar($AuthUser['id'],$AuthUser['avatar'],$AuthUser['name'],'avatar avatar-sm'));?>
                </div>
                <div class="comment-content">
                    <div class="form-comment">
                        <textarea name="comment" class="form-control mb-2" rows="1" wrap="hard" maxlength="500" placeholder="<?php echo __('Comment');?>"></textarea>
                        <div class="character-count">500</div>
                        <?php if($Config['type'] == 'post' || $Config['type'] == 'episode') { ?>
                        <div class="custom-control custom-radio">
                            <input type="checkbox" name="spoiler" value="1" class="custom-control-input" id="spoiler">
                            <label class="custom-control-label" for="spoiler"><?php echo __('Does this comment contain information, tips or details about the content ?');?></label>
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn" data-loading-text="Loading .."><?php echo __('Write Comment');?></button>
                        <div class="cancel"></div>
                    </div>
                </div>
            </div>
            <div class="response"></div>
        </div>
        <input type="hidden" name="content_id" value="<?php echo $Config['id'];?>">
        <input type="hidden" name="action" value="post">
        <input type="hidden" name="type" value="<?php echo $Config['type'];?>">
        <input type="hidden" name="url" value="<?php echo $Config['url'];?>">
        <input type="hidden" name="parent_id" value="">
    </form>
    <?php } else { ?>
    <div class="py-3"><?php echo __('The comment field is only for members.');?> <a href="<?php echo APP.'/login';?>" class="text-white font-weight-bold"><?php echo __('Login');?></a>, <a href="<?php echo APP.'/register';?>" class="text-white font-weight-bold"><?php echo __('Register');?></a></div>
    <?php } ?>
    <div class="d-flex align-items-center">
        <div class="comment-total"></div>
        <div class="sort dropdown">
            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                <?php echo __('Sorting');?>
                <span class="current"><?php echo __('Newest');?></span>
            </button>
            <ul class="dropdown-menu">
                <a href="#" class="dropdown-item" data-sort="1"><?php echo __('Newest');?></a>
                <a href="#" class="dropdown-item" data-sort="3"><?php echo __('Popular');?></a>
                <a href="#" class="dropdown-item" data-sort="2"><?php echo __('Oldest');?></a>
            </ul>
        </div>
    </div>
    <div class="loader"></div>
    <ul class="list-comments"></ul>
    <div class="pagination-container"></div>
</div>
<script id="commentTemplate" type="text/template">
    <li class="list-comment {% if (spoiler == '1') { %} spoiler {% } %}" data-id="{%= id %}">
    {% if (spoiler == '1') { %}
        <div class="spoiler-btn" data-id="{%= id %}"><?php echo __('This comment contains spoilers. Click to read');?></div>
    {% } %}
    <div class="list-comment-content">
        <div class="list-avatar">
            {% if (author.url) { %}
            <a href="{%= author.url %}" target="_blank">{%= author.avatar %}</a>
            {% } else { %}
            {%= author.avatar %}
            {% } %}
        </div>
        <div class="list-body">
            {% if (author.url) { %}
            <a href="{%= author.url %}" target="_blank" class="list-name">{%= author.name %}</a>
            {% } else { %}
            <span class="list-name">{%= author.name %}</span>
            {% } %}
            <a href="#!comment={%= id %}" class="list-date">
                <time title="{%= created %}">{%= created %}</time>
            </a>
            {% if (status != '1') { %} <span class="text-warning text-12"><?php echo __('Pending');?></span> {% } %}
            <div class="text">{%= comment %}</div>
            <form method="POST" class="edit-form comment-form">
                <input type="hidden" name="id" value="{%= id %}">
                <input type="hidden" name="action" value="update">
                <textarea name="comment" class="form-control mb-2" rows="1 wrap=" hard" maxlength="500" data-content="{%= comment %}" placeholder="Yorum"></textarea>
                <div class="comment-btn">
                    <button type="submit" class="btn btn-theme" data-loading-text=".."><?php echo __('Edit');?></button>
                    <button type="button" class="btn cancel"><?php echo __('Cancel');?></button>
                </div>
                <div class="response"></div>
            </form>
            <div class="list-comment-footer">
                <div class="votes">
                    <a href="#" title="Beğen" class="like {%= (voted === 'up' ? 'voted' : '') %}">
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#like';?>" />
                        </svg>
                    <span class="likes" data-votes="{%= likes %}">
                        {%= likes || '' %}
                    </span>
                    </a>
                    <a href="#" title="Beğenme" class="dislike {%= (voted === 'down' ? 'voted' : '') %}"> 
                        <svg class="icon">
                            <use xlink:href="<?php echo ASSETS.'/img/sprite.svg#dislike';?>" />
                        </svg>
                        <span class="dislikes" data-votes="{%= dislikes %}">
                            {%= dislikes || '' %}
                        </span>
                    </a>
                </div>
                {% if (reply) { %}
                <a href="#" class="reply" data-parent="{%= id %}" data-root="{%= parent_id || id %}"><?php echo __('Reply');?></a>
                {% } %} 
           
                {% if (edit) { %}
                <a href="#" class="quick-edit"><?php echo __('Edit');?></a>
                {% } %}
            </div>
            <div class="replybox"></div>
        </div>
    </div>
    <ul class="list-comments children" data-parent="{%= id %}"></ul>
</li>
</script>
<script id="paginationTemplate" type="text/template">
    <ul class="pagination pagination-sm">
        <li {% if (current_page === 1) { %} class="disabled page-item" {% } %}>
            <a href="#!page={%= prev_page %}" data-page="{%= prev_page %}" title="<?php echo __('Prev');?>" class="page-link">&laquo;</a>
        </li>

        {% if (first_adjacent_page > 1) { %}
            <li class="page-item">
                <a href="#!page=1" data-page="1" class="page-link">1</a>
            </li>
            {% if (first_adjacent_page > 2) { %}
               <li class="disabled"><a class="page-link">...</a></li>
            {% } %}
        {% } %}

        {% for (var i = first_adjacent_page; i <= last_adjacent_page; i++) { %}
            <li class="page-item {% if (current_page === i) { %} active {% } %}">
                <a href="#!page={%= i %}" data-page="{%= i %}" class="page-link">{%= i %}</a>
            </li>
        {% } %}

        {% if (last_adjacent_page < last_page) { %}
            {% if (last_adjacent_page < last_page - 1) { %}
                <li class="disabled page-item"><a class="page-link">...</a></li>
            {% } %}
            <li class="page-item"><a href="#!page={%= last_page %}" data-page="{%= last_page %}" class="page-link">{%= last_page %}</a></li>
        {% } %}

        <li class="page-item {% if (current_page === last_page) { %} class="disabled" {% } %}">
            <a href="#!page={%= next_page %}" data-page="{%= next_page %}" title="<?php echo __('Next');?>" class="page-link">&raquo</a>
        </li>
    </ul>
</script>
<script id="alertTemplate" type="text/template">
    <div class="alert bg-warning-lt text-12 my-2"> 
        {% if (typeof message === 'object') { %}
          
                {% for (var i in message) { %}
                    <div>{%= message[i] %}</div>
                {% } %}
          
        {% } else { %}
            {%= message %}
        {% } %}
    </div>
</script> 
