<?php 

if (get_locale() == 'en_US')

	get_header();

else

	get_header(get_locale());


    $posts=get_post();
?>

  <div class="clearfix"></div>
  
  
	<div class="container floated"><div class="sixteen floated page-title"><nav id="breadcrumbs"><ul><li></li><li><a href="<?php echo get_home_url();?>"  >Home</a></li><li class="current_element"><?php echo $posts->post_title;?></li></ul></nav><span></span></div></div>
	<div id="content">
		<div class="container floated">
<?php get_sidebar('single');?>
    
    
    <div class="eleven floated right">
    <div class="page-content"><!--TYPO3SEARCH_begin--><div id="c100630" class="csc-default"><p>


<?php printf( __( 'BS TEMPLATE Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?>

</p></div>
<?php echo get_bsearch_results($s,$limit); ?>
	</div><!--TYPO3SEARCH_end--></div>
			</div>
		</div>
	</div>

  
  </div>

<?php 
if (get_locale() == 'en_US')
	get_footer();
else

	get_footer(get_locale());