<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simple Timeline</title>
        <link rel="stylesheet" href="timeline.css">
        <?php
            include 'timeline.php';
        ?>
    </head>
    <body>
        <?php
            $result;
            $timeline = new Timeline();
        ?>
        <div>
            <a href="index.php"><h1>Simple Timeline</h1></a>
            <div class="search">
                <!-- Ex 3: Modify forms -->
                <form class="search-form" action="index.php" method="get">
                    <input type="submit" value="search">
                    <input type="text" placeholder="Search" name="query">
                    <select name="type">
                        <option value="author">Author</option>
                        <option value="content">Content</option>
                    </select>
                </form>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <!-- Ex 3: Modify forms -->
                    <form class="write-form" action="add.php" method="post">
                        <input type="text" placeholder="Author" name="author">
                        <div>
                            <input type="text" placeholder="Content" name="content">
                        </div>
                        <input type="submit" value="write">
                    </form>
                </div>
                <!-- Ex 3: Modify forms & Load tweets -->
                <div class="tweet">
                    <?php
                        $result;
                        $timeline = new Timeline();
                        if(isset($_GET["type"]) && isset($_GET["query"])
                            && $_GET["type"]!="" && $_GET["query"]!="") {
                            $result = $timeline->searchTweets($_GET["type"], $_GET["query"]);
                        } else {
                            $result = $timeline->loadTweets();
                        }
                        foreach ($result as $row) {
                            $content = $row['content'];
                            $replaced = preg_replace_callback("/#[^\s#]+/",
                                create_function('$matches',
                                    '$tag = substr($matches[0], 1);
                                    return "<a href=index.php?type=content&query=$tag>$matches[0]</a>";'), 
                                $content);
                    ?>
                    <form class="delete-form" action="delete.php" method="post" >
                    <input type="submit" value="delete">
                    <input type="hidden" name="no" value=<?=$row['no']?>>
                    </form>
                    <div class="tweet-info">
                        <span><?=$row['author']?></span>
                        <span><?=date('H:i:s d/m/Y',strtotime($row['time']))?></span>
                    </div>
                    <div class="tweet-content">
                        <?=$replaced?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
