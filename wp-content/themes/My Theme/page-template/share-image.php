<?php
/**
 * Template Name: Share Image
 *
 */
get_header();
$ids=$_GET['id'];
$postt=get_post($ids);
?>


<div class="content">
        <div class="row">
        </div>
        
        <div class="row">
          <div class="col-md-1">&nbsp;</div>
          <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel-left">
                        <?php get_sidebar();?>
                    </div>
                </div>
                
                <div class="col-md-9">
                <div class="panel-right">
                    <h2><?php  echo $post->post_title;$imagevalue=get_post_meta($postt->ID,'url_image',true);?></h2>
                    <p>
                    <?php  echo apply_filters('the_content', $post->post_content); ?>
                    </p>
                    <p>
                        <img src="<?php echo $imagevalue;?>" width="200px" />
                        <p>
                        <b><?php  echo $postt->post_title;?></b><br />
                        <i><?php echo $postt->post_content;?></i>
                        </p>
                    </p>
                    <?php echo do_shortcode('[really_simple_share]');?>
                </div>
                </div>
            </div>
          </div>
          <div class="col-md-1">&nbsp;</div>
        </div>
</div>



<?php
get_footer();
?>