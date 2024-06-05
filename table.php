<?php
require_once("connect.php");
$sorgu = $baglanti->prepare("select * from profiles");
$sorgu->execute();

$sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div id="pop-up">
        <?php
        if ($_GET['status'] == 'success') {
            $cancelPopUp = $sonuc[$_GET['id']];
        ?>
            <div class="pop-up--card">
                <i class="fa-solid fa-check"></i>
                <div class="status">
                    <p><?= $cancelPopUp['name'] . ' ' . $cancelPopUp['surname'] ?> ismini profilinizden kaldırdınız.</p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <a class="indexphp" href="index.php"><i class="fa-solid fa-house"></i></a>
    <table class="table">
        <thead>
            <th>name</th>
            <th>surname</th>
            <th>status</th>
        </thead>
        <tbody>
            <?php foreach ($sonuc as $profile) {
                if ($profile['status'] != 0) {
            ?>
                    <tr>
                        <td><?= $profile['name'] ?></td>
                        <td><?= $profile['surname'] ?></td>
                        <td><?php
                            if ($profile['status'] == 1) {
                            ?>
                                <a href="cancel.php?id=<?= $profile['id'] ?>" class="liked"><i class="fa-solid fa-thumbs-up"></i></i></a>
                            <?php
                            } elseif ($profile['status'] == 2) {
                            ?>
                                <a href="cancel.php?id=<?= $profile['id'] ?>" class="disliked"><i class="fa-solid fa-thumbs-down"></i></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
            <?php

                }
            }
            ?>
        </tbody>
    </table>
    <script>
        window.onload = function() {
            setTimeout(function() {
                var popUp = document.getElementById('pop-up');
                if (popUp) {
                    popUp.style.display = 'none';
                }
            }, 2500);
        }
    </script>
</body>

</html>