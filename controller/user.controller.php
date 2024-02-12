<?php

require_once "model/user.model.php";

/** user, admin */
function index(){
	$data["users"] = UserModel::takeAllUsers();
	View::showView("user/list", $data);
}

/** user, admin */
function add(){
	if(Services::postMethod()){
		$name = Services::sanitizeInput($_POST["name"]);
		$email = Services::sanitizeInput($_POST["email"]);
		$password = Services::sanitizeInput($_POST["password"]);
		//$size, $tmp_name
		$imageState = Services::sanitizeImage($_FILES["profile"]["size"], $_FILES["profile"]["tmp_name"]);

		$imageExtension = explode(".", $_FILES["profile"]["name"]);

		Alert::showAlert(UserModel::addUser($name, $email, $password));

		$data = UserModel::takeUserByEmailPassword($email, $password);
		

		$imageLocation = UPLOAD_LOCATION."/user/{$data["id"]}.{$imageExtension[1]}";

		if($imageState === False){
			$imageLocation = "public/assets/user.png";
		}else{
			move_uploaded_file($_FILES["profile"]["tmp_name"], $imageLocation);
		}

		Alert::showAlert(UserModel::editUserProfileImage($data["id"], $imageLocation));
		
		View::redirectView("user/show/{$data["id"]}");
	}else{
		View::showView("user/form");
	}

}

/** user, admin */
function delete($id){
	Alert::showAlert(UserModel::deleteUser($id));
	View::redirectView("user/index");
}

/** user, admin */
function edit($id)
{
	if(Services::postMethod())
	{
		$id = Services::sanitizeInput($_POST["id"]);
		$name = Services::sanitizeInput($_POST["name"]);
		$email = Services::sanitizeInput($_POST["email"]);
		$password = Services::sanitizeInput($_POST["password"]);
		//$size, $tmp_name
		$imageState = Services::sanitizeImage($_FILES["profile"]["size"], $_FILES["profile"]["tmp_name"]);

		$imageExtension = explode(".", $_FILES["profile"]["name"]);

		$imageLocation = UPLOAD_LOCATION."/user/{$_POST["id"]}.{$imageExtension[1]}";

		if($imageState === False){
			$imageLocation = "public/assets/user.png";
		}else{
			move_uploaded_file($_FILES["profile"]["tmp_name"], $imageLocation);
		}

		Alert::showAlert(UserModel::editUser($id, $name, $email, $password, $imageLocation));
		View::redirectView("user/show/{$id}");
	}else{
		$data["user"] = UserModel::takeUserById($id);
		View::showView("user/form", $data);
	}
}

/** user, admin */
function show($id){
	$data["user"] = UserModel::takeUserById($id);
	View::showView("user/show", $data);
}