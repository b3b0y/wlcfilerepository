<?php

	$dir2 = "C:/xampp/htdocs/WLCFileRepoRev/Data";


	function listFolderFiles($dir)
	{
		
	    $ffs = scandir($dir);
	   
	    foreach($ffs as $ff)
	    {
	        if($ff != '.' && $ff != '..'){
	           $folders['name'][] = $ff;
	            if(is_dir($dir.'/'.$ff)) 
	            {
	            	$dir2 = $dir.'/'.$ff;
	            	$ffs2 = scandir($dir2);
	   
				    foreach($ffs2 as $ff2)
				    {
				        if($ff2 != '.' && $ff2 != '..'){
				           $folders['name'][] = $ff2;
				           
				        }
				    }
	            }
	        }
	    }
	   	return @array('folders' => $folders);
	}

$dir_content = listFolderFiles($dir2);

$folders['name'] = $dir_content['folders']['name'];

foreach($folders['name']as $ff)
{
	echo $ff."<br>";
}
?>
