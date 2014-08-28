<h2>Fotowedstrijd</h2>
<?php
$wp_query = new WP_Query();

                                          
$properties = array(
'post_type' =>  'fotowedstrijd',
'posts_per_page'=> 1
);
        
                                
        $query = $wp_query->query($properties);
        
        foreach ($query as $perres){
        
        $imagevalue=get_post_meta($perres->ID,'url_image',true);
?>
                    <a href="<?php echo get_home_url();?>/foto-s-bekijken/">
                    <img src="<?php echo $imagevalue;?>" />
                    </a>
                    <h4>Laatste upload</h4>
                    
                    <p>
                    Naam:<?php echo $perres->post_title;?><br />
                    Datum:<?php echo $perres->post_date;?><br />
                    </p>
                    
                    <p>
                        <?php echo $perres->post_content;?>
                    </p>
<?php
}