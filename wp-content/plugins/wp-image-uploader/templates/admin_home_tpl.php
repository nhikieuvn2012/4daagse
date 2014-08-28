<script type="text/javascript">
      jQuery(document).ready(function(){
      
         
         jQuery('.datatable').dataTable({
                "sPaginationType": "full_numbers",
                "iDisplayLength": 10
            });
      });
      
</script>

<h2>Images:</h2>
Current folder: <b>/<?php echo $myFolder;?></b>
<div class="wrap">
    <form name="select_files" action="?page=gky_image_uploader&action=delete_selected" method="post">
        <table class="widefat datatable">
            <thead>
            <tr>
                <th></th>
                <th>Thumb</th>
                <th>Url</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($all_files){
            foreach($all_files as $oneFile){
                $imgurl = str_replace("..",$site_url,$oneFile);
                ?>
                <tr>
                    <td width="20"><input type="checkbox" value="<?php echo $oneFile;?>" name="selector[]"></td>
                    <td width="80"><a href="<?php echo $imgurl;?>" target="_blank"><img src="<?php echo $plugins_url;?>/wp-image-uploader/includes/thumb.php?src=<?php echo $imgurl;?>&w=70&h=70"></a></td>
                    <td><a href="<?php echo $imgurl;?>" target="_blank"><?php echo $imgurl;?></a></td>
                    <td><a href="?page=gky_image_uploader&action=delete&file=<?php echo $oneFile;?>">Delete</a></td>
                </tr>
            <?php
            }
            }
            ?>
            </tbody>
        </table><hr/><br/>
        <input type="submit" name="submit" value="Delete Selected">
    </form>
</div>