<?php
/**
 * Template Name: Show Photo
 *
 */
get_header();
$post=get_post();
global $wp_query;
$max_page=$wp_query->max_num_pages;
?>



<div class="content">
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
                
                    <div id="gallery_thumb">
                    <div class="row">
                        <?php
                                $wp_query = new WP_Query();
                                $arrTable = array
                                          (
                                          array(1,2,2,2,2,2,1),
                                          array(1,2,2,2,2,2,1),
                                          array(1,2,2,2,2,2,1),
                                          );
                                          
                                $properties = array(
                                        'post_type' =>  'fotowedstrijd',
                                        'paged' => $paged,
                                        'posts_per_page'=> 15
                                 );
        
                                
                                $query = $wp_query->query($properties);
        
                                foreach ($query as $perres){
        
                                    $imagevalue=get_post_meta($perres->ID,'url_image',true);
                                    $arrImg[].=$imagevalue;
                                    $arrId[].=$perres->ID;
                                }
                                                                
                                
                                $count=0;
                                foreach($arrTable as $row){
                                    echo '<div class="row">';
                                    foreach($row as $col){
                                        echo '<div class="col-md-'.$col.' col-xs-'.$col.'">';
                                        if($col==1){
                                            echo " ";}
                                        else{
                                            if($count<count($arrImg)){
                                                echo '<img class="bnt-img" title="'.$count.'" src="'.get_home_url().'/wp-content/plugins/wp-image-uploader/includes/thumb.php?src='.$arrImg[$count].'&w=200&h=140" width="150" height="90" />';
                                            }else{
                                                echo " ";
                                            }
                                            $count++;
                                        }                                                                                
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                }
                        ?>
                        
                        
                    </div>

                    
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                        &nbsp;
                        </div>
                        
                        <div class="col-md-4 col-xs-4" style="text-align: center;">
                        &nbsp;
                        </div>
                        
                        <div class="col-md-4 col-xs-4">
                        &nbsp;
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                        &nbsp;
                        </div>
                        
                        <div class="col-md-4 col-xs-4" style="text-align: center;">
                            <?php previous_posts_link('&laquo; Previous'); ?>
                            &nbsp;<?php if($paged==0){echo "1";}else{echo $paged;};?>&nbsp;
                            <?php if($paged<=$max_page)  next_posts_link('Next &raquo;'); ?>
                        </div>
                        
                        <div class="col-md-4 col-xs-4">
                        &nbsp;
                        </div>
                    </div>
                    
                </div>


          </div>
          <div class="col-md-1">&nbsp;</div>
        </div>
</div>
<div id="kr-slide" >
   <img id="img-share" src="<?php echo get_stylesheet_directory_uri().'/images/share.png';?>" />
   <div id="bnt-left"></div>
    <div id="slide-box">
     
    <?php 
    $count=0;
     foreach($arrImg as $img){
        echo '<img style="display:none" class="img" id="img'.$count.'" src="'.$img.'" />';
        $count++;
     }
    ?>
    
    
    </div>
    <div id="bnt-right"></div>
    <div id="bnt-close"></div>
</div>
<script type="text/javascript">

$(document).ready(function(){
var imgIdSel;
var imgLength=<?php echo $count;?>;
var arrId=[<?php foreach($arrId as $id)  echo $id.',';?>];


  $('.bnt-img').click(function(){
        var selID=this.title;
        imgIdSel=this.title;
        $('#kr-slide').fadeIn(500);
        $('.img').hide();
        $("#img"+selID).show(500);
  });
  
  $('#bnt-close').click(function(){
      $('#kr-slide').fadeOut(500);
  });
  

  $('#bnt-right').click(function(){
      if(imgIdSel<imgLength-1){
          $("#img"+imgIdSel).fadeOut(500,function(){
                var nextImg=parseInt(imgIdSel)+1;
                $("#img"+nextImg).fadeIn(500);
                imgIdSel=nextImg;
                hideButton(imgIdSel,imgLength);
          });
      }
      
  });
  
  $(".img").click(function(){
    $('#bnt-right').click();
  });
  
  $('#bnt-left').click(function(){
      if(imgIdSel>0){
          $("#img"+imgIdSel).fadeOut(500,function(){
                var nextImg=parseInt(imgIdSel)-1;
                $("#img"+nextImg).fadeIn(500);
                imgIdSel=nextImg;
                hideButton(imgIdSel,imgLength);
          });
      }
      
  });
  
  $('#img-share').click(function(){
    var tid=arrId[imgIdSel];
    window.open("<?php echo get_home_url().'/share-photo/?id='?>"+tid,"_blank");
  });
  
  
});

function hideButton(imgIdSel,imgLength){
    if(imgIdSel<=0){
        $("#bnt-left").hide();
    }else{
        $("#bnt-left").show();
    }
    
    if(imgIdSel>=imgLength-1){
        $("#bnt-right").hide();
    }else{
        $("#bnt-right").show();
    }
}

</script>

<?php
get_footer();
?>