<?php
require_once("./examination/test.php");
$test_id = $_GET['test'];
$test = get_test($test_id);
//pr($test);
?>
<?php if (!empty($_POST)) :?>
<div class="card" style="width: 90%;">
    <h1>Test <?php echo $test['title']?></h1>
    <p>
       Vyhodnocení Vašeho testu:
    </p>
    <form action="" method="post">
        <p class="arabic">
        <?php echo nl2br(check_test($test['body'], $_POST['test']))?>
        </p>
    </form>
</div>

<?php else:?>
<div class="card" style="width: 90%;">
    <h1>Test <?php echo $test['title']?></h1>
    <p>
        <?php echo $test['note']?>
    </p>
    <form action="" method="post">
        <p class="arabic">
        <?php echo nl2br(test_form($test['body']))?>
        </p>
        <input type="submit" name="kontrola" value="Zkotroluj výsledky" />
    </form>
</div>
<?php endif;?>


