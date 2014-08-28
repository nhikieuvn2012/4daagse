<?php
/**
 * Template Name: One Column
 *
 */
get_header();
$post=get_post();
?>


<div class="content" >
        <div class="row">
        </div>
        
        <div class="row">
          <div class="col-md-1">&nbsp;</div>
          <div class="col-md-10">

                <div class="panel-right">
                    <h2><?php  echo $post->post_title;?></h2>
                    <p>
                     <?php  echo apply_filters('the_content', $post->post_content); ?>
                    </p>
                </div>

         
          </div>
          <div class="col-md-1">&nbsp;</div>
        </div>
</div>


<?php
get_footer();
?>