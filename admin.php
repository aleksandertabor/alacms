<?php
session_start();
if ($_SESSION['loggedIn']) {
  require('functions.php');
  require('connect.php');
  write_log ( "Wejście do panelu administratora" );
} else {
    header("Location: index.php");
} ?>

<?php if ($_SESSION['loggedIn']): ?>
<?php
	require('header.php');
?>
<body>
<?php
	include 'menu.php';
?>
<div class="container">
<?php endif; ?>
<?php
if ( isset($_POST["title"]) ) {
    if ( isset($_POST["content"]) ) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $sql = "INSERT INTO articles (title, content) VALUES (:title,:content)";
        $pdo->prepare($sql)->execute([$title, $content]);
    }
}


if ( isset($_POST["title"]) ) {
    if ( isset($_POST["edit-content"]) ) {
		$id = $_POST['id'];
        $title = $_POST["title"];
        $content = $_POST["edit-content"];
        $sql = "UPDATE articles SET title = :title , content = :content WHERE ID = :id ";
        $pdo->prepare($sql)->execute([$title, $content, $id]);
    }
}

if ( isset($_GET["deleteArticle"]) ) {
		$article = $_GET["deleteArticle"];
		$delete = $pdo->prepare("DELETE FROM articles WHERE id = ?");
		$delete->execute([$article]);
}
?>
<div class="tabs">

	<ul class="tab-list">
		<li class="active"><a class="tab-control" href="#tab-1"><h3>Edycja artykułów</h3></a></li>
		<li class=""><a class="tab-control" href="#tab-2"><h3>Dodawanie artykułów</h3></a></li>
		<li class=""><a class="tab-control" href="#tab-3"><h3>Podgląd logów</h3></a></li>
	</ul>

	<div class="tab-panel active" id="tab-1">
		<form action="admin.php" method="GET">
			<?php
			$articles = $pdo->query('SELECT * FROM articles');
			echo '<select name="editArticle">';
			while ($row = $articles->fetch())
			{
				echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
			}
			echo '</select>';
			?>
			<input type="submit" class="button" value="Wybierz artykuł">
		</form>
		<?php 
			if ( isset($_GET["editArticle"]) ):
			{
				$id = $_GET["editArticle"];
				$edit_article = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
				$edit_article->execute([$id]);
				$article = $edit_article->fetch();
			}
			?>
			<form action="admin.php" method="post">
				<input type="hidden" name="id" value="<?php echo $article['id']; ?>">
				<input type="text" name="title" value="<?php echo $article['title']; ?>">
				<textarea name="edit-content" class="tinymce" value="<?php echo $article['content']; ?>"><?php echo $article['content']; ?></textarea>
				<input type="submit" class="button" value="Zapisz artykuł">
			</form>

		<?php endif; ?>
		<form action="admin.php" method="GET">
		<?php
			$articles = $pdo->query('SELECT * FROM articles');
			echo '<select name="deleteArticle">';
			while ($row = $articles->fetch())
			{
				echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
			}
			echo '</select>';
			?>
			<input type="submit" class="button" value="Usuń artykuł">
		</form>
	</div>

	<div class="tab-panel" id="tab-2">
		<form action="admin.php" method="post">
			<input type="text" name="title" placeholder="Podaj tytuł artykułu">
			<textarea name="content" class="tinymce"></textarea>
			<input type="submit" class="button" value="Dodaj artykuł">
		</form>
	</div>

	<div class="tab-panel" id="tab-3">
		<?php read_logs(); ?>
	</div>

</div>
</div>
<script>
// TinyMCE init
    tinymce.init({
	selector: "textarea.tinymce",
	
	theme: "modern",
	skin: "lightgray",
	
	width: "100%",
	height: 300,
	
	statubar: true,
	
	plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor"
	],

	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
	
	style_formats: [
		{title: "Headers", items: [
			{title: "Header 1", format: "h1"},
			{title: "Header 2", format: "h2"},
			{title: "Header 3", format: "h3"},
			{title: "Header 4", format: "h4"},
			{title: "Header 5", format: "h5"},
			{title: "Header 6", format: "h6"}
		]},
		{title: "Inline", items: [
			{title: "Bold", icon: "bold", format: "bold"},
			{title: "Italic", icon: "italic", format: "italic"},
			{title: "Underline", icon: "underline", format: "underline"},
			{title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
			{title: "Superscript", icon: "superscript", format: "superscript"},
			{title: "Subscript", icon: "subscript", format: "subscript"},
			{title: "Code", icon: "code", format: "code"}
		]},
		{title: "Blocks", items: [
			{title: "Paragraph", format: "p"},
			{title: "Blockquote", format: "blockquote"},
			{title: "Div", format: "div"},
			{title: "Pre", format: "pre"}
		]},
		{title: "Alignment", items: [
			{title: "Left", icon: "alignleft", format: "alignleft"},
			{title: "Center", icon: "aligncenter", format: "aligncenter"},
			{title: "Right", icon: "alignright", format: "alignright"},
			{title: "Justify", icon: "alignjustify", format: "alignjustify"}
		]}
	]
});
</script>
<?php require('footer.php'); ?>
</body>
</html>