<?php

/* CONTROLADOR
 * funçao: controlar as páginas estáticas (páginas sem acesso ao modelo)  */

/** anon */
function index() {
   View::showView("app/index");
}

/** anon */
function about() {
   View::showView("app/about");
}
