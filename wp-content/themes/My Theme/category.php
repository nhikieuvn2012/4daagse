<?php get_header();
    $posts=get_post();
?>

  <div class="clearfix"></div>
  
  
	<div class="container floated"><div class="sixteen floated page-title"><nav id="breadcrumbs"><ul><li></li><li><a href="<?php echo get_home_url();?>"  >Home</a></li><li class="current_element"><?php echo $posts->post_title;?></li></ul></nav><span></span></div></div>
	<div id="content">
		<div class="container floated">

    <?php get_sidebar('cat');?>
    <div class="eleven floated right">
    <div class="page-content"><!--TYPO3SEARCH_begin--><div id="c100630" class="csc-default"><h1 class="csc-firstHeader"><?php echo $posts->post_title;?></h1><p></p></div>
    <?php echo apply_filters('the_content',$posts->post_content);?>
	</div><!--TYPO3SEARCH_end--></div>
			</div>
		</div>
	</div>

  
  </div>


<?php get_footer();?>