<?php

require_once "model/site.model.php";
require_once "model/tag.model.php";

/** user, admin */
function index(){
	$data["sites"] = SiteModel::takeAllSites();
	View::showView("site/list", $data);
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
		Debug::dump($_FILES["logo"]);
		if(!empty($_FILES["logo"])){
			$target_location = UPLOAD_LOCATION.$_FILES["logo"]["name"];
		}
		$title = Services::sanitizeInput($_POST["title"]);
		$url = filter_var($_POST["url"], FILTER_SANITIZE_URL);
		$description = Services::sanitizeInput($_POST["description"]);
		$tag = Services::sanitizeInput($_POST["tag"]);

		Debug::dd($url);
		Alert::showAlert(SiteModel::editSite($id, $name, $email));
		View::redirectView("site/show/{$id}");
	}else{
		$data["site"] = SiteModel::takeSiteById($id);
		$data["tags"] = TagModel::takeAllTags();
		View::showView("site/form", $data);
	}
}

/** user, admin */
function show($id){
	$data["site"] = SiteModel::showSiteById($id);
	View::showView("site/show", $data);
}