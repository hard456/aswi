<?php
session_start();

function authorization() {
  global $_SESSION;
  global $ses_date_last_visit;
  
  $ses_nick            = $_SESSION["ses_nick"];
  $ses_name            = $_SESSION["ses_name"];
  $ses_surname         = $_SESSION["ses_surname"];
  $ses_privileges      = $_SESSION["ses_privileges"];
  //$ses_date_last_visit = $_SESSION["ses_date_last_visit"];
  $ses_IDuser          = $_SESSION["ses_IDuser"];
  
  if(Empty($ses_nick))            return false;
  if(Empty($ses_surname))         return false;
  if(Empty($ses_privileges))      return false;
  if(Empty($ses_date_last_visit)) return false;
  if(Empty($ses_IDuser))          return false;
  
  $ted = time();
  $max_odezva = 60 * 60 * 100;
  
  if ($ses_date_last_visit+$max_odezva < $ted) return false;
  
  $ses_date_last_visit = $ted;
  return true;
}


if (!authorization()) {
  Header("Location: index_to_admin.php?hlaska=Byl jste automaticky odhlášen&n=$ses_nick");
}

require_once("./functions/dictionary.php");


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


<div id="left">
   <h2 class="nadpis">Administrace</h2>
   
   <div class="nadpis_sekce">
     <i>Přihlášen:</i><br /> 
     <?php echo "".$ses_name." ".$ses_surname."\n"?>
     <br />
     <?php if($ses_privileges == 3) echo "Administrátor";
           else echo "Uživatel (smí i zapisovat)";?>
     <br />
     <a href="index_to_admin.php?akce=odhlasit">Odhlásit</a>
     <?php if($ses_privileges == 3)
          echo" | <a href=\"examination.php?ses_id=$PHPSESSID\">Do slovníku</a>";
     ?>
   </div>
   <?php 
   if ($ses_privileges == 3):
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
         if ($ses_privileges == 3):
        ?>
       <li><a href="?nav_id=list_word" class="active">Výpis ze studijního slovníku</a></li>
       <li><a href="?nav_id=list_nonauthorized_word" class="active">Neautorizovaná slova</a></li>
       <li><a href="?nav_id=list_duplicity" class="active">Duplicity</a></li>
       
       <?php elseif($ses_privileges == 2):?>
       <li><a href="?nav_id=list_nonauthorized_word&contrains_user_id=<?php echo $ses_IDuser?>" class="active">Neautorizovaná slova</a></li>
       <?php endif;?>
     </ul>
   <?php 
   //if ($ses_privileges == 3):
   ?>
   <div class="nadpis_sekce"><strong>Články</strong></div>
	   <ul>
       <li><a href="?nav_id=add_article" class="active">Vložit nový článek</a></li>
       <li><a href="?nav_id=list_article" class="active">Vypiš články</a></li>
     </ul>
   <?php 
   if ($ses_privileges == 3):
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
   <?php 
   
   endif;
   ?>
   <div class="nadpis_sekce"><strong>&nbsp;</strong></div>
   <?php copyright(); ?>
</div>
 
<div id="content">
 <div class="content_home">
 
   <?php $cesta = "./administration/";

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
    case("list_article") :
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
    default:
  }

?></div>
</div>
</body>
</html>
