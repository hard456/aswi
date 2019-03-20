<h1>Transliteration info</h1>

<?php if ($transliteration_count > 0): ?>
<?php require('./tmpl/catalogue.tmpl.php');?>
<?php require('./tmpl/transliteration.tmpl.php');?>
<?php require('./tmpl/rev_history.tmpl.php');?>
<?php else:?>
    Not found
<?php endif;?>
