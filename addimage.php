<?php
include_once("wp-load.php");

$txtNames=$_GET['names'];
$txtAddress=$_GET['address'];
$txtEmail=$_GET['email'];
$txtPhone=$_GET['phone'];
$txtDesc=$_GET['desc'];
$txturl=$_GET['urlimg'];

$my_post = array(
  'post_title'    => $txtNames,
  'post_content'  => $txtDesc,
  'post_status'   => 'draft',
  'post_type'     => 'fotowedstrijd',
);


// Insert the post into the database
$new_post=wp_insert_post( $my_post );
add_post_meta($new_post,'phone',$txtPhone,true);
add_post_meta($new_post,'email',$txtEmail,true);
add_post_meta($new_post,'address',$txtAddress,true);
add_post_meta($new_post,'url_image',$txturl,true);

/*
$img=explode('/',$txturl);
$count=count($img);
$count--;


$wpdb->insert( 'wp_ngg_pictures', array( 'image_slug' => $txtNames, 'filename' =>$img[$count],'galleryid' =>3), array( '%s', '%s','%d' ) );
*/
echo '<h3>Post Image success!</h4><p><a href="'.get_home_url().'">go home -></a></p><p><a href="'.get_home_url().'/foto-s-uploaden/">go back upload page -></a></p>';