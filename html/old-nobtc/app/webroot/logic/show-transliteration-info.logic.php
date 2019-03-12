<?php

$SearchTransliterationInfo = new SearchTransliterationInfo();

$SearchTransliterationInfo->addConstrain("transliteration", "id_transliteration", "is", $_REQUEST['id_transliteration']);

$SearchTransliterationInfo->search();
$result = $SearchTransliterationInfo->getResult();
?>
