<?php
    include 'timeline.php';
    # Ex 4 : Write a tweet
    try {
        if (preg_match("/^(?=.{1,20}$)([a-zA-z]+[\-\s]?[a-zA-z]+)*[a-zA-Z]$/", $_POST["author"])) {
            #validate author & content call add function
            $content = htmlspecialchars($_POST['content']);

            #insert into table
            $timeline = new TimeLine();
            $timeline->add(array($_POST["author"], $content));
            header("Location:index.php"); #redirect to index.php
        } else {
            header("Location:error.php");
        }
    } catch(Exception $e) {
        header("Location:error.php");
    }
?>