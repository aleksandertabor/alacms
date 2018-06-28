<footer>

<?php if(!isset($_COOKIE['modal'])): ?>
<div class="bgr bgr-modal">

</div>
<div class="modal">
  <div class="form">
  <span class="close">x</span>
    <p>Zobacz stronę jednego z autorów!</p>
    <iframe src="http://aleksandertabor.pl/" frameborder="0"></iframe>
  </div>
</div>
<?php endif; ?>

<p>💻 CMS by Aleksander Tabor<?php echo date("Y"); ?> &copy;</p>

<script src="main.js"></script>

</footer>