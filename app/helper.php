<?php
//use \App\Libs\Sessions;

function load_view($view, $data=array()){
	if(count($data)>0)extract($data);
	if(file_exists(__DIR__."/../views/sites/".$view.".php")) require __DIR__."/../views/sites/".$view.".php";
	if(file_exists(__DIR__."/../views/sites/".$view.".html")) require __DIR__."/../views/sites/".$view.".html";
}
function load_global($global){
	if(file_exists(__DIR__."/../views/globals/".$global.".php")) require __DIR__."/../views/globals/".$global.".php";
	if(file_exists(__DIR__."/../views/globals/".$global.".html")) require __DIR__."/../views/globals/".$global.".html";
}
/*function set_csrf(){
	$csrf=uniqid();
	Sessions::set("csrf", $csrf);
	return $csrf;
}
function check_csrf($csrf){
	return (Sessions::get("csrf")==$csrf)?true:false;
}*/
function previous($x){ //Funktion zum wiedergeben alter formular elemente (falls form invalid)
	return(isset($_POST[$x]))?trim($_POST[$x]):"";
}
function countCart(){
	print_r(json_decode(\App\Libs\Sessions::get('cart'), true));
}