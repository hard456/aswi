<?php
session_start();
require_once("./functions/dictionary.php");

//pr($_SESSION);flush(1);

if (!kontrola_pristupu(1)) {
  //echo "odhlas";
  Header("Location: ./?hlaska=".lang('Došlo k odhlášení')."&n=".$_SESSION["ses_nick"]);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title><?php echo lang("Slovník katedry blízkovýchoních studií") ?></title>
<link rel="stylesheet" type="text/css" href="./css/kbs.css">
</head>
<body>


<div id="left">
   <h2 class="nadpis"><?php echo lang("Osobní zóna") ?></h2>

   <div class="nadpis_sekce">
     <i><?php echo lang("Přihlášen:") ?></i><br />
     <?php echo "".$_SESSION['ses_name']." ".$_SESSION['ses_surname']."\n" ?>
     <br />
     <br />
     <ul>
     	<li><a href="./<?php echo $_SESSION['ses_pref_dist'] ?>"><?php echo lang("Slovník") ?></a></li>

     <?php if(kontrola_pristupu(2))
          echo "<li> <a href=\"administration.php\">".lang("Administrace")."</a></li>";
     ?>
     <li><a href="./<?php echo $_SESSION['ses_pref_dist'] ?>?akce=odhlasit"><?php echo lang("Odhlásit") ?></a></li>
	</ul>
   </div>

   <div class="nadpis_sekce"><strong><?php echo lang("Zkoušení") ?></strong></div>
	   <ul>
       <li><a href="?nav_id=new_exam" class="active"><?php echo lang("Nové zkoušení") ?></a></li>
       <li><a href="?nav_id=list_exam" class="active"><?php echo lang("Výpis zkoušení") ?></a></li>
     </ul>
   <div class="nadpis_sekce"><strong><?php echo lang("Zkoušení nanečisto") ?></strong></div>
	   <ul>
       <li><a href="?nav_id=new_learning" class="active"><?php echo lang("Nové zkoušení")." ".lang("nanečisto") ?></a></li>
       <li><a href="?nav_id=list_learning" class="active"><?php echo lang("Výpis zkoušení")." ".lang("nanečisto") ?></a></li>
     </ul>
   <div class="nadpis_sekce"><strong><?php echo lang("Testy") ?></strong></div>
	   <ul>
       <li><a href="?nav_id=new_test" class="active"><?php echo lang("Nový test") ?></a></li>
     </ul>

   <div class="nadpis_sekce"><strong><?php echo lang("Články") ?></strong></div>
	   <ul>
       <li><a href="?nav_id=list_article" class="active"><?php echo lang("Výpis článků") ?></a></li>
     </ul>

   <div class="nadpis_sekce"><strong>&nbsp;</strong></div>
   <?php copyright(); ?>
</div>

<div id="content">
 <div class="content_home">
    <?php
  if ($poprve == "ano") print_hlasku(lang("Gratulujeme. <br />
            Vítejte v registrované zóně. Díky ní si budete moci při příštím zkoušení ověřit,
            zda již znáte slovíčka, která jste minule neuměli."));

  $cesta = "./examination/";

  //dulezite - urcuje zda jde o learning nebo examination
  $learning = (strstr($nav_id, 'learning') != NULL ) ? 'TRUE' : 'FALSE' ;

   //echo $nav_id;

  switch($_REQUEST['nav_id']) {
    case("new_learning") :
    case("new_exam") :
      require_once($cesta."new_exam.php");
    break;
    case("list_exam") :
    case("list_learning") :
      require_once($cesta."list_exam.php");
    break;
    case("do_learning") :
    case("do_exam") :
      require_once($cesta."do_exam.php");
    break;

    case("new_test") :
      require_once($cesta."new_test.php");
    break;
    case("do_test") :
      require_once($cesta."do_test.php");
    break;

    case("test_by_category") :
        //echo $nav_id;
    
      require_once($cesta."test_by_category.php");
    break;
    
    case("list_article") :
      require_once("./administration/list_article.php");
    break;
    case("detail_article") :
      require_once($cesta."detail_article.php");
    break;

    default:
  }

?></div>
</div>
<?php //pr($_SESSION); ?>
</body>
</html>
