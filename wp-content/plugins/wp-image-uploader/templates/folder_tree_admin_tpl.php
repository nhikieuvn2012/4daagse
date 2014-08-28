<div class="wrap">
<?php
if($FolderTree){
foreach($FolderTree as $year=>$month){
    ?>
    <table class="widefat">
        <thead>
            <tr>
                <th><?php echo $year;?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                <?php
                if($month){
                foreach($month as $one_month){

                    $monthNum = explode("/",$one_month);

                    $monthName = date("F", mktime(0, 0, 0, $monthNum[1], 10));

                    ?>
                    <a href='?page=gky_image_uploader&folder=<?php echo $one_month;?>'><?php echo $monthName;?> of <?php echo $monthNum[0];?></a> | 

                    <?php
                }
                }
                ?>
                </td>
            </tr>
        </tbody>
    </table>
<?php
}
}
?>
<hr>
</div>