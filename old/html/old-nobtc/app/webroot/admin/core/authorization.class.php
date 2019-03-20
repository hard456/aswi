<?php
class Authorization {

  var $max_odezva = 1200; //sekund   20 * 60

  var $nick;
  var $date_last_visit;
  var $userID;
  var $authority;

	// constructor
	function Authorization( $nick, $heslo )	{

    if (!Empty($nick) && !Empty($heslo)) {


      $dotaz = "SELECT * FROM uzivatele WHERE nick LIKE '$nick'";
      $spojeni = new Query($dotaz);
      //echo "Dotaz probehl<br />";

      if ($spojeni->num_rows() == 1) {
        $spojeni->next_record();
        //echo "heslo z db:".$spojeni->Record["psw"];
        if (md5($heslo) != $spojeni->Record["psw"]) {
          $hlaska = "Heslo je nespr�vn�!!";
          Header ("Location: index.php?admin_hlaska=".urlencode($hlaska));
        }
        else {
          session_destroy();
          session_regenerate_id();
          session_start();
          session_register("admi");
          session_register("auth");
          session_register("nick");
          session_register("heslo");

          $this->nick = $spojeni->Record["nick"];
          $this->date_last_visit = time();
          $this->userID = $spojeni->Record["ID"];
          $this->authority = $spojeni->Record["typ_uzivateleID"];


          $number_of_usage = $spojeni->Record["number_of_usage"];
          $number_of_usage++;

          $NOW = Date("Y-m-d H:i:s");
          $dotaz = "UPDATE uzivatele SET date_last_visit = '$NOW',
                                         number_of_usage = '$number_of_usage'
                                     WHERE ID = ".$this->userID;
          $spojeni->query($dotaz);
          $uvitani = true;
        }
      }
      else {
        $hlaska = "Nick neexistuje !!!";
        Header ("Location: index.php?admin_hlaska=".urlencode($hlaska));
      }
    }
    else {
      $hlaska = "Nevypln�no cel� !!!";
      Header ("Location: index.php?admin_hlaska=".urlencode($hlaska));
    }
	} // END constructor


	function is_authorize() {
    global $_SESSION;
    global $ses_date_last_visit;

    if(Empty($this->nick))            return false;
    if(Empty($this->date_last_visit)) return false;
    if(Empty($this->userID))          return false;

    $ted = time();

    if (($this->date_last_visit + $this->max_odezva) < $ted) return false;

    $this->date_last_visit = $ted;
    return true;
  }

  function log_out() {
    session_unset();
    $hlaska = "Byl jste odhlasen!!!";
    Header("Location: index.php?admin_hlaska=".urlencode($hlaska));
  } // end function log_out

} // END class Authorization
