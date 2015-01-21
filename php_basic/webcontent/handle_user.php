<?php
if($_POST["array"]) {
	//User hit the save button, handle accordingly
	echo "Hi arrays";
	include "arrays.php";
}
//You can do an else, but I prefer a separate statement
if($_POST["function"]) {
	//User hit the Submit for Approval button, handle accordingly
	echo "Hi function";
	include "function.php";
}