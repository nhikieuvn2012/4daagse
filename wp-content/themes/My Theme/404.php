<?php 

if (get_locale() == 'en_US')

	get_header();

else

	get_header(get_locale());

?>

<div id="pageregionShell">
        

<div class="contentText" style="padding-top:1em;font-size:2em;">

Not found. Sorry, for some reasons the requested page is not found on the server. 


</div> <!-- End contentText --> 

</div> <!-- End pageregionShell -->  

<?php 

if (get_locale() == 'en_US')

	get_footer();

else

	get_footer(get_locale());

?>   