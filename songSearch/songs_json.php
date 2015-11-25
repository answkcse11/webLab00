<?php
$SONGS_FILE = "songs_shuffled.txt";

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

$top = "";

if (isset($_REQUEST["top"])) {
	$top = preg_replace("/[^0-9]*/", "", $_REQUEST["top"]);
}

if (!file_exists($SONGS_FILE)) {
	header("HTTP/1.1 500 Server Error");
	die("ERROR 500: Server error - Unable to read input file: $SONGS_FILE");
}

header("Content-type: application/json");

print "{\n  \"songs\": [\n";

// write a code to : 
// 1. read the "songs.txt" (or "songs_shuffled.txt" for extra mark!)
// 2. search all the songs that are under the given top rank 
// 3. generate the result in JSON data format 

	$songs = explode("\n", file_get_contents($SONGS_FILE));
	for($i=1; $i <= $top; $i++) {
		foreach ($songs as $song) {
			$array = explode("|", $song);
			if($array[2]==$i) {
				print "{";
				print "\"rank\": "."\"".$array[2]."\", ";
				print "\"title\": "."\"".$array[0]."\", ";
				print "\"artist\": "."\"".$array[1]."\", ";
				print "\"genre\": "."\"".$array[3]."\", ";
				print "\"time\": "."\"".$array[4]."\"}";
				if($array[2]<$top) print ",\n";
			}
		}		
	} 


print "  ]\n}\n";

?>
