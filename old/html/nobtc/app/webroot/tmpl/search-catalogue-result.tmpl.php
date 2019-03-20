<h1>Search in catalog - Results</h1>

<?php echo $Sorter_line;?>

<?php if (Count($Transliterations) > 0): ?>
    <?php
    //p_g($Transliterations);
      for($t = 0; $t < count($Transliterations); $t++):
        $transliteration = $Transliterations[$t];
        $found_cat = $Found_catc[$t];
        $POST = $transliteration->getResult();
        $rev_history = $transliteration->getRevHistory();
        $photos = $transliteration->getPhotos();
        $handcopies = $transliteration->getHandcopies();
        $id_transliteration = $transliteration->id_transliteration;
        //p_g($id_transliteration);
        //p_g($found_cat);
        //p_g($POST);
        $Reference = new OldReference($id_transliteration);
        $references = $Reference->getResult();
        ?>
        <?php require('./tmpl/catalogue.tmpl.php');?>
        <?php require('./tmpl/transliteration.tmpl.php');?>
        <?php require('./tmpl/rev_history.tmpl.php');?>
    <?php  endfor;   ?>
<?php else:?>
    Not found
<?php endif;?>
