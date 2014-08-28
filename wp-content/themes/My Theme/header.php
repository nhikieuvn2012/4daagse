
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php if (is_home () ) { bloginfo('name'); }elseif ( is_category() ) { single_cat_title(); echo ' - ' ; bloginfo('name'); }
    elseif (is_single() ) { single_post_title();}
    elseif (is_page() ) { bloginfo('name'); echo ': '; single_post_title();}
    else { wp_title('',true); } ?></title>
    
    <meta name="description" content="<?php echo get_post_meta($wp_query->post->ID,'description',true); ?>" />
    <!-- Bootstrap -->
    <link href="<?php echo get_stylesheet_directory_uri();?>/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo get_stylesheet_directory_uri();?>/style.css" rel="stylesheet"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php
global $menu_left;
global $menu_right;
global $menu_mobile;

        $menu_name = 'footer-menu';
        $menu_left = '';
        $menu_right='';
        $menu_mobile='';
        if (($locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
        
        	$menu_items = wp_get_nav_menu_items($menu->term_id);
        
        	

            $count=0;
        	foreach ( (array) $menu_items as $key => $menu_item ) {
 	            if($menu_item->menu_item_parent==0){
                    $count++;
                    $isTrue=0;
                    
                    foreach ( (array) $menu_items as $key => $menu_item_p ) {
                        if($menu_item_p->menu_item_parent==$menu_item->ID){
                            $isTrue=1;
                        }
                    }
                    
                    if($isTrue==0){//no sub item menu
                        if($count<=4){
                            $menu_left.='<li><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
                        }else{
                            $menu_right.='<li><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
                        }
                        $menu_mobile.='<li><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
                    }else{//sub item menu
                        if($count<=4){
                            $styleTop=0;
                            foreach ( (array) $menu_items as $key => $menu_item_p ) {
                                if($menu_item_p->menu_item_parent==$menu_item->ID){
                                    $styleTop=$styleTop+31;
                            }}
                            
                            $menu_left.='<li class="dropdown" ><a href="'.$menu_item->url.'" class="dropdown-toggle" data-toggle="dropdown">'.$menu_item->title.'</a><ul class="dropdown-menu" style="top:-'.$styleTop.'px">';
                            foreach ( (array) $menu_items as $key => $menu_item_p ) {
                                if($menu_item_p->menu_item_parent==$menu_item->ID){
                                    $menu_left.='<li><a href="'.$menu_item_p->url.'">'.$menu_item_p->title.'</a></li>';
                                }
                            }
                            $menu_left.='</ul></li>';
                        }
                        else{
                            
                            $styleTop=0;
                            foreach ( (array) $menu_items as $key => $menu_item_p ) {
                                if($menu_item_p->menu_item_parent==$menu_item->ID){
                                    $styleTop=$styleTop+31;
                            }}
                            $menu_right.='<li class="dropdown"><a href="'.$menu_item->url.'" class="dropdown-toggle" data-toggle="dropdown">'.$menu_item->title.'</a><ul class="dropdown-menu" style="top:-'.$styleTop.'px">';
                            foreach ( (array) $menu_items as $key => $menu_item_p ) {
                                if($menu_item_p->menu_item_parent==$menu_item->ID){
                                    $menu_right.='<li><a href="'.$menu_item_p->url.'">'.$menu_item_p->title.'</a></li>';
                                }
                            }
                            $menu_right.='</ul></li>';
                        }
                            $menu_mobile.='<li class="dropdown"><a href="'.$menu_item->url.'" class="dropdown-toggle" data-toggle="dropdown">'.$menu_item->title.'</a><ul class="dropdown-menu">';
                            foreach ( (array) $menu_items as $key => $menu_item_p ) {
                                if($menu_item_p->menu_item_parent==$menu_item->ID){
                                    $menu_mobile.='<li><a href="'.$menu_item_p->url.'">'.$menu_item_p->title.'</a></li>';
                                }
                            }
                            $menu_mobile.='</ul></li>';
                    }

                }
        	}
        } 
?>

<div class="visible-xs visible-md">
    <div class="row">
    <div class="col-md-4 col-xs-12" style="text-align: center;">
    <a href="<?php echo get_home_url();?>"><img width="150" height="150" src="<?php echo get_stylesheet_directory_uri().'/images/logoborder.png';?>" /></a>
    </div>
    </div>
    
    
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Menu</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
        <?php echo $menu_mobile;?>
        </ul>
        </div>
      </div><!-- /.container-fluid -->
    </nav>

</div>
