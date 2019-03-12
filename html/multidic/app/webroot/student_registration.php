<?php
require_once("./administration/user.php");

if (!empty($action) && $action == "new_registration") {

  $zobrazit_znovu = true;

  if (empty($name)) {
    $hlaska .= "Jméno musíte vyplnit";
  }
  else if (empty($surname)) {
    $hlaska .= "Příjmení musíte vyplnit";
  }
  else if (empty($email)) {
    $hlaska .= "E-mail musíte vyplnit";
  }
  else if (!ERegI("^[^.]+(\.[^.]+)*@([^.]+[.])+[a-z]{2,5}$", $email)) {
    $hlaska .= "E-mailová adresa není ve správném tvaru.";
  }
  else if (empty($nick)) {
    $hlaska .= "Nick musíte vyplnit";
  }
  else if (empty($password) || empty($password2)) {
    $hlaska .= "Heslo i heslo pro kontrolu musíte vyplnit";
  }
  else if ($password != $password2) {
    $hlaska .= "Heslo a heslo pro kontrolu se neshoduje";
  }
  else {
    if (nick_exists($nick)) {
      $hlaska .= "Uživatel s takovým nickem již existuje, zvolte si prosím jiný";
    }
    else {
      insert_user($name, $surname, $city, $email, $nationality, 1, $nick, $password, false);
      $zobrazit_znovu = false;
      Header ("Location: ./?n=$nick&p=$password&poprve=ano");
    }
  }
}

function znova($string) {
  global $zobrazit_znovu;
  if ($zobrazit_znovu)
    echo ' value="'.$string.'"';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Slovník katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="css/kbs.css">
</head>

<body>
<center>
<table align="center">
  <thead>
    <h3 class="nadpis2">Registrace nového uživatele</h3>
    <h5>Vítejte v registraci. <br />
            Díky ní si budete moci při příštím zkoušení ověřit,
            zda již znáte slovíčka, která jste minule neuměli.</h5>

    <?php print_hlasku($hlaska); ?>
  </thead>
  <tbody>
    <form action="" method="POST" name="new_registration_form">
      <table align="center" border="0">
      <tr class="akt">
        <td>jméno*</td>
        <td><input type="text" name="name"  size="50" maxlength="50"<?php znova($name)?> /></td>
      </tr>
      <tr class="akt">
        <td>příjmení*</td>
        <td><input type="text" name="surname"  size="50" maxlength="50"<?php znova($surname)?> /></td>
      </tr>
      <tr class="akt">
        <td>město</td>
        <td><input type="text" name="city"  size="50" maxlength="70"<?php znova($city)?> /></td>
      </tr>
      <tr class="akt">
        <td>e-mail*</td>
        <td><input type="text" name="email"  size="50" maxlength="80"<?php znova($email)?> /></td>
      </tr>
      <tr class="akt">
        <td>národnost</td>
        <td><input type="text" name="nationality"  size="50" maxlength="30"<?php znova($nationality)?> /></td>
      </tr>
      <tr class="akt">
        <td>nick*</td>
        <td><input type="text" name="nick"  size="50" maxlength="30"<?php znova($nick)?> /></td>
      </tr>
      <tr class="akt">
        <td>heslo*</td>
        <td><input type="password" name="password"  size="50" maxlength="100" onFocus="setFocus(this)" /></td>
      </tr>
      <tr class="akt">
        <td>heslo znovu*</td>
        <td><input type="password" name="password2"  size="50" maxlength="100" onFocus="setFocus(this)" /></td>
      </tr>
      <tr class="nadpis_sekce">
        <td>
          <input type="hidden" name="action" value="new_registration">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </table>
  </tbody>
</table>
<h6 align="center"><a href="./">Zpět ke vstupu do slovniku</a></h6>
</center>
</body>
</html>
