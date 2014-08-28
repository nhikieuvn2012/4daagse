function submit_me(podatak1,podatak2,podatak3){
    
    jQuery("#dodaj_lazni_clanak").html("<center>loading</center>")

    
    jQuery.ajax({
         type : "post",
         url : the_ajax_script.ajaxurl,
         data : {
             action: "gky_the_action_function", 
             ime_val: ime,
             prezime_val: prezime,
             info_val: info,
             clanak_val: clanak,
             num1_val: num1,
             num2_val: num2,
             rez_val: rez},
         success: function(response) {
            jQuery("#dodaj_lazni_clanak").html(response);
         }
      })   
}

function ShowProgress(site){
    jQuery("#progress_bar").show();
}

function get_files(){

    var files = jQuery('#files').prop("files");
    jQuery("#selected_files").html("<br><br><b>Selected Files: </b><hr>");
    for (i=0; i<=files.length; i++){
        jQuery("#selected_files").append('-'+files[i].name+'<br>');
    }

}

function printValue(sliderID, showInDiv) {
    
    var size = jQuery("#"+sliderID).val();
    if (size==0){
        size = "<i>do not resize</i>";
    }
    else {
        size = size+"px";
    }
    jQuery("#"+showInDiv).html(size);

}