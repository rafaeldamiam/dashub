<?php 
define('ACCESS', true);

class Access
{
	public static function accessLogin($user)
	{
		if(!empty($user)){
			$_SESSION["access"] = array(
				"id" => $user["id"],
				"name" => $user["name"],
				"email" => $user["email"],
				"role" => $user["role"]
			);
			return true;
		}else{
			return false;
		}
		
	}

	public static function accessLogout()
	{
		if(isset($_SESSION["access"])){
			$_SESSION["access"] = null;
			unset($_SESSION["access"]);
		}
	}

	public static function accessUserIsLogged(){
		return isset($_SESSION['access']);
	}

	public static function getAccessRoleUser()
	{
		if(Access::accessUserIsLogged()){
			return $_SESSION["access"]["role"];
		}
	}

	public static function getAccessEmailUser()
	{
		if(Access::accessUserIsLogged()){
			return $_SESSION["access"]["email"];
		}
	}

	public static function getAccessNameUser()
	{
		if(Access::accessUserIsLogged()){
			return $_SESSION["access"]["name"];
		}
	}

	public static function getRoleOfControllerAction($nameActionController) {
	    $rc = new ReflectionFunction($nameActionController);
	    $role = $rc->getDocComment();
	    $role = trim(substr($role, 3, -2));
	    return $role;
	}

}