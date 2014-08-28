<?php
/**
 * Template Name: Time Table
 *
 */
get_header();
$current_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$post=get_post();

$selTime=$_GET['t'];

$arrTime1=array(6,7,8,9,10,11,12,13,14,15);
$arrTime2=array(15,16,17,18,19,20,21,22,23,00);

if($selTime=='1'){
    $arrTimeSel=$arrTime2;
}else{
    $arrTimeSel=$arrTime1;
}





$args=array(
'taxonomy' => 'category',
'hierarchical' => '1',
'hide_empty' => '0',
'pad_counts' => '1',
);




$categories=get_categories($args);

$arrTable=array();
$arrRowName=array();
$countRow=0;
foreach($categories as $category) {


        $wp_query = new WP_Query();
        $slug=$category->slug;
        
        $properties = array(
                'post_type' =>  'zomerfeesten',
                'paged' => -1,
                'tax_query' => array(),
                'posts_per_page' => -1,
         );
        

        
        $properties['tax_query']=array(
            array(
                'taxonomy' => 'category',
                'terms' => $slug,
                'field' => 'slug',
            )
        );
        
        $query = $wp_query->query($properties);
        $arrColum=array(array(),array(),array(),array(),array(),array(),array(),array(),array(),array());  
        foreach ($query as $perres){
                $timerStart=date('G:i',get_post_meta($perres->ID,'time_start',true));
                $timeHous=explode(':',$timerStart);
                                              
                for($i=0;$i<count($arrTimeSel);$i++){
                    if(intval($timeHous[0])==$arrTimeSel[$i]){
                        $arrColum[$i][].=$perres->ID;
                    }
                }
            
        }
        $arrRowName[$countRow]=$category->name;
        $arrTable[$countRow]=$arrColum;
        $countRow++;
        

}


                         
$wp_query = new WP_Query();
                                
                                          
$properties = array(
'post_type' =>  'zomerfeesten',
);
        
                                
$query = $wp_query->query($properties);

foreach ($query as $perres){
    $timerStart=date('G:i',get_post_meta($perres->ID,'time_start',true));
    $timeHous=explode(':',$timerStart);
                                  
    for($i=0;$i<count($arrTimeSel);$i++){
        if(intval($timeHous[0])==$arrTimeSel[$i]){
            $arrColum[$i][].=$perres->ID;
        }
    }
    
    
    
}                                                                                          
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
<table style="width: 100%;"  > 
    <tr>
    <td style="background-color: white;width: 150px;"></td>
    <td style="background-color: #666666;font-size: 10px;color: #B2B2B2;padding-left: 5px;">
    <?php
        if($selTime!='1'){
            echo '<spam style="color:white">';
        }
        else{
            echo '<spam>';
            
        }
        
        foreach($arrTime1 as $t){
            echo $t.':00 ';
        }
        
        echo '</spam>';
        
        if($selTime=='1'){
            echo '<spam style="color:white">';
        }
        else{
            echo '<spam>';
            
        }
        
        foreach($arrTime2 as $t){
             echo $t.':00 ';
        }
        echo '</spam>';
    ?>
    </td>
    <td style="width: 220px;text-align:center;">
        <?php if($selTime=='1'){
                    echo '<a href="'.get_home_url().'/zomerfeesten/?t=0" id="bnt-time-prev">&lt;&lt; Previer Time</a>';
               }
              else{
                    echo '&lt;&lt; Previer Time';
              }        
        ?> | 
        
        <?php if($selTime=='1'){
                    echo 'Next Time &gt;&gt;';
               }
              else{
                    echo '<a href="'.get_home_url().'/zomerfeesten/?t=1" id="bnt-time-next">Next Time &gt;&gt;</a>';
              }        
        ?>
        
    </td>
    </tr>
</table>


<table id="tabletime" style="border: solid 2px white;" border="2" >

<tr>
    <th style="background-color: white;width: 150px;"></th>
    <?php
        foreach($arrTimeSel as $t1){
            echo '<th id="t'.$t1.'th">'.$t1.':00</th>';
        }
    ?>
</tr>
<?php


    $str=''; 
    $countRow=0;
    foreach($arrTable as $row){
        $str.='<tr>';
        $str.='<td class="title">'.$arrRowName[$countRow].'</td>';
        foreach($row as $cols){
            $str.='<td>';
            foreach($cols as $p){
                $post=get_post($p);
                $timerStart=date('G:i',get_post_meta($post->ID,'time_start',true));
                $timerEnd=date('G:i',get_post_meta($post->ID,'time_end',true));
                $timeHous=explode(':',$timerStart);
                $timeHousEnd=explode(':',$timerEnd);
                $locale=get_post_meta($post->ID,'locatie',true);
                $str.='<input type="hidden" value="'.$locale.'" id="t'.$post->ID.'l" />';
                $str.='<input type="hidden" value="'.$post->post_title.'" id="t'.$post->ID.'name" />';
                $str.='<input type="hidden" value="'.$timerStart.'" id="t'.$post->ID.'start" />';
                $str.='<input type="hidden" value="'.$timerEnd.'" id="t'.$post->ID.'end" />';
                $str.='<input type="hidden" value="'.$timeHous[0].'" id="t'.$post->ID.'h" />';
                $str.='<input type="hidden" value="'.$timeHousEnd[0].'" id="t'.$post->ID.'hend" />';
                $str.='<div class="box" title="'.$timerStart.'-'.$timerEnd.'" id="t'.$post->ID.'"><b>'.$post->post_title.'</b><br/><i>'.$locale.'</i></div>';
            }
            $str.='</td>';
        }
        $str.='</tr>';
        $countRow++;
    }
    echo $str;
?>

</table>
<script>
$(document).ready(function(){
   $('.box').mousemove(function(){
        var th=$('#'+this.id+'h').val();
        var thend=$('#'+this.id+'hend').val();
        $('#t'+th+'th').css('background-color','red');
        var i=0;
        for(i=parseInt(th);i<=thend;i++){
        $('#t'+i+'th').css('background-color','red');
        }
   });
   
   $('.box').mouseout(function(){
        $('th').css('background-color','black');
   })
   
   $('.box').click(function(){
        var th=$('#'+this.id+'start').val();
        var thend=$('#'+this.id+'end').val();
        var tn=$('#'+this.id+'name').val();
        var tl=$('#'+this.id+'l').val();
        alert("Artiest / Programma:"+tn+"\n\nLocatie:"+tl+"\nTijd:"+th+"-"+thend,"Information!");
   });
   
});
</script>
                        
                </div>

         
          </div>
          <div class="col-md-1">&nbsp;</div>
        </div>
</div>


<?php
get_footer();
?>