<?php
class DB_Sql {
  var $Host     = "127.0.0.1";
  var $Database = "obtc";
  var $Port     = "5432";
  var $User     = "dbowner";
  var $Password = "dl386exd";

  var $Link_ID  = 0;
  var $Query_ID = 0;
  var $Record   = array();
  var $Row      = 0;

  var $Seq_Table     = "db_sequence";

  var $Errno    = 0;
  var $Error    = "";
  var $Debug    = 0;

  var $Auto_Free = 0; # Set this to 1 for automatic pg_freeresult on 
                      # last record.
  var $PConnect  = 0; ## Set to 1 to use persistent database connections

  function ifadd($add, $me) {
          if("" != $add) return " ".$me.$add;
  }
  
  /* public: constructor */
  function DB_Sql($query = "") {
      $this->query($query);
  }

  function connect() {
    if ( 0 == $this->Link_ID ) {
      $cstr = "dbname=".$this->Database.
      $this->ifadd($this->Host, "host=").
      $this->ifadd($this->Port, "port=").
      $this->ifadd($this->User, "user=").
      $this->ifadd($this->Password, "password=");
      if(!$this->PConnect) {
        $this->Link_ID = pg_connect($cstr);
      } else {
        $this->Link_ID = pg_pconnect($cstr);
      }
      if (!$this->Link_ID) {
        $this->halt("connect() failed.");
      }
    }
  }

  function query($Query_String) {
    /* No empty queries, please, since PHP4 chokes on them. */
    if ($Query_String == "")
      /* The empty query string is passed on from the constructor,
       * when calling the class without a query, e.g. in situations
       * like these: '$db = new DB_Sql_Subclass;'
       */
      return 0;

    $this->connect();
    
    if ($this->Debug) 
      printf("<br>Debug: query = %s<br>\n", $Query_String);

    $this->Query_ID = pg_Exec($this->Link_ID, $Query_String);
    $this->Row   = 0;

    $this->Error = pg_ErrorMessage($this->Link_ID);
    $this->Errno = ($this->Error == "")?0:1;
    if (!$this->Query_ID) {
      $this->halt("Invalid SQL: ".$Query_String);
    }

    return $this->Query_ID;
  }
  
  function next_record() {
    $this->Record = @pg_fetch_array($this->Query_ID, $this->Row++);
    
    $this->Error = pg_ErrorMessage($this->Link_ID);
    $this->Errno = ($this->Error == "")?0:1;

    $stat = is_array($this->Record);
    if (!$stat && $this->Auto_Free) {
      pg_freeresult($this->Query_ID);
      $this->Query_ID = 0;
    }
    return $stat;
  }

  function halt($msg) {
    printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
    printf("<b>PostgreSQL Error</b>: %s (%s)<br>\n",
      $this->Errno,
      $this->Error);
    die("Session halted.");
  }
  function close() {
    pg_close($this->Link_ID);
  }
}
?>
