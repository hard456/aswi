<?php
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
  $max_odezva = 600;
  
  if ($ses_date_last_visit+$max_odezva < $ted) return false;
  
  $ses_date_last_visit = $ted;
  return true;
}


if (!authorization()) Header("Location: index_to_exam.php?hlaska=Už došlo k odhlášení&n=$ses_nick");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Slovník katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="./css/kbs.css"> 
</head>
<body>


<div id="left">
   <h2 class="nadpis">Osobní zóna</h2>
   
   <div class="nadpis_sekce">
     <i>Přihlášen:</i><br /> 
     <?echo "".$ses_name." ".$ses_surname."\n" ?>
     <br />
     <br />
     <a href="index_to_exam.php?akce=odhlasit">Odhlásit</a>
   </div>
   <?php 

   ?>
   <div class="nadpis_sekce"><strong>Zkoušení</strong></div>
	   <ul>
       <li><a href="?nav_id=new_exam" class="active">Nové zkoušení</a></li>
       <li><a href="?nav_id=list_exam" class="active">Výpis zkoušení</a></li>
     </ul>
   <div class="nadpis_sekce"><strong>&nbsp;</strong></div>
</div>
 
<div id="content">
 <div class="content_home">
   <? $cesta = "./examination/";

  switch($nav_id) {
    case("new_exam") :
      require_once($cesta."new_exam.php");
    break;
    case("list_exam") :
      require_once($cesta."list_exam.php");
    break;
   case("do_exam") :
      require_once($cesta."do_exam.php");
    break;
 
    default:
  }

?></div>
</div>
</body>
</html>
