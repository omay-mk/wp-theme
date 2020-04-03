
<!--Template Hierarchy ->Front Page-->
<?php
get_header()
?>

<!--
<?php /*while (have_posts()): the_post() ?>
    <h1><?php the_title() ?></h1> 
    <a href="<?= get_post_type_archive_link('post') /* link to posts  ?>"> voir actualités </a>
<?php/* endwhile; */?> 
--> 

<div class="jumbotron jmb"">
      <h1 class="cent"><?php the_title()?></h1>
      <p class="cent"> gdhftghkjlmùmlkjhgfdghjklmlkjhgfhjkl </p>
      <p class="cent"><a class="btn btn-primary btn-lg" href="<?php the_permalink() ?>" role="button">Learn more &raquo;</a></p>
  </div>
  
  
  <div class="row">
    <div class="col-md-8 blog-main ml-5">
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        From the Firehose
      </h3>
      <?php if (have_posts()) : ?>
        <?php
            $query = new WP_Query([
                'post__not_in' => [get_the_ID()],
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'rand',
            ]);
   while ($query->have_posts()) : $query->the_post();
            ?>
      <div class="blog-post">
        <h2 class="blog-post-title"><?php the_title() ?></h2>
        <p class="blog-post-meta"><?php the_time('F j, Y g:i a'); ?>&nbsp;
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php the_author();?></a></p>
        
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('medium'/* size (wp-admin -> reglages -> medias ->'')*/,['class' => ' im'/*attribute */, 'alt' => ''])?> 
        <?php endif; ?> 
        
        <p class="card-text"><?php the_excerpt() /*the_content('En voir plus')*/ ?></p>
                  <a href="<?php the_permalink() ?>" class="card-link">voir plus </a>
        
      </div><!-- /.blog-post -->
      <?php endwhile ;  wp_reset_postdata();?> 
      <?php else : ?>
        <p> <?php __('NO Posts Found');?> </p>  
      <?php endif; ?>
    
    </div><!-- /.blog-main -->
    <!-- /.blog-sidebar -->
    <?php get_sidebar('homepage');?>
  </div><!-- /.row -->
  
<?php
get_footer()
?>