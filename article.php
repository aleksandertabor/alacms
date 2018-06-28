<?php
    session_start();
    require('header.php');
    include 'functions.php';
    require('connect.php');
?>
<body>
<?php
    include 'menu.php';
?>
<div class="container">
<?php
if ( isset($_GET["id"]) ) {
    $id = (int)$_GET["id"];
    $articleRequest = $pdo->prepare('SELECT * FROM articles WHERE id = :id');
    $articleRequest->execute(['id' => $id]);
    $article = $articleRequest->fetch();
    if ($article) {
        echo '<article>';
        echo '<h1>'.$article['title'].'</h1>';
        echo' <p>'.$article['content'].'</p>';
        echo '<span class="headline hl4">Data dodania: '.$article['date']. '</span>';
        echo '</article>';
        write_log ( "Wejście do artykułu: ". $article['title'] );
    }
}
?>
</div>
<?php require('footer.php'); ?>
</body>
</html>