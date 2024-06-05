<?php
require_once("connect.php");

$gelenId = $_GET["id"];

$sorgu = $baglanti->prepare('update profiles set status = 2 where id = ?');
$sorgu->execute([$gelenId]);

header("Location: index.php?status=dislike&id=$gelenId");
