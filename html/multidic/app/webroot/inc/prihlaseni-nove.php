        
        
        <?php if (kontrola_pristupu()):?>

		<i>Přihlášen:</i><br />
   		  <?php echo "".$_SESSION['ses_name']." ".$_SESSION['ses_surname']."\n"?>
   		  <br />
   		  <?php if(kontrola_pristupu(3)) echo "Administrátor";
   		        elseif(kontrola_pristupu(2)) echo "Uživatel (smí i zapisovat)";
   		        else echo "Uživatel"?>
   		  <br />
   		  <a href="?akce=odhlasit">Odhlásit</a>


          <?php else: ?>
        <form action="" method="post" id="login_form">
          <div>
            <label for="jmeno"><?php echo lang("Přihlašovací jméno:") ?></label>
            <input type="text" id="jmeno" name="n" value="<?php echo $n ?>" title="<?php echo lang("Jméno") ?>" />
            <label for="heslo"><?php echo lang("Přihlašovací heslo:") ?></label>
            <input type="password" id="heslo" name="p" title="<?php echo lang("Heslo") ?>" />
            <input type="submit" name="send" value="<?php echo lang("Přihlásit") ?>" />
          </div>
        </form>
        <?php endif; ?>




<?php return; ?>






































          <?php if (kontrola_pristupu()):?>

		<i>Přihlášen:</i><br />
   		  <?php echo "".$_SESSION['ses_name']." ".$_SESSION['ses_surname']."\n"?>
   		  <br />
   		  <?php if(kontrola_pristupu(3)) echo "Administrátor";
   		        elseif(kontrola_pristupu(2)) echo "Uživatel (smí i zapisovat)";
   		        else echo "Uživatel"?>
   		  <br />
   		  <ul>

   		  <?php if(kontrola_pristupu(1))
   		       echo" <li><a href=\"examination.php\">Zkoušení</a></li>";
   		  ?>
   		  <?php if(kontrola_pristupu(2))
   		       echo" <li><a href=\"administration.php\">Administrace</a></li>";
   		  ?>
   		  <li><a href="./?akce=odhlasit">Odhlásit</a></li>
   		  </ul>


          <?php else: ?>
            <form action="./" method="post" name="login_form">
              <h3 class="nadpis2">
                <?php
                if ( !empty($_REQUEST['view_article']) )
                  echo lang("Zkoušení slovíček k vybranému článku");
                else
                  echo lang("Vstup do studijního slovníku"); ?>
              </h3>
              <?php if (!Empty($hlaska)) print_hlasku($hlaska) ?>
              <div style="text-align: center">
                <center>
                  <table style="text-align: center" width="160">
                    <tr class="akt">
                      <td width="50%" align="right">
                        <?php echo lang("Login:") ?>
                      </td>
                      <td width="50%"  align="left">
                        <input type="text" name="n" value="<?php echo $n ?>" size="11" />
                      </td>
                    </tr>
                    <tr class="akt">
                      <td width="50%" align="right">
                        <?php echo lang("Heslo:") ?>
                      </td>
                      <td width="50%"  align="left">
                        <input type="password"  name="p" value="<?php //echo $p ?>" size="11" />
                      </td>
                    </tr>
                    <tr class="nadpis_sekce">
                      <td width="50%" align="right">
                        &nbsp;
                      </td>
                      <td width="50%"  align="left">
                        <input type="submit"  name="send" value="<?php echo lang("Přihlásit") ?>"  />
                        <?php if( !empty($_REQUEST['view_article']) ): ?>
                          <input type="hidden" name="action" value="select_lection" />
                          <input type="hidden" name="source" value="<?php echo $article['IDsource']?>" />
                          <input type="hidden" name="lection" value="<?php echo $article['lection']?>" />
                        <?php endif; ?>
                      </td>
                    </tr>
                  </table>
                </center>
              </div>
            </form>

<script language="javascript" type="text/javascript">
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
 <?php endif;?>