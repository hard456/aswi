<?
  require_once("./administration/user.php");

$vypis_edit = true;

if (!Empty($action) && $action == "edit_user") {

  if (Empty($name)) {
    print_hlasku("Jméno musíte vyplnit");
  }
  else if (Empty($surname)) {
    print_hlasku("Příjmení musíte vyplnit");
  }
  else if (Empty($email)) {
    print_hlasku("E-mail musíte vyplnit");
  }
  else if (!ERegI("^[^.]+(\.[^.]+)*@([^.]+[.])+[a-z]{2,5}$", $email)) {
    print_hlasku("E-mailová adresa není ve správném tvaru.");
  }
  else if (Empty($privileges)) {
    print_hlasku("Práva musíte vyplnit");
  }
  else if ($privileges != 1 && $privileges != 2 && $privileges != 3) {
    print_hlasku("Práva: Zadejte 1 = jen čtení, 2 = čtení i zápis nebo 3 = admin.");
  }
  else if (Empty($nick)) {
    print_hlasku("Nick musíte vyplnit");
  }
  else {
    update_user($name, $surname, $city, $email, $nationality, $privileges, $nick, $user_id);
    //print_table_of_user();
    $vypis_edit = false;
  }
}
if($vypis_edit){

  $Record      = get_user($user_id);
  $name        = $Record[1];
  $surname     = $Record[2];
  $city        = $Record[3];
  $email       = $Record[4];
  $nationality = $Record[5];
  $privileges  = $Record[9];
  $nick        = $Record[10];


?>
<script language="JavaScript">
	function setFocus(object)
	{
	   	object.focus();
	   	object.select();
	}

  function validate_edit_user_form(form) {
    edit_user_form = form;
    if (edit_user_form.name.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_user_form.name);
      return false;
    }
    if (edit_user_form.surname.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_user_form.surname);
      return false;
    }
    if (edit_user_form.email.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_user_form.email);
      return false;
    }
    if(window.RegExp) {
      re = new RegExp("^[^.]+(\.[^.]+)*@([^.]+[.])+[a-z]{2,5}$");
      if (!re.test(edit_user_form.email.value)) {
        alert("Zadaná adresa není správnou adresou elektronické pošty!");
        setFocus(edit_user_form.email);
        return false;
      }
    }
    if (edit_user_form.privileges.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_user_form.privileges);
      return false;
    }
    if (edit_user_form.privileges.value != "1" && 
        edit_user_form.privileges.value != "2" &&
        edit_user_form.privileges.value != "3") {
      alert("Práva: Zadejte 1 = jen čtení, 2 = čtení i zápis nebo 3 = admin.");
      setFocus(edit_user_form.privileges);
      return false;
    }
    if (edit_user_form.nick.value == "") {
      alert("Položku musite vyplnit.");
      setFocus(edit_user_form.nick);
      return false;
    }
    
    return true;
  }
</script>
<table>
    <thead align="center"> <h3 class="nadpis2">Uprav uživatele</h3> </thead>
    <tbody>
    <form action="" method="POST" name="edit_user_form" onSubmit="return validate_edit_user_form(this)">
      <table border="0">
      <tr class="akt">
        <td>jméno*</td>
        <td><input type="text" name="name"  size="50" maxlength="50" value="<?php echo $name?>" /></td>
      </tr>
      <tr class="akt">
        <td>příjmení*</td>
        <td><input type="text" name="surname"  size="50" maxlength="50" value="<?php echo $surname?>" /></td>
      </tr>
      <tr class="akt">
        <td>město</td>
        <td><input type="text" name="city"  size="50" maxlength="70"/ value="<?php echo $city?>" ></td>
      </tr>
      <tr class="akt">
        <td>e-mail*</td>
        <td><input type="text" name="email"  size="50" maxlength="80" value="<?php echo $email?>" /></td>
      </tr>
      <tr class="akt">
        <td>národnost</td>
        <td><input type="text" name="nationality"  size="50" maxlength="30" value="<?php echo $nationality?>" /></td>
      </tr>
      <tr class="akt">
        <td>práva*</td>
        <td><input type="text" name="privileges"  size="50" maxlength="2" value="<?php echo $privileges?>" /></td>
      </tr>
      <tr class="akt">
        <td>nick*</td>
        <td><input type="text" name="nick"  size="50" maxlength="30" value="<?php echo $nick?>" /></td>
      </tr>
      <tr>
        <td>
          <input type="hidden" name="action" value="edit_user">
          <input type="hidden" name="user_id" value="<?php echo $user_id?>">
        </td>
        <td><input type="submit" value="Uprav"></td>
      </tr>
    </form>
    </tbody>
  </table>
<?php
  }//end of else
?>
