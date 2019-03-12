<?php

if (!Empty($akce) && $akce == "odhlasit") {
  $hlaska = "Byl jste odhlasen!!!";
  session_start();
  $ses_nick = NULL;
  $ses_name = NULL;
  $ses_surname = NULL;
  $ses_privileges = NULL;
  $ses_date_last_visit = NULL;
  $ses_IDuser = NULL;

  session_unset();
}



$ses_privileges = NULL;

if (!Empty($n) && !Empty($p)):

  require_once("./classes/db.php");

  $spojeni = new DB_Sql();
  $dotaz = "SELECT * 
             FROM \"user\"
             WHERE nick LIKE '$n'";
  $spojeni->query($dotaz);
  //echo "Dotaz probehl<br />";
      
    if ($spojeni->num_rows() == 1):
      $spojeni->next_record();
        //echo "heslo z db:".$spojeni->Record["pass"];
         if ($p != $spojeni->Record["pass"]) {
            $hlaska = "Heslo je nesprávně!!";
            $p = "";
         }
         else if($spojeni->Record["privileges"] != 2 &&
                 $spojeni->Record["privileges"] != 3) {
            $hlaska ="Nemáte oprávnění pro vstup do administrace!!";
            $p = "";     
         }
         else {
            session_start();
            session_register("ses_nick");
            session_register("ses_name");
            session_register("ses_surname");
            session_register("ses_privileges");
            session_register("ses_date_last_visit");
            session_register("ses_IDuser");
            
            $ses_nick = $spojeni->Record["nick"];
            $ses_name = $spojeni->Record["name"];
            $ses_surname = $spojeni->Record["surname"];
            $ses_privileges = $spojeni->Record["privileges"];
            $ses_date_last_visit = time();
            $ses_IDuser = $spojeni->Record["IDuser"];
            
            $number_of_usage = $spojeni->Record["number_of_usage"];
            $number_of_usage++;
             
            $NOW = Date("Y-m-d H:i:s+02");

            $dotaz = "UPDATE \"user\" SET date_last_visit = '$NOW',
                                      number_of_usage = '$number_of_usage'
                            WHERE \"IDuser\" = $ses_IDuser";
            $spojeni->query($dotaz);
            
            //echo "Presmerovani";
            Header ("Location: administration.php");
            exit;
         }
      else:
         $hlaska = "Nick neexistuje !!!";
         $p = "";
         $n = "";
      endif;

elseif($send!="Přihlásit"):
   //$hlaska = "";
    ;
else:
   $hlaska = "Nebyl vyplněn celý formulář!!!";
endif;

// PROGRAM


require_once("./functions/dictionary.php");

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>vstup do administrace slovníku katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="css/kbs.css"> 
</head>

<body>
<div id="telickonejakystihly">
<center>
<form method="post" name="login_form">
<h3 class="nadpis2">Vstup do administrace</h3>
<?php if (!Empty($hlaska)) print_hlasku($hlaska) ?>
<table align="center" width="200">
    <tr class="akt">
        <td width="50%" align="right">Login:</td>
        <td width="50%"  align="left">
        <input type="text" name="n" value="<?php echo $n ?>" /></td>
    </tr>
    <tr class="akt">
        <td width="50%" align="right">Heslo:</td>
        <td width="50%"  align="left">
        <input type="password"  name="p" value="<?php echo $p ?>"  /></td>
    </tr>
    <tr class="nadpis_sekce">
        <td width="50%" align="right">&nbsp;</td>
        <td width="50%"  align="left">
        <input type="submit"  name="send" value="Přihlásit"  /></td>
    </tr>    
</table>
</form> 
<h6><a href="new_registration.php">Registrace nového uživatele</a> ||
<a href="index.php">Vstup do slovniku</a></h6>
</center>
</div>
<script language="javascript">
				<!--
					var uname = document.login_form.n;
					var pword = document.login_form.p;
					if (uname.value == "") {
						uname.focus();
					} else {
						pword.focus();
					}
				-->
				</script>

</body>
</html>
