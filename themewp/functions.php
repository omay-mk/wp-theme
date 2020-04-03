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
    wp_enqueue_style('style','style.css',false);
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
/** taxonomy */
function themetest_init() { 
    register_taxonomy('Recettes', 'post',[
        'labels' => [ 
            'name' => 'Recettes',
            'singular_name'     => 'Recette',
            'search_items'      => 'Rechercher des recettes',
            'all_items'         =>'Toutes les recettes' ,
            'edit_item'         => 'Editer la recette',
            'update_item'       => 'Mettre à jour la recette ',
            'add_new_item'      => ' Ajouter une nouvelle recette ',
            'menu_name'         => 'Recettes',
        ],
        'show_in_rest' => true ,
        'hierarchical' => true ,
        'show_admin_column' => true ,
    ]);
}


add_action('init', 'themetest_init');
add_action('after_setup_theme', 'themetest_supports');
add_action('wp_enqueue_scripts', 'themetest_register_assets');
add_filter('nav_menu_css_class', 'themetest_menu_class');
add_filter('nav_menu_link_attributes', 'themetest_menu_link_class');

require_once 'widgets/YoutubeWidget.php';
function themetest_register_widget() { 
    register_widget(YoutubeWidget::class);
    register_sidebar(
        [
            'id' => 'homepage',
            'name' => 'Sidebar Accueil',
            'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
            'after_widget' => '</div>',
            'before_title' =>'<h4 class="font-italic">',
            'after_title'  => '</h4>'
        ]
        );
}

add_action('widgets_init', 'themetest_register_widget');
/*add_filter('comment_form_fields', function($fields){
  $fields['email'] =  <<<HTML 
    
  return $fields;
});*/

require_once('metaboxes/sponso.php');
require get_template_directory(). '/inc/customizer.php';
SponsoMetaBox::register();