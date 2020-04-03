<!--Template Hierarchy -> Single Post-->
<?php
get_header()
?>
<br>
<div class="mar">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1 > <?php the_title() ?> </h1>
        <?php if (get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) === '1') : ?>
            <div class="alert alert-info">
                Article sponsorisé"
            </div>
        <?php endif; ?>
    <br>
        <div>
        <p>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="" style="width:50%" ; height="500px;">
        </p>
       <div> <?php the_content() ?></div>
        </div>
        <?php 
        if (comments_open() || get_comments_number()){
            comments_template();
        }
        ?>
        <?php //var_dump(get_the_ID()); ?>
        <h2> articles relatifs </h2>
        <div class="row">
            <?php
            $query = new WP_Query([
                'post__not_in' => [get_the_ID()],
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'rand',
            ]);
            /* var_dump($query->get_posts());*/
            while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="col-sm-4">
            <div class="card">
               <?php the_post_thumbnail('card-header'/* size (wp-admin -> reglages -> medias ->'')*/,['class' => 'card-img-top '/*attribute */, 'alt' => ''])?> 
               <div class="card-body">
                  <h5 class="card-title"><?php the_title() ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
                  <ul>
                  <?php 
                  the_terms(get_the_ID(),'Recettes', '<li>', '</li> <li>', '</li>')
                  ?>
                  </ul>
                  <p class="card-text"><?php the_excerpt() /*the_content('En voir plus')*/ ?></p>
                  <a href="<?php the_permalink() ?>" class="card-link">voir plus </a>
               </div>
            </div>
         </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
            <?php //var_dump(get_the_ID()); 
            ?>
        </div>
</div>
<?php endwhile;
endif; ?>
</
<?php
get_footer()
?>