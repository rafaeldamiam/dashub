<?php 

/**
 * 
 */
class View
{
	public static function showView($view, $data = array())
	{
		$viewFilePath = "view/{$view}.view.php";
		if(!file_exists($viewFilePath)){
			die("Not Found Any File: {$viewFilePath}");
		}

		extract($data);

		require("view/template/template.php");
	}

	public static function redirectView($path)
	{
		$finalPath = URL_BASE . $path;
		header("location: {$finalPath}");
		die();
	}

}
