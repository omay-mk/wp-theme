<div class="comments">
<?php 
$count = absint(get_comments_number());//absint =>Convert a value to non-negative integer
?>
<?php if ($count > 0): ?>
    <h2><?= $count ?> Commentaire<?= $count> 1 ? 's' : '' ?></h2>
    <?php else : ?>
    <?php endif ?> 

<?php if (comments_open()): ?>
<?php comment_form(['title_replay' => ''])?> <!--Outputs a complete commenting form for use within a template.-->
<?php endif ?> 
<?php wp_list_comments(['style' => 'div' ]) ?> 
<?php paginate_comments_links() ?> 
</div>