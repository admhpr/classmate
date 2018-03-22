<?php  
    
    $file = this.cmData.image_path;

    if (file_exists($file))
    {
        // Note: You should probably do some more checks 
        // on the filetype, size, etc.
        $contents = file_get_contents($file);

        // Note: You should probably implement some kind 
        // of check on filetype
        

        echo $contents;
    }

?>