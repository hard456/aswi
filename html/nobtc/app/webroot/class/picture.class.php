<?php

// todo: opravit a predelat


class picture {
       var $save_dir;                    //where file will be saved
       var $filename="";        //default file name initially
       var $error_message="";            //string to be output if neccesary
       var $width;                        //height of final image
       var $height;                      //width of final image

       function picture($save_directory, $new_name, $file_array, $max_width, $max_height)
       {
               $this->save_dir = $save_directory;               
               $this->width =    $max_width;
               $this->height =  $max_height;

               //--change filename to time - make it unique
               $temp_filename = $file_array['name'];
               //p_g($file_array);
               $ext = explode('.',$temp_filename);
               $ext = strtolower($ext[count($ext)-1]);
               $temp_filename = time()."-".strtolower($new_name);
               //p_g($ext);
               //--create path
               $this->mkpath($this->save_dir);
               //--check that it's a jpeg or gif
               if (preg_match('/^(gif|png|jpe?g)$/', $ext)) {
                       // resize in proportion
                       
                       list($width_orig, $height_orig) = getimagesize($file_array['tmp_name']);
                       $this->width =    $width_orig;
                       $this->height =  $height_orig;
                       /*if ($this->width && ($width_orig < $height_orig)) {
                               $this->width = ($this->height / $height_orig) * $width_orig;
                       } else {
                               $this->height = ($this->width / $width_orig) * $height_orig;
                       }
                       */

                       $image_p = imagecreatetruecolor($this->width, $this->height);                       

                       //handle gifs and jpegs separately
                       if($ext=='gif'){
                           $image = imagecreatefromgif($file_array['tmp_name']);                           
                           imagecopyresampled($image_p, $image, 0, 0, 0, 0, $this->width, $this->height, $width_orig, $height_orig);
                           imagegif($image_p, $this->save_dir.$temp_filename);
                       }
                       else if($ext=='png') {
                          $image = imagecreatefrompng($file_array['tmp_name']);                           
                          imagecopyresampled($image_p, $image, 0, 0, 0, 0, $this->width, $this->height, $width_orig, $height_orig);
                          imagepng($image_p, $this->save_dir.$temp_filename);
                       }
                       else
                       {
                           $image = imagecreatefromjpeg($file_array['tmp_name']);                           
                           imagecopyresampled($image_p, $image, 0, 0, 0, 0, $this->width, $this->height, $width_orig, $height_orig);                           
                           imagejpeg($image_p, $this->save_dir.$temp_filename, 80);
                       }

                       imagedestroy($image_p);
                       imagedestroy($image);

                       $this->filename=$temp_filename;

               }else{
                       $this->error_message.="<br> file is not a jpeg, png or gif picture <br>";
                       //echo $this->error_message;
               }
       }
       
        function mkpath($path) {
            $dirs=array();
            $path=preg_replace('/(\/){2,}|(\\\){1,}/','/',$path); //only forward-slash
            $dirs=explode("/",$path);
            $path="";
            foreach ($dirs as $element) {
                $path.=$element."/";
                if(!is_dir($path)) {
                    if(!mkdir($path, 0777)) { 
                        echo "something was wrong at : ".$path; return 0; 
                    }
                }         
            }
        //echo("<B>".$path."</B> successfully created");
        }
}
