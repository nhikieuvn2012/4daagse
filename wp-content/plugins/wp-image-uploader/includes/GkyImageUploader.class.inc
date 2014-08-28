<?php
Class GkyImageUploader {

    // upload images
    public function GkyUploadImage($files, $maxWidth) {
        
        
        
        foreach($files['files']['tmp_name'] as $key => $tmp_name ){

            
            
            $file_name = $files['files']['name'][$key];
            $file_size =$files['files']['size'][$key];
            $file_tmp =$files['files']['tmp_name'][$key];
            $file_type=$files['files']['type'][$key];

            // validate file type
            $valid_types = array("image/gif","image/png","image/jpg","image/jpeg","image/x-bitmap");
            if(in_array($file_type, $valid_types)){
            
            
                $month = date("m");
                $year = date("Y");

                // generate uploaded files url
                $my_site_url = get_site_url();
                $files_path = "$my_site_url/gky_uploads/$year/$month/";
                // instance object
                $layer = ImageWorkshop::initFromPath($file_tmp);


                // resize image, and add dimensions to array
                if($maxWidth){
                    $layer->resizeInPixel($maxWidth, null, true);
                    (int) $data['maxwidth'] = $maxWidth;
                }
                else {
                    (int) $data['maxwidth'] = $layer->getWidth();
                    if($data['maxwidth'] > 1500){
                        $layer->resizeInPixel(1500, null, true);
                        $data['maxwidth'] = 1500;
                    }
                }

                // get height
                (int) $data['height'] = $layer->getHeight();

                // add watermark to image
                if($data['maxwidth'] > 250){
                    $mark_width = $data['maxwidth']/5;
                    $watermarkLayer = ImageWorkshop::initFromPath('wp-content/plugins/wp-image-uploader/images/wmark.jpeg');
                    $watermarkLayer->resizeInPixel($mark_width, null, true);
                    $layer->addLayerOnTop($watermarkLayer, 5, 5, "LB");
                }
                else {
                    $watermarkLayer = ImageWorkshop::initFromPath('wp-content/plugins/wp-image-uploader/images/wmark.jpeg');
                    $layer->addLayerOnTop($watermarkLayer, 5, 5, "LB");
                }


                // upload settings
                $dirPath = "gky_uploads/$year/$month/";
                $createFolders = true;
                $backgroundColor = null;
                $imageQuality = 95; 
                $filename = time().'-'.$data['maxwidth'].'-x-'.$data['height'].'px-'.$file_name;

                $layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

                $data['location'] = $files_path.$filename;
                $data['filename'] = $filename;

                $images[] = $data;

                // delete object
                unset($layer);
                
            }
            else {
                echo "Please upload valid image";
            }
        }
            
        return $images;
        
    }
    
    // generate folder tree - for admin
    public function GenerateTree($folder){
        $folders = glob("$folder/*");
    
    
    
        // generate folders tree
        if($folders){
            foreach($folders as $folder){

                $sub_folders = glob("../gky_uploads/$folder/*");

                foreach($sub_folders as $month_folder){

                    $top_folder = explode("gky_uploads/",$folder);
                    $month_folder_name = explode("gky_uploads/../gky_uploads/",$month_folder);

                    $main_folder[$top_folder[1]][] = $month_folder_name[1];
                }
            }
        }
        return $main_folder;
    }

}
?>
