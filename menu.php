<header>
    <nav> 
    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <?php
            session_start();
            if ($_SESSION['loggedIn']):
        ?>
                <li class="admin"><a href="admin.php"><img src="admin.svg" alt="Panel administratora - CMS"><span>Panel administratora</span></a></li>
                <li class="logout"><a href="logout.php"><img src="logout.svg" alt="Wyloguj - CMS"><span>Wyloguj się</span></a></li>
        <?php else: ?>
                <li class="login"><a href="#"><img src="admin.svg" alt="Panel administratora - CMS"><span>Zaloguj się</span></a></li>
        <?php endif; ?>
    </ul>
    </nav>
</header>
<div class="bgr">

</div>
<?php if (!$_SESSION['loggedIn']): ?>
  <div class="login-page">
    <div class="form">
    <span class="close">x</span>
      <form class="login-form" action=""" method="post">
        <input type="text" name="login" placeholder="nazwa użytkownika"/>
        <input type="password" name="password" placeholder="hasło"/>
        <input type="submit" class="button" value="Zaloguj się" />
      </form>
      <span class="validation"></span>
    </div>
  </div>
<?php endif; ?>