<!DOCTYPE html>
<html>
<head>
    <title>Dictionary</title>
    <meta charset="utf-8" />
    <link href="dictionary.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>My Dictionary</h1>
<!-- Ex. 1: File of Dictionary -->
    <p>
        <?php
            $filename = "dictionary.tsv";
            $lines = file($filename);
            $size = filesize($filename);
            $count = count($lines);
            print "My dictionary has $count total words and size of $size bytes.";
        ?>
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's words</h2>
<!-- Ex. 2: Today’s Words & Ex 6: Query Parameters -->
        <?php
            if(isset($_GET["number_of_words"])) {
                $numberOfWords = $_GET["number_of_words"];
            } else {
                $numberOfWords = 3;
            }
            function getWordsByNumber($listOfWords, $numberOfWords){
                $resultArray = array();
                $indexOfTodaysWords = array();
                $rand = array_rand($listOfWords, $numberOfWords);
                if(is_int($rand)) {
                    array_push($indexOfTodaysWords, $rand);
                } else {
                    $indexOfTodaysWords = $rand;
                }
                foreach($indexOfTodaysWords as $index) {
                    array_push($resultArray, $listOfWords[$index]);
                }
                return $resultArray;
            }
            $todaysWords = getWordsByNumber($lines, $numberOfWords);
        ?>
            <ol>
        <?php
            foreach($todaysWords as $word) {
                $wordArray = explode("\t", $word);
        ?>
                <li> <?=$wordArray[0]?> - <?=$wordArray[1]?> </li>
        <?php
            }
        ?>
            </ol>
    </div>
    <div class="section">
        <h2>Searching Words</h2>
<!-- Ex. 3: Searching Words & Ex 6: Query Parameters -->
        <?php
            if(isset($_GET["character"])) {
                $startCharacter = $_GET["character"];
            } else {
                $startCharacter = "C";
            }
            $searchedWords = array();
            function getWordsByCharacter($listOfWords, $startCharacter){
                $resultArray = array();
                foreach($listOfWords as $word) {
                    if($word[0] == $startCharacter) {
                        array_push($resultArray, $word);
                    }
                }
                return $resultArray;
            }
            $searchedWords = getWordsByCharacter($lines, $startCharacter);
        ?>
        <p>
            Words that started by <strong>'<?=$startCharacter?>'</strong> are followings :
        </p>
            <ol>
        <?php
            foreach($searchedWords as $word) {
                $wordArray = explode("\t", $word);
        ?>
                <li> <?=$wordArray[0]?> - <?=$wordArray[1]?> </li>
        <?php
            }
        ?>
            </ol>
    </div>
    <div class="section">
        <h2>List of Words</h2>
<!-- Ex. 4: List of Words & Ex 6: Query Parameters -->
        <?php
            if(isset($_GET["orderby"])) {
                $orderby = $_GET["orderby"];
            } else {
                $orderby = 0;
            }
            function getWordsByOrder($listOfWords, $orderby){
                $resultArray = $listOfWords;
                if($orderby == 0) {
                    $resultArray = sort($listOfWords);
                } else {
                    $resultArray = rsort($listOfWords);
                }
                return $resultArray;
            }
            if($orderby == 0) {
                $order = "";
            } else {
                $order = "reverse";
            }
        ?>
            <p>
                All of words ordered by <strong>alphabetical <?=$order?> order</strong> are followings :
            </p>
        <?php
            $resultArray = getWordsByOrder($lines, $orderby);
            foreach($lines as $word) {
                    $wordArray = explode("\t", $word);
                    if(strlen($wordArray[0])>6) {
                        $class = " class=\"long\"";
                    } else {
                        $class = "";
                    }
        ?>
                    <li<?=$class?>> <?=$wordArray[0]?> -  <?=$wordArray[1]?> </li>
        <?php
            }
        ?>
    </div>
    <div class="section">
        <h2>Adding Words</h2>
<!-- Ex. 5: Adding Words & Ex 6: Query Parameters -->
        <?php
            if(isset($_GET["new_word"]) && isset($_GET["meaning"])) {
                $newWord = $_GET["new_word"];
                $meaning = $_GET["meaning"];
            }
            if(isset($newWord) && isset($meaning)) {
                $new_text = "\n$newWord\t$meaning";
                file_put_contents($filename, $new_text, FILE_APPEND);
        ?>
                <p>Adding a word is success!</p>
        <?php
            } else {
        ?>
                <p>Input word or meaning of the word doesn't exist.</p>
        <?php    
            }
        ?>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>