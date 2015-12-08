<!DOCTYPE html>
<html>

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/4/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?=$song_count=5678;?> total songs,
			which is over <?=$total_time=567;?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
		
			<ol>
				<?php
				if(isset($_GET["newspages"]) && $_GET["newspages"]!="")
					$newspages = $_GET["newspages"];
				else
					$newspages = 5;
				for($i=1; $i<=$newspages; $i++) {
				?>
				<li><a href="http://music.yahoo.com/news/archive/?page=<?=$i?>">Page <?=$i?></a></li>
				<?php
				}
				?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php
				$song_array = file("favorite.txt");
				for($i=0; $i<sizeof($song_array); $i++) {
				?>
					<li><a href="http://en.wikipedia.org/wiki/<?=str_replace(" ", "_", $song_array[$i]);?>"><?=$song_array[$i]?></a></li>
				<?php
				}
				?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php
				$mp3_array = glob("problem4/musicPHP/songs/*.mp3");
				for($i=0; $i<sizeof($mp3_array); $i++) {
				?>
				<li class="mp3item">
					<a href="<?=$mp3_array[$i]?>"><?=basename($mp3_array[$i]);?></a> (<?=(int)(filesize($mp3_array[$i])/1024);?> KB)
				</li>
				<?php
				}
				?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php
				$m3u_array = glob("problem4/musicPHP/songs/*.m3u");
				for($i=0; $i<sizeof($m3u_array); $i++) {
				?>
				<li class="playlistitem"><?=basename($m3u_array[$i]);?>:
					<ul>
						<?php
						$playlist = file($m3u_array[$i]);
						foreach($playlist as $song) {
							if(strpos($song, "#") === false) {
						?>
								<li><?=$song?></li>
						<?php
							}
						}
						?>
					</ul>
				</li>
				<?php
				}
				?>
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
