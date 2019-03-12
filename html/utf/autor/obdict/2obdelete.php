<?
include "autorizace.inc.php";
ksa_authorize();
if ($auth_level == 0) ksa_unauthorized();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Delete items from the Old Babylonian Dictionary</title>
</head>
<body>
<?
do
{
  @$connection = Pg_Connect ("user=dbowner dbname=klinopis");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
  $date = Date ("Y-m-d");
if ($potvrzeno == "1") {
  if ($id_classification > 0) {	
	  @$result_con = Pg_exec("select id_context from CONTEXT where id_classification = $id_classification");
	  $cpocet = Pg_NumRows ($result_con);
	  for ($i = 0 ; $i < $cpocet; $i++) {
		$id_context = Pg_Fetch_Row($result_con, $i);
	    $id_context = $id_context[0];
		@$result_lit = Pg_exec("delete from LITERATURE where id_context = $id_context");
		@$result_src = Pg_exec("delete from SOURCE where id_context = $id_context");
	  }
	  @$result_con = Pg_exec("delete from CONTEXT where id_classification = $id_classification");
	  @$result_trans = Pg_Exec("select id_translation from CLASSIFICATION where id_classification = $id_classification");
	  List($id_trans) = Pg_Fetch_Row($result_trans, 0);
	  @$result_word = Pg_Exec("select id_word from CLASSIFICATION where id_classification = $id_classification");
	  List($id_word) = Pg_Fetch_Row($result_word, 0);
	  @$result_class = Pg_exec("delete from CLASSIFICATION where id_classification = $id_classification");
	  if ($id_trans > 0) {
		  $result_trans1 = Pg_Exec("select count(*) from CLASSIFICATION where id_translation = $id_trans");
		  List($pocet) = Pg_Fetch_Row($result_trans1, 0);
		  $result_trans1 = Pg_Exec("select count(*) from MEANING where id_translation = $id_trans");
		  List($pocet_x) = Pg_Fetch_Row($result_trans1, 0);
		  $pocet += $pocet_x;
		  if ($pocet <= 0) {
			  $result_trans = Pg_Exec("delete from TRANSLATION where id_translation = $id_trans");
		  }
	  }
	  if ($id_word > 0) {
		  $result_o_class = Pg_Exec("select count(*) from CLASSIFICATION where id_word = $id_word");
		  List($pocet) = Pg_Fetch_Row($result_o_class, 0);
		  if ($pocet <= 0) {
			  $result = Pg_Exec("delete from WORD where ref_word = $id_word");
			  @$result_lit = Pg_exec("delete from ETYMON where id_word = $id_word");
			  @$result_lit = Pg_exec("delete from LITERATURE where id_word = $id_word");
			  @$result_trans = Pg_Exec("select id_translation from MEANING where id_word = $id_word");
		  	  $trans_count = Pg_NumRows($result_trans);
		      for ($i=0; $i < $trans_count; $i++) {
				List($trans) = pg_fetch_row($result_trans, $i);
				$id_trans[$i] = $trans;
			  }
			  $result_class = Pg_Exec("delete from MEANING where id_word = $id_word");
			  $result_class = Pg_Exec("delete from WORD where id_word = $id_word");
			  if (sizeof($id_trans) > 0) {
				  for ($i=0; $i < sizeof($id_trans); $i++) {
					$result_trans1 = Pg_Exec("select count(*) from CLASSIFICATION where id_translation = $id_trans[$i]");
					List($pocet) = Pg_Fetch_Row($result_trans1, 0);
					$result_trans1 = Pg_Exec("select count(*) from MEANING where id_translation = $id_trans[$i]");
					List($pocet_x) = Pg_Fetch_Row($result_trans1, 0);
					$pocet += $pocet_x;
					if ($pocet <= 0) {
						$result_trans = Pg_Exec("delete from TRANSLATION where id_translation = $id_trans[$i]");
					}
				  }
			  }
			echo "WORD and CLASSIFICATION was deleted!";
		  }
		  else {
			  echo "CLASSIFICATION was deleted!";
		  }
	  }
  }
  else { 
	  @$result_word = Pg_Exec("select id_word from WORD where item = '$item'");
	  List($id_word) = Pg_Fetch_Row($result_word, 0);
	  if ($id_word > 0) {
		  $result_o_class = Pg_Exec("select count(*) from CLASSIFICATION where id_word = $id_word");
		  List($pocet) = Pg_Fetch_Row($result_o_class, 0);
		  if ($pocet <= 0) {
			  $result = Pg_Exec("delete from WORD where ref_word = $id_word");
			  @$result_trans = Pg_Exec("select id_translation from MEANING where id_word = $id_word");
		  	  $trans_count = Pg_NumRows($result_trans);
		      for ($i=0; $i < $trans_count; $i++) {
				List($trans) = pg_fetch_row($result_trans, $i);
				$id_trans[$i] = $trans;
			  }
			  $result = Pg_Exec("delete from MEANING where id_word = $id_word");
			  @$result = Pg_exec("delete from ETYMON where id_word = $id_word");
			  @$result = Pg_exec("delete from LITERATURE where id_word = $id_word");
			  $result = Pg_Exec("delete from WORD where id_word = $id_word");
			  if (sizeof($id_trans) > 0) {
				  for ($i=0; $i < sizeof($id_trans); $i++) {
					$result_trans1 = Pg_Exec("select count(*) from CLASSIFICATION where id_translation = $id_trans[$i]");
					List($pocet) = Pg_Fetch_Row($result_trans1, 0);
					$result_trans1 = Pg_Exec("select count(*) from MEANING where id_translation = $id_trans[$i]");
					List($pocet_x) = Pg_Fetch_Row($result_trans1, 0);
					$pocet += $pocet_x;
					if ($pocet <= 0) {
						$result_trans = Pg_Exec("delete from TRANSLATION where id_translation = $id_trans[$i]");
					}
				  }
			  }
			  echo "WORD was deleted!";
		  }
		   else {
			  echo "WORD cannot be deleted!";
		   }
	  }
  }
}
else {
?>
  <p>Delete ?</p>
  <form action="/utf/autor/obdict/2obdelete.php" method="post">
	<input type="hidden" name="potvrzeno" value="1">
	<input type="hidden" name="id_classification" value="<? echo $id_classification ?>">
	<input type="hidden" name="item" value="<? echo $item ?>">

	<input type="submit" value="delete">
  </form>
<?
}
} while (false);
?>
</body>
</html>