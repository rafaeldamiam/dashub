<?php

require_once "model/site.model.php";

/** user, admin */
function index(){
	$data["sites"] = SiteModel::takeAllSites();
	View::showView("site/list", $data);
}

/** user, admin */
function add(){
	if(Services::postMethod())
	{
		$title = Services::sanitizeInput($_POST["title"]);
		$url = filter_var($_POST["url"], FILTER_SANITIZE_URL);
		$description = Services::sanitizeInput($_POST["description"]);
		//$size, $tmp_name
		$imageState = Services::sanitizeImage($_FILES["profile"]["size"], $_FILES["profile"]["tmp_name"]);

		$imageExtension = explode(".", $_FILES["profile"]["name"]);

		Alert::showAlert(SiteModel::addSite($title, $url, $description));

		$data = SiteModel::takeSiteByUrlDescription($url, $description);
		

		$imageLocation = UPLOAD_LOCATION."/site/{$data["id"]}.{$imageExtension[1]}";

		if($imageState === False){
			$imageLocation = "public/assets/site.png";
		}else{
			move_uploaded_file($_FILES["profile"]["tmp_name"], $imageLocation);
		}

		Alert::showAlert(SiteModel::editSiteLogo($data["id"], $imageLocation));
		
		View::redirectView("site/show/{$data["id"]}");
	}else{
		View::showView("site/form");
	}

}

/** user, admin */
function delete($id){
	$siteLogo = SiteModel::takeSiteLogoById($id);
	$siteLogo = "/dashub/".$siteLogo["logo"];
	if($siteLogo != "public/assets/site.png"){
		unlink($siteLogo);
	}
	Alert::showAlert(SiteModel::deleteSite($id));
	View::redirectView("site/index");
}

/** user, admin */
function edit($id)
{
	if(Services::postMethod())
	{
		$id = Services::sanitizeInput($_POST["id"]);
		$title = Services::sanitizeInput($_POST["title"]);
		$url = filter_var($_POST["url"], FILTER_SANITIZE_URL);
		$description = Services::sanitizeInput($_POST["description"]);
		//$size, $tmp_name
		$imageState = Services::sanitizeImage($_FILES["profile"]["size"], $_FILES["profile"]["tmp_name"]);

		$imageExtension = explode(".", $_FILES["profile"]["name"]);

		$imageLocation = UPLOAD_LOCATION."/site/{$_POST["id"]}.{$imageExtension[1]}";

		if($imageState === False){
			$imageLocation = "public/assets/site.png";
		}else{
			move_uploaded_file($_FILES["profile"]["tmp_name"], $imageLocation);
		}

		Alert::showAlert(SiteModel::editSite($id, $title, $url, $description, $imageLocation));
		View::redirectView("site/show/{$id}");
	}else{
		$data["site"] = SiteModel::takeSiteById($id);
		View::showView("site/form", $data);
	}
}

/** user, admin */
function show($id){
	$data["site"] = SiteModel::takeSiteById($id);
	View::showView("site/show", $data);
}