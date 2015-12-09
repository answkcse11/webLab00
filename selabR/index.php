<!DOCTYPE html>
<!--
	1. Form - Register Page for SELab
	index.php를 완성하여 아래 등록 페이지를 스크린샷 처럼 생성하시오 (스크린샷은 맥의 Firefox에서) 
	
	대부분의 text는 주어졌으며; 지시 없이 text를 수정하는 것 금지.
	아래 사양에 맞게 적절한 HTML 태그와 PHP 코드를 작성하시오.
	
	1.Form : 
		(a) 사용자 입력을 HTTP POST request를 통하여 register.php로 제출하는 form을 생성하시오
		(b) form은 form 데이터(text)와 파일 모두를 제출할 수 있어야 함 
	
	2. Email, Password, and  Name : 
		(a) query parameter의 이름이 email인 text field를 생성하시오    
		(b) query parameter의 이름이 password인 암호를 위해 특별히 디자인 된 text field를 생성하시오  
		(c) query parameter의 이름이 name인 text field를 생성하시오'
		
	3.Status : 
		(a) 스크린 샷에서 보이는 것 처럼 radio button 그룹을 생성하시오  
		(b) radio button의 query parameter의 이름이 status이고 값이 undergraduate, master, phd이 될수 있도록 설정하시오 
	
	4.Courses :
		(a) 스크린 샷에서 보이는 것 처럼 check box 그룹을 생성하시오 
		(b) check box의 query parameter의 이름이 각각 web, logic, model이 되도록 설정하시오 
		(c) Web Application Development check box가 처음에 그리고 기본적으로 체크 되어 있도록 설정하시오.  
		
	5. Favorite Programming Language : 
		(a) query parameter의 이름이 language인 drop-down list를 생성하고 이 list의 가능한 값을 c, java, python, php, js가 되도록 설정하시오  
		
	6. File Upload : 
		(a) query parameter의 이름이 profile이며 파일 업로드를 가능하게 하는 form control을 생성하시오 
		
	7. Reset & Submit Button :
		(a) 리셋과 제출 버튼을 생성하시오 
		
	8. Member Lists : 
		(a) member.txt파일을 한줄 한줄 읽어서 스크린 샷에 보이는 것처럼 읽은 정보를 적절히 보여주는 PHP 코드를 작성하시오. 
			(처음에 member.txt에는 김가연 조교의 정보가 적혀 있음.)
			
	--------------------------------------------------
	HTML coding - Form.
	
	index.php에 SELab 등록 form을 생성하시오. 
		* 폴더/디렉터리 구조나 index.php와 register.php파일 이외에는 수정하지 마시오. 
		* 불필요하거나 오래되거나 폐기된 태그 사용 금지 (감점!)
-->

<html>
    <head>
        <meta charset="utf-8">
        <title>SElab Register</title>
        <link href="resource/style.css" rel="stylesheet" />
    </head>
    <body>
        <div class="wrap">
            <h1>Register</h1>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <div>Email : <input type="text" name="email" /></div>
                <div>Password : <input type="password" name="password" /></div>
                <div>Name : <input type="text" name="name" /></div>
                    <fieldset>
                        <legend>Status</legend>
                        <input type="radio" name="status" value="undergraduate" >Undergraduate</input>
                        <input type="radio" name="status" value="master" >Master</input>
                        <input type="radio" name="status" value="phd" >Ph.D</input>
                    </fieldset>
                    <fieldset>
                        <legend>Courses</legend>
                        <input type="checkbox" name="web" checked="checked">Web Application Development</input>
                        <input type="checkbox" name="logic" >Logical Fundamentals of Programming</input>
                        <input type="checkbox" name="model" >Model Checking</input>
                    </fieldset>
                <div>
                    Favorite Programming Language :
                    <select name="language">
                        <option selected="selected">C</option>
                        <option>Java</option>
                        <option>Python</option>
                        <option>PHP</option>
                        <option>JavaScript</option>
                    </select>
                </div>
                <div>    
                    Profile Image : <input type="file" name="profile" />
                </div>
                <div>
                	<input type="reset" value="초기화" />
                    <input type="submit" value="질의 보내기" />
                </div>
            </form>
            <hr />
            <h2>Members List</h2>
            <ul>
            		<?php // 1-8a read file and display read information. use 'file_get_contents' 
                    $text = file_get_contents("resource/members.txt");
                    $members = explode("\n", $text);
                    for($i=0; $i<sizeof($members)-1; $i++) {
                        $member = $members[$i];
                        $info = explode(";", $member);
                    ?>
            		<!-- 
                <li>Gayeon Kim<br/>
                    <ul>
                        <li>Email : gayeonkim91@gmail.com</li>
                        <li>password : notrealpassword</li>
                        <li>status : Master</li>
                        <li>courses : Web Application Development, Model Checking</li>
                        <li>favorite programming language : JavaScript</li>
                    </ul>
                </li>
                -->
                <li><?=$info[2]?></li>
                <ul>
                    <li>Email : <?=$info[0]?></li>
                    <li>password : <?=$info[1]?></li>
                    <li>status : <?=$info[3]?></li>
                    <li>courses : <?=$info[4]?></li>
                    <li>favorite programming language : <?=$info[5]?></li>
                </ul>
                <?php
                }
                ?>
            </ul>
        </div>
    </body>
</html>
