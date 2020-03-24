<?php 
//** Registers theme support for a given feature. */
function themetest_supports () { 
    add_theme_support('title-tag'); 
    add_theme_support('post-thumbnails');// mini-img for articles 
    add_theme_support('menus');//add menus
    register_nav_menu('header', 'header');
    add_image_size('card-header', 350, 215,true);
}

function themetest_register_assets () { 
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', []);
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [], false, true);
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', [], false, true ); /** dependency , version ,  $in_footer (true) enqueue the script before </body> */
    wp_deregister_script('jquery');/** wp jquery (min) */
    wp_enqueue_style('bootstrap');//** add css */
    wp_enqueue_script('bootstrap'); /** added jquery and popper in bootstrap->script line 2 */
}

function themetest_menu_class($classes)
{ 
   $classes[] ='nav-itm';
   return $classes;/*filter need to return*/
    /*var_dump(func_get_arg()); /* dump information about variable -> Return an item from the argument list*/
 /*die();*/
}

function themetest_menu_link_class($attrs)
{ 
   $attrs['class'] ='nav-link';
   return $attrs;
}

function themetest_pagination()/*no solution with wp need to creat func */
{  $pages = paginate_links(['type' => 'array']);/* link form tab*/
    /* check if their is pages then if false then apply pagination */
     if ($pages === null){
         return;
     }
    echo'<nav aria-label="Pagination">';
    echo '<ul class="pagination">';
     
     foreach ($pages as $page){
         $active = strpos($page, 'current') !== false;
         $class = 'page-item';/* bootstrap */
         /* indicate page of article*/
         if ($active) { 
             $class .= ' active';
         }
         echo '<li class= "' . $class . '">';
         echo str_replace('page-numbers'/*wp*/, 'page-link',/* bootstrap*/$page);
         echo '</li>';
     }
    /* var_dump($pages);*/
     echo '</ul>';
     echo '</nav>';
  
}

function themetest_add_custom_box()
{
    add_meta_box ('montheme_sponso','sponsoring','themetest_render_sponso_box','post', 'side');
}

function themetest_render_sponso_box()
{ 
    ?>
    <input type="hidden" value="0" name="montheme_sponso">
    <input type="checkbox" value="1" name="montheme_sponso">
    <label for="montheme_sponso">cet article eqt sponsorisé</label>
    
    <?php 
}



add_action('after_setup_theme', 'themetest_supports');
add_action('wp_enqueue_scripts', 'themetest_register_assets');
add_filter('nav_menu_css_class', 'themetest_menu_class');
add_filter('nav_menu_link_attributes', 'themetest_menu_link_class');
add_action('add_meta_boxes', 'themetest_add_custom_box');
add_action('save_post', 'themetest_save_sponso');
