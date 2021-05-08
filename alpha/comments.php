<div class="comment-list">
    <?php wp_list_comments(); ?>
</div>
<div class="comment-pagination">
    <?php 
    the_comments_pagination(array(
        'screen_reader_text' => 'Comments'
    )); 
    ?>
</div>
<div class="comment-form">
    <?php 
        if(comments_open()){
            comment_form();
        }else{
            _e('<h4>Comments are closed</h4>', 'alpha');
        }
    ?>
</div>