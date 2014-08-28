<?php
foreach($images as $oneImage){
?>
<div id="frmshow" class="uploaded_images">
    <div style="width: 100%;float: left;">
        <img style="float: left;margin: 10px;" src="<?php echo $plugins_url;?>/wp-image-uploader/includes/thumb.php?src=<?php echo $oneImage['location'];?>&w=100&h=100" style="border: 1px solid #000;">
       <p>
            <b>Dimensions:<br/> </b> <?php echo $oneImage['maxwidth'];?> x <?php echo $oneImage['height'];?> px
       </p>
       <p>
        Direct URL:<br/>
        <input type="text" id="urlimg" value="<?php echo $oneImage['location'];?>"/><br/>
        </p>
        
        
    </div>


    <div style="width: 100%;float: left;">
    <fieldset>
        <legend>Input Information:</legend>
        
        <div class="row">
            <div class="col-lg-12">
            <div id="error" style="color: red;font-size: 15px;font-weight: bold;display: none;">Name not null!</div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
            <label for="names">Name:<samp style="color: red;">(*)</samp></label><br />
            <input type="text" value="" name="names" id="names" />
            </div>
            
            <div class="col-lg-6">
            <label for="email">Email:<samp style="color: red;">(*)</samp></label><br />
            <input type="text" value="" name="email" id="email" />
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
            <label for="phone">Phone:<samp style="color: red;">(*)</samp></label><br />
            <input type="text" value="" name="phone" id="phone" />
            </div>
            
            <div class="col-lg-6">
            <label for="address">Address:<samp style="color: red;">(*)</samp></label><br />
            <input type="text" value="" name="address" id="address" />
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-9">
            <label for="desc">Description:<samp style="color: red;"></samp></label><br />
            <textarea style="width: 100%;" name="desc" id="desc"></textarea>
            </div>
            
            <div class="col-lg-3">
            &nbsp;
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6"><br />
            <button id="bnt-finished">Finished</button>
            </div>
            
            <div class="col-lg-6">
            &nbsp;
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6"><br />
            <a href="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>">Upload more!</a>
            </div>
            
            <div class="col-lg-6">
            &nbsp;
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
            &nbsp;
            </div>
            
            <div class="col-lg-6">
            &nbsp;
            </div>
        </div>
        
    </fieldset>
    </div>
        <!--
        HTML code:<br>
        <input type="text" style="width:100%" value="<img src='<?php //echo $oneImage['location'];?>'>"><br>
        BB Code:<br>
        <input type="text" style="width:100%" value="[img]<?php // echo $oneImage['location'];?>[/img]">
        --!>
        
        <script type="text/javascript">
        $(document).ready(function(){

            
            $('input').change(function(){
               $('#error').hide(500); 
            });
            
            $('#bnt-finished').click(function(){
            var txtName=$('#names').val();
            var txtAddress=$('#address').val();
            var txtEmail=$('#email').val();
            var txtPhone=$('#phone').val();
            var txtDesc=$('#desc').val();
            var txturl=$('#urlimg').val();
            
                if((txtName=='')||(txtName.length<=5)){
                    showE('Name not null and larger than 5 character!');
                    return false;
                }
                
                
                if((txtPhone=='')||(txtPhone.length<=9)){
                    showE('Phone not null and larger than 10 character!');
                    return false;
                }
                
                var vald=IsNumeric(txtPhone);
                if(vald==false){
                    showE('Phone not number!');
                    return false;
                }
                
                if((txtAddress=='')|| (txtAddress.length<=5)){
                    showE('Address not null and larger than 5 character!');
                    return false;
                }
                
                var vald=validateEmail(txtEmail);
                 if(vald==false){
                    showE('Email not true!');
                    return false;
                 }
                


                $.ajax({
                            url: "addimage.php?names="+txtName+"&address="+txtAddress+"&email="+txtEmail+"&phone="+txtPhone+"&desc="+txtDesc+"&urlimg="+txturl,
                            type: "get",
                            dataType: "html",
                            success: function(data){
                                $("#frmshow").html(data);
                            }
                });
                
                
            });
            
            
        });
        
        function showE(txt){
            $('#error').html(txt);
            $('#error').show(500);
            
        }
        
        function IsNumeric(input){
            var RE = /^-{0,1}\d*\.{0,1}\d+$/;
            return (RE.test(input));
        }
        
        function validateEmail(email) { 
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        } 
        </script>

</div>
<?php
}
?>

