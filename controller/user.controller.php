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
		Alert::showAlert(UserModel::addUser($name, $email, $password));
		
		$data = UserModel::takeUserByEmailPassword($email, $password);
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
	if(Services::postMethod()){
		$name = $_POST["name"];
		$email = $_POST["email"];
		Alert::showAlert(UserModel::editUser($id, $name, $email));
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