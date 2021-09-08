<?php
include('db.php');

$CID = rand(100, 1000);
require_once('xkcd.php');
$xkcd = new xkcd();
$comic = $xkcd->get($CID); 

 $email_template="
    '<h1>'.$comic->safe_title.' </h1>'<br> <br>
    <img src={$comic->img} title={$comic->alt}/><br><br><br>
    '<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>'<br><br><br>
   <h2>Full version</h2><a href=\{$comic->url}\>{$comic->url}</a>;<br><br><br><br><br><br>
   <a href='http://q-bot.in/unsubscribe.php?token=$clicked_token'>Click here to unsubscribe</a>"
?>