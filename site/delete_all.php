<?php
$files = glob('temp/*.*'); // get all file names
echo "<pre>";
$f_count = 0;
foreach($files as $file){ // iterate files
  if(is_file($file)) {
      
      unlink($file); // delete file
      echo 'deleted ' .  $file . '<br>';
      $f_count++;
  }
  
  
    
}

echo 'total ' .  $f_count . ' files<br>';

echo "</pre>";

?>