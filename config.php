<?php 

	spl_autoload_register(function($nameClass){
		$dirP = "..";
		$dirClass = "classes";
		$filename = $dirP . DIRECTORY_SEPARATOR .$dirClass . DIRECTORY_SEPARATOR . $nameClass . ".php";

		if(file_exists($filename)){
			require_once($filename);
		}
	})

 ?>