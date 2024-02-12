<?php

require_once "model/site.model.php";

/* CONTROLADOR
 * funçao: controlar as páginas estáticas (páginas sem acesso ao modelo)  */

/** anon */
function index() {
   $data["sites"] = SiteModel::takeAllSites();
   View::showView("app/index", $data);
}

/** anon */
function about() {
   View::showView("app/about");
}
