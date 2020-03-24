<?php
get_header()
?>
<br>

<?php if (have_posts()) :/* condition only if their is articles will execute the code */ ?>
   <!-- row to aline articles -->
   <div class="row">
      <?php while (have_posts()) : the_post();/*without it the loop will not stop need to get the_post */ ?>
         <div class="col-sm-4">
            <div class="card">
               <?php the_post_thumbnail('card-header'/* size (wp-admin -> reglages -> medias ->'')*/,['class' => 'card-img-top'/*attribute */, 'alt' => ''])?> 
               <div class="card-body">
                  <h5 class="card-title"><?php the_title() ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
                  <p class="card-text"><?php the_excerpt() /*the_content('En voir plus')*/ ?></p>
                  <a href="<?php the_permalink() ?>" class="card-link">voir plus </a>
               </div>
            </div>
         </div>
      <?php endwhile; ?>
      
   </div>
   <br>
    <!-- Pagination-->
    <?php themetest_pagination() ?>
   
<?php else : ?>
   <h1> pas d'articles </h1>
<?php endif; ?>

<?php
get_footer()
?>