<?php
require_once("connect.php");

$gelenId = $_GET["id"];

$sorgu = $baglanti->prepare('update profiles set status = 0 where id = ?');
$sorgu->execute([$gelenId]);

header("Location: table.php?status=success&id=$gelenId");