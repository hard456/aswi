
<?php
echo '<div class="slouptitle">&nbsp;Select table</div>';
echo $table_chooser;

?>

<br />
<div class="slouptitle">&nbsp;Select action</div>

<?php

if (!Empty($table)) {
  echo "<ul><li><a href=\"admin.php?table=$table&amp;nav_id=insert\">Add item</a></li></ul>";
}
?>
<br />
