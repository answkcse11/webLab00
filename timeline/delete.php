<?php
# Ex 5 : Delete a tweet
	include 'timeline.php';

	try {
		$timeline = new TimeLine();
		$timeline->delete($_POST['no']);
	    header("Location:index.php");
	} catch(Exception $e) {
	    header("Location:error.php");
	}
?>
