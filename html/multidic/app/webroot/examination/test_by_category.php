<?php require_once("./examination/test.php");?>
<?php require_once("./administration/test_category.php");?>

<?php if(empty($test_category)) die("Nebyla zadána kategorie.") ?>

<?php $tests = get_tests_by_category($test_category)?>
<?php $kategorie = get_test_category($test_category)?>
<?php if (count($tests) == 0):?>
<h3 class="nadpis2">Bohužel, v této kategorii nejsou žádné testy.</h3> 
<?php else: ?>

<h3 class="nadpis2"><?php printf(lang("Seznam dostupných testů pro kategorii '%s'"), $kategorie['name']) ?></h3> 
       
       <?php // var_dump($tests) ?>

        <ul>
            <?php foreach($tests as $test): ?>
            <li> <a href="examination.php?nav_id=do_test&test=<?php echo $test[0]?>"> <?php echo $test['title']?></a> </li>
            <?php endforeach; ?>
        </ul>

<?endif; ?> 
