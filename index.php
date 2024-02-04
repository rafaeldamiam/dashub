<?php

session_start();
foreach (glob("application/*.app.php") as $filename){ require_once $filename;}

extract(Services::treatURL());

if(!file_exists($nameController)){
	die("Not found any file: {$nameController}");
}

require_once $nameController;

try {
    if (!is_callable($nameActionController)) {
        die('Not found <code>"' . $nameActionController . '"</code> of controller <code>"' . $nameController . '"</code>');
    }

    $released = true;

    if (defined('ACCESS')) {
        $role = Access::getRoleOfControllerAction($nameActionController);
        $roles = explode(",", $role);
        $userRole = Access::getAccessRoleUser();
        foreach ($roles as $role) {
            $released = true;
            $role = trim($role);
            if (!empty($role) && $role !== $userRole) {
                $released = false;
                $authMsg = "The user doesn't have permission to access this function";
            }
            if (!empty($role) && !Access::accessUserIsLogged()) {
                $released = false;
                $authMsg = "You must login first";
            }
            if (!empty($role) && $role == "anon") {
                $released = true;
            }
            if ($released) {
                break;
            }
        }
    }

    if ($released) {
        call_user_func_array($nameActionController, $parametersController); 
    } else {
        Alert::showAlert($authMsg, "warning");
        View::redirectView("login/index");
    }

} catch (ArgumentCountError $e) {
    echo "404!";
}