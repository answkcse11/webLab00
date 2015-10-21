<!DOCTYPE html>
<html>
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if(!(isset($_POST["name"]) && $_POST["name"]!="" && isset($_POST["id"]) && $_POST["id"]!=""
			&& isset($_POST["grade"]) && $_POST["grade"]!="" && isset($_POST["cardnumber"])
			&& $_POST["cardnumber"]!="" && isset($_POST["cardtype"]) && $_POST["cardtype"]!=""
			&& processCheckbox(array("cse326", "cse107","cse603","cin870"))!="")) {
			print $_POST["name"];
			print $_POST["id"];
			print $_POST["cse603"];
			print $_POST["cse326"];
			print $_POST["cse107"];
			print $_POST["cin870"];
			print $_POST["grade"];
			print $_POST["cardtype"];
			print $_POST["cardnumber"];
			print processCheckbox(array("cse326", "cse107","cse603","cin870"));
		?>
		<!-- Ex 4 : 
			Display the below error message : -->
				<h1>Sorry</h1>
				<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>
		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), or a single white space.
		} elseif (!(preg_match("/^[a-zA-z]-?([a-zA-z]+-?)*( )?([a-zA-z]+-?)*[a-zA-z]$/", $_POST["name"]))) { 
		?>

		<!-- Ex 5 : 
			Display the below error message : -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif (!(($_POST["cardtype"]=="visa" && preg_match("/^4[0-9]{15}/", $_POST["cardnumber"]))
			|| ($_POST["cardtype"]=="mastercard" && preg_match("/^5[0-9]{15}/", $_POST["cardnumber"])))) {
		?>

		<!-- Ex 5 : 
			Display the below error message : -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?= $_POST["name"] ?></li>
			<li>ID: <?= $_POST["id"] ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= processCheckbox(array("cse326", "cse107","cse603","cin870")) ?></li>
			<li>Grade: <?= $_POST["grade"] ?></li>
			<li>Credit <?= $_POST["cardnumber"]?> (<?= $_POST["cardtype"] ?>)</li>
		</ul>
		
		<!-- Ex 3 : --> 
			<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			$data_array = array();
			array_push($data_array, $_POST["name"]);
			array_push($data_array, $_POST["id"]);
			array_push($data_array, $_POST["cardnumber"]);
			array_push($data_array, $_POST["cardtype"]);
			$data = implode(";", $data_array);
			file_put_contents($filename, $data."\n", FILE_APPEND);
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
			<pre>
<?= file_get_contents($filename) ?>
			</pre>
		
		<?php
		}
		?>
		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){ 
				$result;
				$result_array = array();
				foreach($names as $name) {
					if(isset($_POST[$name]) && $_POST[$name]=="on") {
						array_push($result_array, $name);
					}
				}
				$result = implode(", ", $result_array);
				return $result;
			}
		?>
		
	</body>
</html>