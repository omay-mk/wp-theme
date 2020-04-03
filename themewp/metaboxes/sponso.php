<?php
class SponsoMetaBox { 
    const META_KEY = 'montheme_sponso';
    public static function register (){ 
    add_action('add_meta_boxes', [self::class,'add']/*'themetest_add_custom_box'*/);
    add_action('save_post', [self::class,'save'] /*'themetest_save_sponso'*/);

    }
    public static function add (){ 
        add_meta_box (self::META_KEY,'sponsoring', [self::class,'render']/*'themetest_render_sponso_box'*/,'post', 'side'); 
    }
    public static function render ($post){
        $value = get_post_meta($post->ID, self::META_KEY, true);
        ?>
        <input type="hidden" value="0" name="<?= self::META_KEY?>">
        <input type="checkbox" value="1" name="<?= self::META_KEY?>" <?= $value === '1' ? 'checked' :'' /**byDefault=> sponsored */?>> 
        <label for="monthemesponso">cet article eqt sponsorisé ?</label>
        
        <?php
    }
    public static function save ($post){ 
        if(array_key_exists(self::META_KEY, $_POST) && current_user_can('edit_post', $post ))/**Returns whether the current user has the specified capability. */ {
            if ($_POST[self::META_KEY] === '0') { 
             delete_post_meta($post, self::META_KEY);/**Deletes a post meta field for the given post ID */
            } else { 
                update_post_meta($post, self::META_KEY, 1);/**Updates a post meta field based on the given post ID. */
    
            }
        }
    }
}
?>