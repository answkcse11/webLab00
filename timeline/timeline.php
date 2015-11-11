<?php
    class TimeLine {
        # Ex 2 : Fill out the methods
        private $db;
        function __construct()
        {
            # You can change mysql username or password
            $this->db = new PDO("mysql:host=localhost;dbname=timeline", "root", "root");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        public function add($tweet) // This function inserts a tweet
        {
            //Fill out here
            $querystring = "INSERT INTO tweets (author, content, time) values ('$tweet[0]', '$tweet[1]', now())";
            $resultAdd = $this->db->exec($querystring);
            return $resultAdd;
        }
        public function delete($no) // This function deletes a tweet
        {
            //Fill out here
            $querystring = "DELETE FROM tweets WHERE no = $no";
            $resultDel = $this->db->exec($querystring);
            return $resultDel;
        }
        # Ex 6: hash tag
        # Find has tag from the contents, add <a> tag using preg_replace() or preg_replace_callback()
        public function loadTweets() // This function load all tweets
        {
            //Fill out here
            $resultLoad = $this->db->query("SELECT * FROM tweets");
            return $resultLoad;
        }
        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
            //Fill out here
            $querystring = "SELECT * FROM tweets WHERE $type LIKE '%$query%'";
            $resultSearch = $this->db->query($querystring);
            return $resultSearch;
        }
    }
?>
