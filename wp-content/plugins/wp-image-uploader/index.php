<?php
/*
Plugin Name: Image Uploader Free
Plugin URI: http://projects.geekydump.com/image-uploader/
Description: Image Uploader is the first and only picture upload plugin available for Wordpress. Upload, auto-resize, and admin a single or multiple images at the same time.
Version: 1.0.1
Author: Ivan M
*/

require_once('includes/PHPImageWorkshop/Exception/ImageWorkshopBaseException.php');
require_once('includes/PHPImageWorkshop/Exception/ImageWorkshopException.php');
require_once('includes/PHPImageWorkshop/Core/Exception/ImageWorkshopLayerException.php');
require_once('includes/PHPImageWorkshop/Core/ImageWorkshopLib.php');
require_once('includes/PHPImageWorkshop/Core/ImageWorkshopLayer.php');
require_once('includes/PHPImageWorkshop/ImageWorkshop.php');
require_once('includes/GkyImageUploader.class.inc');

// create menu in wp admin /////////////////////////////////////////////////////
add_action( 'admin_menu', 'gky_image_uploader_plugin_menu' );
function gky_image_uploader_plugin_menu() {
    add_menu_page("Image Uploader", "Image Uploader", 0, "gky_image_uploader", "gky_image_uploader_main_function",plugins_url('images/pics_1.png', __FILE__));

    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-accordion' );
    wp_enqueue_script( 'jquery-ui-datepicker');
    wp_enqueue_script('jquery-ui-tabs');
    
    wp_register_script( 'DataTablePlugin', plugins_url('js/jquery.dataTables.min.js', __FILE__) );
    wp_enqueue_script( 'DataTablePlugin' );
    
    wp_register_style( 'myPluginStylesheet', plugins_url('css/css.css', __FILE__) );
    wp_enqueue_style( 'myPluginStylesheet' );
}


/**
* Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
*/
add_action( 'wp_enqueue_scripts', 'prefix_add_my_stylesheet' );
/**
* Enqueue plugin style-file
*/
function prefix_add_my_stylesheet() {
    wp_register_style( 'myPluginStylesheet', plugins_url('css/css.css', __FILE__) );
    wp_enqueue_style( 'myPluginStylesheet' );
}

/*
 *  main function ///////////////////////////////////////////////////////////////
 */
function gky_image_uploader_main_function(){
   
    // vars
    $plugins_url = plugins_url();
    $site_url = get_site_url();
    
    echo "<h1>Image Uploader Admin</h1>";
    include("templates/buy_premium_tpl.php");
    
    $GkyUploader = new GkyImageUploader(); // create object
    // generate folder tree 
    $FolderTree = $GkyUploader->GenerateTree("../gky_uploads");
    
    
    include("templates/folder_tree_admin_tpl.php");


    // open folder if clicked on folder
    if($_GET['folder']){
        
        $myFolder = $_GET['folder'];
        $all_files = glob("../gky_uploads/$myFolder/*.*");
        
        include("templates/admin_home_tpl.php");
    }
    // by default show folder for current month
    else {
        $myFolder = date("Y").'/'.date("m");
        $all_files = glob("../gky_uploads/$myFolder/*.*");
        include("templates/admin_home_tpl.php");
    }
    
    
    // delete images
    if($_GET['action']== "delete"){
        
        $file_for_delete = $_GET['file'];
        echo $file_for_delete;
        unlink($file_for_delete);
    }
    else if($_GET['action']=="delete_selected"){
        // delete images one by one
        foreach($_POST['selector'] as $oneFile){
            unlink($oneFile);
            echo $oneFile.'- DELETED <br>'; 
            ?><meta http-equiv="REFRESH" content="0;url=?page=gky_image_uploader"><?php
        }
    }
    
    
}

// shortcode function //////////////////////////////////////////////////////////
add_shortcode('gky_image_uploader','gky_image_uploader_add_page');
function gky_image_uploader_add_page(){
    
    // check is form submited
    if(isset($_POST['upload_imgs'])){
        
        // check does folder exist, if not create it
        if (!file_exists('gky_uploads')) {
            mkdir('gky_uploads');
        }

        // get image width
        (int) $maxWidth =  addslashes($_POST['maxwidth']);
        
        $GkyUploader = new GkyImageUploader(); // create object
        
        // get max width, and global FILES var
        $images = $GkyUploader->GkyUploadImage($_FILES, $maxWidth); // return array of uploaded images
        
        // show table with images
        $plugins_url = plugins_url();
        include("templates/show_uploaded_images_tpl.php");
    }
    else { 
        $my_site_url = get_site_url();
        include("templates/upload_form_tpl.php");
    }
}

/*
 *  Ajax submit and converting images ///////////////////////////////////////////
 */

// enqueue and localise scripts
function ajaxupload_enqueuescripts()
{
    wp_enqueue_script( 'my-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ) );
    wp_localize_script( 'my-ajax-handle', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', 'ajaxupload_enqueuescripts');

// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_gky_the_action_function', 'gky_the_action_function' );
add_action( 'wp_ajax_nopriv_gky_the_action_function', 'gky_the_actionfunction' );


/*
 * parse images, and show output
 */

function gky_the_action_function() {
    // do something with data
    return false;
}

?>
