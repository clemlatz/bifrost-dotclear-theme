<?php
$dbhost = "10.0.205.6";
$dbuser = "belial";
$dbpass = "jFuSNZ37";
$dbbase = "belial";

//die("plop");

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
    if($num_comm == 0) $commentaires = '<a href="http://forums.belial.fr/posting.php?mode=reply&f=10&t='.$topic_id.'">Aucun commentaire</a>';
    elseif($num_comm == 1) $commentaires = 'Un commentaire';
    else $commentaires = $num_comm.' commentaires';
    if($num_comm != 0)
    {
        $text = mysql_result($sql_comm,0,'post_text');
        $text = utf8_encode($text);
        $text = substr($text,0,120);
    }
    echo '<div id="commentaires">';
    if(!empty($text)) echo '<p> &#171; <em>'.$text.'...</em> &#187;<br />';
    echo '
            <img src="http://blogs.nokto.pro/dotclear/themes/bifrost/img/commentaires.png"> <a href="http://forums.belial.fr/viewtopic.php?t='.$topic_id.'">'.$commentaires.'</a></p>
        </div>
    ';
}
else
{
    echo '
            <div id="commentaires">
                <p>Commentaires : pas de fil pour '.$_SERVER['REQUEST_URI'].'</p>
            </div>
        ';
}

mysql_close();
?>