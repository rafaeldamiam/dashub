<?php

/**
 * CLASSE Services -> possui serviços como sanitizar os dados ndos do formulario  Services::sanitizeInput($VARIAVEL);
 */
class Services
{

	public static function sanitizeInput($var)
	{
		if(!empty($var)){
		    $var = filter_var( $var, FILTER_SANITIZE_EMAIL );
		    $var = filter_var( $var, FILTER_SANITIZE_SPECIAL_CHARS );
		    $var = filter_var( $var, FILTER_SANITIZE_URL );
		    $cleanVar = rtrim($var);
	
		    return $cleanVar;
		}else{
			echo "<script> alert('Preencha todos os campos'); </script> ";
			die();
		}
    }

    /*
     * REQUEST METHOD FILTER
     */
    public static function postMethod()
    {
    	return $_SERVER["REQUEST_METHOD"] == "POST";
    }

    public static function getMethod()
    {
    	return $_SERVER["REQUEST_METHOD"] == "GET";
    }


    /*
     * URL TREATMENT SECTION 
     */

    
    public static function cleanURI($position)
    {
        /*
         * This function return de name of the position required of the URL
         * Position 1 -> Application Name
         * Position 2 -> Controller Name
         * Position 3 -> Action Name
         */
        $array = explode('/', $_SERVER['REQUEST_URI']);
        
        if(!empty($array[$position])){
            return $array[$position];
        }

    }

    public static function urlBase()
    {
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        if(!empty($_SERVER["HTTPS"])){
            return "https://".$_SERVER['SERVER_NAME']."/".$uri[APP_POSITION-1]."/";
        }else{
    	   return "http://".$_SERVER['SERVER_NAME']."/".$uri[APP_POSITION-1]."/";
        }
    }

    public static function pageTitle()
    {
        if(!empty(Services::cleanURI(TITLE_POSITION))){
            return APP_NAME." - ".Services::cleanURI(TITLE_POSITION);
        }else{
            return APP_NAME;
        }
    }

    public static function treatURL() 
    {
        /* 
         * Two ways that the framework works: 
         * 0 -> paslite.com/controller/action/param1/param2/..
         * 1 -> localhost/paslite/controller/action/param1/param2/..
         */
        $uri = explode("/", filter_input(INPUT_SERVER, 'REQUEST_URI'));

        $nameController = Services::cleanURI(APP_POSITION);


        if (!$nameController && MAIN_CONTROLLER) {
            $nameController = MAIN_CONTROLLER;
        }

        $nameController = "controller/" . $nameController . ".controller.php";

        $positionActionController = APP_POSITION + 1;


        $nameActionController = (isset($uri[$positionActionController]) and !empty($uri[$positionActionController])) ? $nameActionController = $uri[$positionActionController] : 'index';

        $positionParameters = APP_POSITION + 2;

        $parameterscontroller = (count($uri) > $positionParameters) ? array_slice($uri, $positionParameters) : array();

        $url = array(
            "nameController" => $nameController,
            "nameActionController" => $nameActionController,
            "parametersController" => $parameterscontroller
        );
        
        return $url;
    }

    public static function treatFloat($row)
    {
        $array = explode(",", $row);
        $arrayEdited = $array[0];
        if(!empty($array[1])){
            $array = [$array[0],$array[1]];
            if(empty($array[0])){
                $array = [0,$array[1]];
            }
            $arrayEdited = floatval(0);
            $arrayEdited = implode(".", $array);
        }

        return $arrayEdited;
    }

    public static function checkImage($target_file, $size, $tmp_name )
    {
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        $check = getimagesize($tmp_name);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

    }
}