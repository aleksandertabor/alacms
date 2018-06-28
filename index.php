<?php
  require('header.php');
  require('connect.php');
  require('functions.php');
  session_start();
  write_log ( "Wejście na stronę" );
?>
<body>
<?php
  include 'menu.php';
?>
<div class="container">
  <section id="news">
  <?php 
$articles = $pdo->query('SELECT * FROM articles ORDER BY date DESC');
  while ($row = $articles->fetch())
  {
      echo '<article>';
      echo '<a href="article.php?id='.$row['id'].'"><h2>'.$row['title'].'</h2></a>';
      echo '<div class="news-content">'.substr(strip_tags($row['content']), 0, 50).'...'.'</div>';
      echo '<span class="created-date">Data dodania: '.$row['date'].'</span>';
      echo '<a href="article.php?id='.$row['id'].'" class="button read-more">Czytaj dalej</a>';
      echo '</article>';
  }
  ?>
  </section>
  <div class="bouncing-loader">
          <div></div>
          <div></div>
          <div></div>
  </div>
</div>
<?php require('footer.php'); ?>
</body>
</html>