<form action="" method="POST" enctype="multipart/form-data">
    <input class="input_form_style" type="file" name="files[]" id="files" onchange="get_files()" multiple/>
    <small>Notice: you can select more then one file!</small>
    <br><br>
    Max Width: <span id="rangeValue"><i>Do not resize</i></span><br> 
    <input style="width: 100%;" id="maxwidth" name="maxwidth" onchange="printValue('maxwidth','rangeValue')" type="range" min="0" max="1500" step="10" value="0" />
    
    <br>
    <center>
        <input value="Upload Images" class="upload_button" name="upload_imgs" onclick="ShowProgress('<?=$my_site_url;?>');" type="submit"/>
    </center>
</form>


<div id="selected_files"></div>
<div style="display:none;" id="progress_bar"><center>Uplading, please wait!<br><img src="<?=$my_site_url;?>/wp-content/plugins/wp-image-uploader/images/greenbar.gif"></center></div>