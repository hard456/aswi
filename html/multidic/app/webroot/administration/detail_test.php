<?php 
//require_once("./administration/test.php");
require_once("./examination/test.php");

$test_id = $_GET['test_id'];
$test = get_test($test_id);
//pr($test);


?>

<div class="">
<h1>Test <?php echo $test['title']?></h1>
    <p>
        <?php echo $test['note']?>
    </p>

    <p class="arabic">
        <?php echo nl2br(test_form($test['body']))?>
    </p>
</div>
