<?php

$SearchCatalog = new SearchCatalog();
$SearchCatalog->addConstrain("transliteration", "id_transliteration", "is", $_REQUEST["id_transliteration"]);

$SearchCatalog->search();
$result = $SearchCatalog->getResult();
$Transliteration = new OldTransliteration($result['id_transliteration']);

