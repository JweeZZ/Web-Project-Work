<?php
require_once("connect.php");

if(isset($_GET['id'])){
    $sorgu1 = $baglanti->prepare("select * from profiles where id=?");
    $sorgu1->execute([$_GET['id']]);
    $forPopUp = $sorgu1->fetch(PDO::FETCH_ASSOC);
}

$count = $baglanti->prepare("select count(*) from profiles");
$count->execute();
$total = $count->fetchAll(PDO::FETCH_ASSOC);

$sorgu = $baglanti->prepare("select * from profiles where status = 0 ORDER BY RAND() Limit 1");
$sorgu->execute();
$profiles = $sorgu->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Like Dislike Uygulaması</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div id="pop-up">
        <?php
        if ($_GET['status'] == 'like') {
        ?>
            <div class="pop-up--card">
                <i class="fa-solid fa-check"></i>
                <div class="status">
                    <p><?= $forPopUp['name'] . ' ' . $forPopUp['surname'] ?> ismini beğendiniz.</p>
                </div>
            </div>
        <?php
        } elseif ($_GET['status'] == 'dislike') {
        ?>
            <div class="pop-up--card">
                <i class="fa-solid fa-xmark"></i>
                <div class="status">
                    <p><?= $forPopUp['name'] . ' ' . $forPopUp['surname'] ?> ismini beğenmediniz.</p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <nav>
        <div class="container">
            <div class="profile">
                <a href="table.php"><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
    </nav>
    <?php
    if ($profiles) {
        if ($profiles['status'] == 0) {
            $id = $profiles['id'];
    ?>
            <main>
                <div class="content">
                    <div class="container">
                        <div class="card-content">
                            <p class="name"><?= $profiles['name'] ?></p>
                            <p class="surname"><?= $profiles['surname'] ?></p>
                        </div>
                    </div>
                    <div class="like-dislike">
                        <a href="like.php?id=<?= $id ?>" class="like"><i class="fa-regular fa-thumbs-up"></i></a>
                        <a href="dislike.php?id=<?= $id ?>" class="dislike"><i class="fa-regular fa-thumbs-down"></i></a>
                    </div>
                </div>
            </main>
        <?php
        }
    } else { ?>
        <div class="ebitti">görülecek kullanıcı kalmadı.</div>
    <?php
    }
    ?>
    <script>
        window.onload = function() {
            setTimeout(function() {
                var popUp = document.getElementById('pop-up');
                if (popUp) {
                    popUp.style.display = 'none';
                }
            }, 3000);
        }
    </script>
</body>

</html>