<?php

require_once("./functions/dictionary.php");
//register_globals();

if (!kontrola_pristupu(2)) {
  //echo "odhlas";
  Header("Location: index_to_admin.php?hlaska=Byl jste automaticky odhlášen&n=$ses_nick");
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Administrace slovníku katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="./css/kbs.css">
<script src="functions/popup.js" type="text/javascript"></script>
</head>
<body>

<?php ?>

<div id="left">
   <h2 class="nadpis">Administrace</h2>

   <div class="nadpis_sekce">
     <i>Přihlášen:</i><br />
     <?php echo "".$ses_name." ".$ses_surname."\n"?>
     <br />
     <?php if(kontrola_pristupu(3)) echo "Administrátor";
           else echo "Uživatel (smí i zapisovat)";?>
     <br />
     <ul>
     	<li><a href="./<?php echo $_SESSION['ses_pref_dist'] ?>"><?php echo lang("Slovník") ?></a></li>

     <?php if(kontrola_pristupu(2))
          echo"	<li> <a href=\"examination.php\">Zkoušení</a></li>";
     ?>
    <li><a href="./<?php echo $_SESSION['ses_pref_dist'] ?>?akce=odhlasit"><?php echo lang("Odhlásit") ?></a></li>
     </ul>
   </div>
   <?php
   if (kontrola_pristupu(3)):
   ?>
   <div class="nadpis_sekce"><strong>Uživatelé</strong></div>
	   <ul>
       <li><a href="?nav_id=add_user" class="active">Přidat uživatele</a></li>
       <li><a href="?nav_id=list_user" class="active">Vypiš uživatele</a></li>
     </ul>
   <?php
   endif;
   ?>
   <div class="nadpis_sekce"><strong>Slova</strong></div>
     <ul>
       <li><a href="?nav_id=add_word" class="active">Vložit nové slovo do studijního slovníku</a></li>
       <?php
         if (kontrola_pristupu(3)):
        ?>
       <li><a href="?nav_id=list_word" class="active">Výpis ze studijního slovníku</a></li>
       <li><a href="?nav_id=list_nonauthorized_word" class="active">Neautorizovaná slova</a></li>
       <li><a href="?nav_id=list_duplicity" class="active">Duplicity</a></li>

       <?php elseif(kontrola_pristupu(2)):?>
       <!--li><a href="?nav_id=list_nonauthorized_word&contrains_user_id=<?php echo $ses_IDuser?>" class="active">Neautorizovaná slova</a></li-->
       <li><a href="?nav_id=list_nonauthorized_word" class="active">Neautorizovaná slova</a></li>
       <?php endif;?>
     </ul>
    
   <div class="nadpis_sekce"><strong>Testy</strong></div>
	   <ul>
   <?php if(kontrola_pristupu(2)):?>
       <li><a href="?nav_id=add_test" class="active">Vložit test</a></li>
       <li><a href="?nav_id=list_test" class="active">Vypiš testy</a></li>
       <li><a href="?nav_id=list_nonauthorized_test" class="active">Vypiš neutorizované testy</a></li>
   <?php endif;?>
       </ul>
   <?php
   //if (kontrola_pristupu(3)):
   ?>
   <div class="nadpis_sekce"><strong>Články</strong></div>
	   <ul>
       <li><a href="?nav_id=add_article" class="active">Vložit nový článek</a></li>
       <li><a href="?nav_id=list_article" class="active">Vypiš články</a></li>
       <li><a href="?nav_id=list_nonauthorized_article" class="active">Vypiš neautorizované články</a></li>
     </ul>
   <?php
   
    if (kontrola_pristupu(3)):
   ?>
   <div class="nadpis_sekce"><strong>Kategorie testů</strong></div>
	   <ul>
       <li><a href="?nav_id=add_test_category" class="active">Vložit novou kategorii testu</a></li>
       <li><a href="?nav_id=list_test_category" class="active">Vypiš kategorii testu</a></li>
     </ul>
   <?php  
   ?>
   <div class="nadpis_sekce"><strong>Obory</strong></div>
	   <ul>
       <li><a href="?nav_id=add_field" class="active">Vložit nový obor</a></li>
       <li><a href="?nav_id=list_field" class="active">Vypiš obory</a></li>
     </ul>
   <?php

   ?>
   <div class="nadpis_sekce"><strong>Autoři</strong></div>
	   <ul>
       <li><a href="?nav_id=add_author" class="active">Vložit nového autora</a></li>
       <li><a href="?nav_id=list_author" class="active">Vypiš autory</a></li>
     </ul>
   <?php

   ?>
   <div class="nadpis_sekce"><strong>Zdroje</strong></div>
	   <ul>
       <li><a href="?nav_id=add_source" class="active">Vložit nový zdroj</a></li>
       <li><a href="?nav_id=list_source" class="active">Vypiš zdroje</a></li>
     </ul>
   <?php

   ?>
   <div class="nadpis_sekce"><strong>Nenalezená slova</strong></div>
	   <ul>
       <li><a href="?nav_id=list_not_found_cz" class="active">Čeština</a></li>
       <li><a href="?nav_id=list_not_found_en" class="active">Angličtina</a></li>
       <li><a href="?nav_id=list_not_found_ar" class="active">Arabština</a></li>
       <!--li><a href="?nav_id=list_source" class="active">Vypiš zdroje</a></li-->
     </ul>
   <?php

   ?>
   <div class="nadpis_sekce"><strong>Překlady prostředí</strong></div>
	   <ul>
	     <li><a href="?nav_id=add_translation_lang" class="active">Vlož jazyk prostředí</a></li>
       <li><a href="?nav_id=list_translation_lang" class="active">Vypiš jazyky</a></li>
       <li><a href="?nav_id=list_translation" class="active">Uprav překlad</a></li>
     </ul>
    
    <div class="nadpis_sekce"><strong>Motivační zprávy</strong></div>
	   <ul>
		    <li><a href="?nav_id=list_report" class="active">Vypiš zprávy</a></li>
	     </ul>
   <?php

   endif;
   ?>
   <div class="nadpis_sekce"><strong>&nbsp;</strong></div>
   <?php copyright(); ?>
</div>

<div id="content">
 <div class="content_home">

   <?php $cesta = "./administration/";
   
  // pr($_);
   
  switch($nav_id) {
    case("add_user") :
      require_once($cesta."add_user.php");
    break;
    case("list_user") :
      require_once($cesta."list_user.php");
    break;
    case("edit_user") :
      require_once($cesta."edit_user.php");
    break;
    case("add_word") :
      require_once($cesta."add_word.php");
    break;
    case("list_word") :
      require_once($cesta."list_word.php");
    break;
    case("edit_word") :
      require_once($cesta."edit_word.php");
    break;
    case("view_word") :
      require_once($cesta."view_word.php");
    break;
    case("authorize_word") :
      require_once($cesta."list_word.php");
    break;
    case("list_nonauthorized_word") :
      require_once($cesta."list_word.php");
    break;
    case("list_duplicity") :
      require_once($cesta."list_duplicity.php");
    break;
   /*case("sort_word") :
      require_once($cesta."list_word.php");
    break;*/
    case("add_article") :
      require_once($cesta."add_article.php");
    break;
    case("autorize_article") :
      require_once($cesta."list_article.php");
    break;
    case("list_article") :
      require_once($cesta."list_article.php");
    break;
    case("list_nonauthorized_article") :
      require_once($cesta."list_article.php");
    break;
    case("edit_article") :
      require_once($cesta."edit_article.php");
    break;
    case("add_article_voice") :
      require_once($cesta."add_article_voice.php");
    break;
    case("add_field") :
      require_once($cesta."add_field.php");
    break;
    case("list_field") :
      require_once($cesta."list_field.php");
    break;
    case("edit_field") :
      require_once($cesta."edit_field.php");
    break;
    case("add_test_category") :
      require_once($cesta."add_test_category.php");
    break;
    case("list_test_category") :
      require_once($cesta."list_test_category.php");
    break;
    case("edit_test_category") :
      require_once($cesta."edit_test_category.php");
    break;
    case("add_author") :
      require_once($cesta."add_author.php");
    break;
    case("list_author") :
      require_once($cesta."list_author.php");
    break;
    case("edit_author") :
      require_once($cesta."edit_author.php");
    break;
    case("add_source") :
      require_once($cesta."add_source.php");
    break;
    case("list_source") :
      require_once($cesta."list_source.php");
    break;
    case("edit_source") :
      require_once($cesta."edit_source.php");
    break;
    case("delete_author_of_source") :
      require_once($cesta."delete_author_of_source.php");
    break;
    case("add_author_of_source") :
      require_once($cesta."add_author_of_source.php");
    break;
    case("add_context") :
      require_once($cesta."add_context.php");
    break;
    case("link_context") :
      require_once($cesta."link_context.php");
    break;
    case("delete_context") :
      require_once($cesta."list_word.php");
    break;
    case("edit_context") :
      require_once($cesta."edit_context.php");
    break;
    case("add_word_voice"):
      require_once($cesta."add_word_voice.php");
    break;
    case("list_not_found_cz"):
      require_once($cesta."list_not_found_cz.php");
    break;
    case("list_not_found_en"):
      require_once($cesta."list_not_found_en.php");
    break;
    case("list_not_found_ar"):
      require_once($cesta."list_not_found_ar.php");
    break;
    case("list_translation_lang"):
      require_once($cesta."list_translation_lang.php");
    break;
    case("add_translation_lang"):
      require_once($cesta."add_translation_lang.php");
    break;
    case("edit_translation_lang"):
      require_once($cesta."edit_translation_lang.php");
    break;
    case("list_translation"):
      require_once($cesta."list_translation.php");
    break;
    case("edit_translation"):
      require_once($cesta."edit_translation.php");
    break;
    case("list_report"):
      require_once($cesta."list_report.php");
    break;
    case("edit_report"):
      require_once($cesta."edit_report.php");
    break;
    case("list_test"):
      require_once($cesta."list_test.php");
    break;
    case("list_nonauthorized_test"):
      require_once($cesta."list_test.php");
    break;
    case("authorize_test") :
      require_once($cesta."list_test.php");
    break;
    case("edit_test"):
      require_once($cesta."edit_test.php");
    break;
    case("detail_test"):
      require_once($cesta."detail_test.php");
    break;
    case("add_test"):
      require_once($cesta."add_test.php");
    break;
    case("desk") :
      require_once($cesta."desk.php");
    break;
    default:
  }

?></div>
</div>
<?php //pr($_SESSION); ?>
</body>
</html>
