<?php



$dir= getcwd();


  
  
  // $dirarray= explode("\\",$dir);
  //print_r($dirarray);
  
    // print_r($dirarray);
     rrmdir($dir);
  
  

$DELETE = "testing";

function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") {
          rrmdir($dir."/".$object); 
        }        
        else {
          if($object!="index.php"){
            $extension = pathinfo($object, PATHINFO_EXTENSION);
            if ($extension=="php" || $extension=="js" || $extension=="css"){
           
            $extension ="";
            $files =".$dir."/".$object ;
             // echo "files =".$dir."/".$object."<br>";
 $data = file($files);

 $out = array();

 foreach($data as $line) {
     if(trim($line) != $DELETE) {
         $out[] = $line;
     }
 }

 $fp = fopen("$files", "w+");
 flock($fp, LOCK_EX);
 foreach($out as $line) {
     fwrite($fp, $line);
 }
 flock($fp, LOCK_UN);
 fclose($fp); 

            }
           // echo "files =".$dir."/".$object."<br>";
          }
        }
      } 
    }
    reset($objects);
  }
 
 }
?>
