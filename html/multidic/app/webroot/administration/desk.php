<?php
require_once("./administration/word.php");

$word = get_word($word_id);



switch ($word['word_category_foreign']) {

    case('שם עצם'):
        ?>
        
        <div class="card">
        
            <p class="arabic"> <?php echo $word['vocalized'] ?> ש"ע <?php echo $word['gender']?> <?php echo $word['nonvocalized'] ?> </p>


     4               	
ר. סְפָרִים
									  		    5
ס. י. סֵפֶר
											     6
ס. ר. סִפְרֵי
											   7
 ר - פ - ס  .ש

        
        
        </div>
        
        
        
        
        <?
    break;

}


echo '<pre>';
print_r($word);
echo '</pre>';

