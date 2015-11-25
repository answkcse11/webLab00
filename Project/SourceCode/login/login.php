<?php
	//if it needs to include some php file then include

	if(isset($_POST["user_id"]) && isset($_POST["user_pass"]
		&& $_POST["user_id"]!=NULL && $_POST["user_pass"]!=NULL) {
		
		$id = $_POST["user_id"];
		$pw = $_POST["user_pass"];

		//db를 통해 입력된 ID와 PW를 비교한다.
		//call db select function

		header("Location:login.html");
	} else {
		//show some error detection page or popup
	}
?>