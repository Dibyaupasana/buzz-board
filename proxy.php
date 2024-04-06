<?php
include_once("MainClass.php");
$objClass	= new MainClass();

$method = '';
$id = '';

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$method=$_POST['method'];
	

switch($method)
{
	case "viewMarks";
		$id = $_POST['s_id'];
		$objClass->viewMarks($id);

break;

default:
	echo json_encode(array('status'=>400, 'Error'=>'Bad request!'));

	break;
}
}
die();