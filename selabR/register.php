<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="resource/style.css" rel="stylesheet" />
        <title>SElab Register</title>
    </head>
    <body>
        <div class="wrap">
        <?php
        	/*	2.PHP - Process Registration to SELab
			 *	
			 *  아래 사양에 맞게 register.php를 완성하시오. 
			 * 
			 *  	1. Parameter Check :
			 * 			(a) 필요한 모든 parameter가 전달 되었는지 아닌지를 검사하는 코드를 작성하시오 (form이 완벽히 채워졌는재 아닌지를 검사) 
			 * 			(b) 만약 필요한 모든 parameter가 전달이 안되었다면 아래와 같은 스크린샷과 같은 페이지가 제공됨 (try again? 링크는 index.php와 링크 되어 있음.)
			 * 
			 * 		2. Input Validation :
			 * 			(a) 정규 표현식을 사용하여 전달된 email parameter의 유효성을 검사하는 컨디션을 작성하시오 
			 * 				- 정규 표현식 : 알파벳, 숫자, -, _ 중 1개 이상으로 이루어진 조합, 그 후에 @ 1개, 그 후에 다시 알파벳, 숫자, -, _, 1에서 2개까지의 반복되지 않 . 중 1개 이상으로 이루어진 조합
			 * 			(b) email parameter가 유효하지 않았다면, 아래 스크린샷과 같은 페이지가 반환됨  
			 * 			(c) 정규 표현식을 사용하여 전달된 password parameter의 유효성을 검사하는 컨디션을 작성하시오
			 * 			(d) password parameter가 유효하지 않았다면, 아래 스크린샷과 같은 페이지가 반환됨
			 * 			(e) 정규 표현식을 사용하여 전달된 name parameter의 유효성을 검사하는 컨디션을 작성하시오
			 * 			(f) name parameter가 유효하지 않았다면, 아래 스크린샷과 같은 페이지가 반환됨
			 * 
			 * 		3. Processing Uploaded File :
			 * 			(a) 제공된 파일이름의 파일이 업로드 되었는지 체크하는 컨디션을 작성하시오. 
			 * 			(b) 파일이 업로드 되지 않았다면, 아래 스크린샷과 같은 페이지가 반환됨
			 * 			(c) 파일이 업로드 되었다면 임시 장소에 저장되었던 파일을 uploaded 폴터/디렉터리로 이동하며 파일이름으로는 name parameter의 값을 사
			 * 
			 * 		4. Processing Registration :
			 * 			(a) 모든 parameter가 전달 되었고 문제가 없다면, member.txt에 저장되어 있는 정보과 같은 포멧으로 데이터를 정리하고 이를 member.txt에 붙임 
			 * 			(b) check box에서 선택된 과목들을 다 찾아서 이어주는 processCheckbox 함수를 완성하시오. 
			 * 			(c) 성공적인 등록은 아래 스크린 샷과 같은 페이지 반환 
			 */

            if(isset($_POST["email"]) && $_POST["email"]!="" && isset($_POST["password"]) && $_POST["password"]!="" &&
                isset($_POST["name"]) && $_POST["name"]!="" && isset($_POST["status"]) && $_POST["status"]!="" &&
                isset($_POST["language"]) && $_POST["language"]!="") { // 2-1(a) check whether parameters were passed 
                if(!(preg_match("/^([a-zA-Z\d_-]+)@(([\da-zA-Z_-]+)\.([\da-zA-Z_-]+)){1,2}$/", $_POST["email"]))){ // 2-2(a) email validation using regular expression
					// 2-2(b) invalid email error ?>
                    <h1>ERROR!</h1>
                    <p>You didn't provide valid Email. <a href="index.php">Try Agian?</a></p>
                <?php
                } else if(!(preg_match("/[\da-zA-Z]{6,20}/", $_POST["password"]))) { // 2-2(c) password validation using regular expression
					// 2-2(d) invalid password error ?>
                    <h1>ERROR!</h1>
                    <p>You didn't provide valid password. <a href="index.php">Try Agian?</a></p> 
                <?php
                } else if(!(preg_match("/([a-zA-Z]+(\s)?)*/", $_POST["name"]))){ // 2-2(e) name validation using regular expression
					// 2-2(f) invalid name error ?>
                    <h1>ERROR!</h1>
                    <p>You didn't provide valid name. <a href="index.php">Try Agian?</a></p>
                <?php
                } else {
                    if(is_uploaded_file($_FILES["profile"]["tmp_name"])) { //2-3(a) check file uploaded,
                    // 2-3(c) upload file
                        $filename = $_POST["name"]."_".$_FILES["profile"]["name"].".jpg";
                        move_uploaded_file($_FILES["profile"]["tmp_name"], "uploaded/$filename");
                    // 2-4(a) append data into members.txt
                    // 2-4(b) complete and use processCheckbox function
                        $newMember = array();
                        array_push($newMember ,$_POST["email"]);
                        array_push($newMember ,$_POST["password"]);
                        array_push($newMember ,$_POST["name"]);
                        array_push($newMember ,$_POST["status"]);
                        array_push($newMember ,processCheckbox());
                        array_push($newMember ,$_POST["language"]);

                        file_put_contents("resource/members.txt", implode(";", $newMember)."\n", FILE_APPEND);
                    // 2-4(c) display succesful registration ?>
                        <h1>Welcome, <?=$newMember[2]?>!</h1>
                        <img alt="profile" src="uploaded/<?=$filename?>"/>
                        <ul>
                            <li>Email : <?=$newMember[0]?></li>
                            <li>Name : <?=$newMember[2]?></li>
                            <li>Password : <?=$newMember[1]?></li>
                            <li>Courses : <?=$newMember[4]?></li>
                            <li>Favorite Programming Language : <?=$newMember[5]?></li>
                        </ul>
                        <p>
                            <a href="index.php">Register page</a>
                        </p>
                    <?php  } else { //2-3(b) file not uploaded error ?>
                                <h1>ERROR!</h1>
                                <p>You didn't provide valid profile image. <a href="index.php">Try Agian?</a></p>
                    <?php  } ?>
                <?php  } ?>
        <?php  } else { // 2-1(b) Error Page when form is not completely filled ?>
                    <h1>ERROR!</h1>
                    <p>You didn't fill out the form completely. <a href="index.php">Try Agian?</a></p>
        <?php  }
        // 2-4b concatenates selected courses from the checkbox into a single string
        function processCheckbox() {
            $courses = array();
            if(isset($_POST["web"]) && $_POST["web"]=="on")
                array_push($courses, "Web Application Development");
            if(isset($_POST["logic"]) && $_POST["logic"]=="on")
                array_push($courses, "Logical Fundamentals of Programming");
            if(isset($_POST["model"]) && $_POST["model"]=="on")
                array_push($courses, "Model Checking");
            return implode(", ", $courses);
        } ?>
        </div>
    </body>
</html>
