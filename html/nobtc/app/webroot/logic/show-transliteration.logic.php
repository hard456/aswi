<?php

$SearchCatalog = new SearchCatalog();
$SearchCatalog->addConstrain("transliteration", "id_transliteration", "is", $_REQUEST["id_transliteration"]);

$SearchCatalog->search();
$SearchCatalog->next_record();
$result = $SearchCatalog->getResult();
$Transliteration = new OldTransliteration($result['id_transliteration']);

$Reference = new OldReference($result['id_transliteration']);

//$revHistory = new RevHistory($result['id_transliteration']);


