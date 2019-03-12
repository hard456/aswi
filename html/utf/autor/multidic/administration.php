<?
session_start();

function authorization() {
  global $ses_nick;
  global $ses_name;
  global $ses_surname;
  global $ses_privileges;
  global $ses_date_last_visit;
  global $ses_IDuser;
  
  if(Empty($ses_nick))            return false;
  if(Empty($ses_surname))         return false;
  if(Empty($ses_privileges))      return false;
  if(Empty($ses_date_last_visit)) return false;
  if(Empty($ses_IDuser))          return false;
  
  $ted = time();
  $max_odezva = 6000;
  
  if ($ses_date_last_visit+$max_odezva < $ted) return false;
  
  $ses_date_last_visit = $ted;
  return true;
}


if (!authorization()) Header("Location: index_to_admin.php?hlaska=Byl jste automaticky odhlášen&n=$ses_nick");


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Administrace slovníku katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="./css/kbs.css"> 
</head>
<body>


<div id="left">
   <h2 class="nadpis">Administrace</h2>
   
   <div class="nadpis_sekce">
     <i>Přihlášen:</i><br /> 
     <?echo "".$ses_name." ".$ses_surname."\n"?>
     <br />
     <?php if($ses_privileges == 3) echo "Administrátor";
           else echo "Uživatel (smí i zapisovat)";?>
     <br />
     <a href="index_to_admin.php?akce=odhlasit">Odhlásit</a>
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
       <? elseif($ses_privileges == 2):?>
       <li><a href="?nav_id=list_nonauthorized_word&contrains_user_id=<?echo $ses_IDuser?>" class="active">Neautorizovaná slova</a></li>
       <?endif;?>
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
   endif;
   ?>
   <div class="nadpis_sekce"><strong>&nbsp;</strong></div>
</div>
 
<div id="content">
 <div class="content_home">
   <? $cesta = "./administration/";

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
      require_once($cesta."list_nonauthorized_word.php");
    break;
    case("list_nonauthorized_word") :
      require_once($cesta."list_nonauthorized_word.php");
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
    default:
  }

?></div>
</div>
</body>
</html>
