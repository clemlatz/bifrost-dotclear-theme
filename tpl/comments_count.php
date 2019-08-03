<?php
$dbhost = "10.0.205.6";
$dbuser = "belial";
$dbpass = "jFuSNZ37";
$dbbase = "belial";

$mysql_connection = mysql_connect($dbhost,$dbuser,$dbpass) or die("<h1>Maintenance du site en cours...</h1><p>Merci de votre compréhension.</p>");
mysql_select_db($dbbase);

$sql = mysql_query("SELECT `topic_id` FROM `comments` WHERE `post_url` = '".$_SERVER['REQUEST_URI']."'") or die("Erreur : ".mysql_error());
$num = mysql_num_rows($sql);

if(empty($num)) {
    $sql = mysql_query("SELECT `topic_id` FROM `phpbb_topics` WHERE `blog_url` = '".$_SERVER['REQUEST_URI']."'") or die("Erreur : ".mysql_error());
    $num = mysql_num_rows($sql);
}

if(!empty($num)) {
    $topic_id = mysql_result($sql,0,'topic_id');
    $sql_comm = mysql_query("SELECT `post_text` FROM `phpbb_posts` WHERE `topic_id` = '".$topic_id."' ORDER BY `post_id` DESC") or die("Erreur : ".mysql_error());
    $num_comm = mysql_num_rows($sql_comm);
    $num_comm--;
    echo '&nbsp; <a href="http://forums.belial.fr/viewtopic.php?t='.$topic_id.'"><img src="{{tpl:BlogThemeURL}}/img/commentaires.png"> '.$num_comm.'</a>';
}

mysql_close();
?>
