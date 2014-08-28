 <?php
global $menu_left;
global $menu_right;
global $menu_mobile;
?>      

        
        <div class="hidden-xs">


        <div class="row" class="hidden-xs">
          <div class="col-md-4">&nbsp;</div>
          <div class="col-md-4" ><a href="<?php echo get_home_url();?>"><div  id="logo"></div></a></div>
          <div class="col-md-4">&nbsp;</div>
        </div>
        </div>

<footer >
    <div class="hidden-xs">
    <div class="row menu-footer">
      <div class="col-md-4 col-xs-12">
        <div class="menu-box-left">
        <nav class="navbar " role="navigation">
         <ul class="nav navbar-nav">
            <?php echo $menu_left;?>
             </ul>
        </nav>
        </div>
      </div>
      <div class="col-md-4" id="menu_footer_midel">&nbsp;</div>
      <div class="col-md-4 col-xs-12" >
      <div class="menu-box-right" >
        <nav class="navbar " role="navigation">
         <ul class="nav navbar-nav">
            <?php echo $menu_right;?>
         </ul>
        </nav>
      </div>
      </div>
    </div>
    </div>
    
    <div class="visible-xs">
        <div class="row">
          <div class="col-xs-12">&nbsp;</div>
        </div>
        
        <div class="row">
          <div class="col-xs-12">&nbsp;</div>
        </div>
        <div class="row">
          <div class="col-xs-12">&nbsp;</div>
        </div>
        <div class="row">
          <div class="col-xs-12">&nbsp;</div>
        </div>
    </div>
    
    
    <div class="row">
      <div class="col-md-4 col-xs-5" style="padding-top: 0px;"><img src="<?php echo get_stylesheet_directory_uri();?>/images/stores.png"/></div>
      <div class="col-md-4 col-xs-2">&nbsp;</div>
      <div class="col-md-4 col-xs-5" style="text-align: left;padding-top: 0px;">
            <div id="slide">
      <?php
            $wp_query = new WP_Query();
            
            $properties = array(
                    'post_type' =>  'company_logo',
                    'paged' => 1,
             );
            
            $query = $wp_query->query($properties);

            $count=0;
            foreach ($query as $perres){

                $url_link=get_post_meta($perres->ID,'company_url',true);
                
                $feat_image = wp_get_attachment_url( get_post_thumbnail_id($perres->ID) );
                ?>
                    <div id="logo<?php echo $count;?>" style="display: none;">
                    <img id="logo-sponser"  width="130px" height="130px" src="<?php echo $feat_image;?>" style="float: right;" />
                        <div class="hidden-xs" style="margin-top: 5px;">
                        <p  style="color: white;font-size: 12px;font-weight: bold;">Onze website en app wordt mogelijk gemaakt door</p>
                        <p style="color: black;font-size: 14px;">
                            <?php echo $perres->post_title;?><br />
                            <a style="color: black;" href="<?php echo $url_link;?>"><?php echo $url_link;?></a><br/>
                        </p>
                        </div>
                    </div>
            <?php
                $count++;
            }
            ?>
            </div>
      </div>
    </div>

</footer>


    <script src="<?php echo get_stylesheet_directory_uri();?>/js/bootstrap.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri();?>/js/bootstrap-hover-dropdown.js"></script>

  <script>
    // very simple to use!
    $(document).ready(function() {
      var lengLogo=<?php echo $count;?>;
      var indexLogo=0;
      $('.dropdown-toggle').dropdownHover().dropdown();
      $("#logo"+indexLogo).show();
      
    	$.fn.timer = function() {
            if(!$(this).children("div:last-child").is(":visible")){
            			$(this).children("div:visible")
            				.css("display", "none")
            				.next("div").css("display", "block");
            		}
            		else{
            			$(this).children("div:visible")
            				.css("display", "none")
            			.end().children("div:first")	
            				.css("display", "block");
            		}
    	} // timer function end
    	
    	window.setInterval(function() {
    		$("#slide").timer();
    	}, 4000);
    });
  </script>
  </body>
</html>