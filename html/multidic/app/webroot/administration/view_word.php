<style type="text/css">

.m {
	font-size: 30px;
}

.s {
	font-size: 25px;
}

.xs {
	font-size: 18px;
}

.xxs {
	font-size: 15px;
}

.czech {
	text-align: left;
	margin-left:50px;
	margin-top:25px;
}

.left {
  float: left;
}

.thin {
  width: 200px;
}

.right {
  float: right;
}


.clearfix:after {
	content: ".";
	display: block;
	clear: both;
	visibility: hidden;
	line-height: 0;
	height: 0;
}
 
.clearfix {
	display: inline-block;
}
 
html[xmlns] .clearfix {
	display: block;
}
 
* html .clearfix {
	height: 1%;
}

</style>

<?php 
require_once("./administration/word.php");

if(!empty($word_id)){
  
  $Record = get_word($word_id);
  
  $word_category_foreign = $Record['word_category_foreign'];

  $Record['gender'] = trim($Record['gender']);
?>

<?php // echo $word_category_foreign?>

<div class="card">
  <?php if(("שם עצם"  !== $word_category_foreign) || !empty($Record['gender'])):?>
    <?php echo $Record["czech"]." &nbsp; - &nbsp; ".$Record["english"]; ?>
  <?php endif;?>

<div style="text-align: right;padding-right:3em">

<?php //podstatné jméno ?>
<?php if("שם עצם"  === $word_category_foreign): ?>
  <?php //běžné podstatné jméno ?>
  <?php if(!empty($Record['gender'])): ?>
	<p dir="rtl">
	<span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
	<span class="arabic xs">‫ש"ע‬</span>
	<span class="arabic s" dir="ltr" style="direction:ltr"><?php echo $Record['gender']?></span>
	<span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
	</p>
	<?php if(!empty($Record['present'])): ?>
	    <p dir="rtl">
	    <span class="arabic s" dir="rtl">ר.</span>
	    <span class="arabic" dir="rtl"><?php echo $Record['present']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['status_constructus_single'])): ?>
	    <p dir="rtl">
	    <span class="arabic s" dir="rtl">ס. י. </span>
	    <span class="arabic" dir="rtl"><?php echo $Record['status_constructus_single']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['status_constructus_plural'])): ?>
	    <p dir="rtl">
	    <span class="arabic s" dir="rtl">ס. ר. </span>
	    <span class="arabic" dir="rtl"><?php echo $Record['status_constructus_plural']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['root'])): ?>
	    <p dir="rtl">
	    <span class="arabic s" dir="rtl"> ש.  <?php echo $Record['root']?></span>
	    </p>
	<?php endif; ?>
      
    <?php // obourode ?>
    <?php else: ?>

        <p dir="rtl">
	  <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
	  <span class="arabic xs">‫ש"ע‬</span>
	</p>

	<?php if(!empty($Record['past'])): ?>

	    <p class="clearfix">
	      <span class="czech left thin" dir="ltr"><?php echo $Record['czech']?></span>
	      <span class="right" dir="rtl">
		<span class="arabic s" dir="rtl">י.ז.</span>
		<span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
	      </span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['single_female'])): ?>
	    <p class="clearfix">
	      <span class="czech left thin" dir="ltr"><?php echo $Record['czech_female']?></span>
	      <span class="right" dir="rtl">
		<span class="arabic s" dir="rtl">י.נ.</span>
		<span class="arabic" dir="rtl"><?php echo $Record['single_female']?></span>
	      </span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['present'])): ?>
	    <p dir="rtl">
	    <span class="arabic s" dir="rtl">ר.ז.</span>
	    <span class="arabic" dir="rtl"><?php echo $Record['present']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['plural_female'])): ?>
	    <p dir="rtl">
	    <span class="arabic s" dir="rtl">ר.נ.</span>
	    <span class="arabic" dir="rtl"><?php echo $Record['plural_female']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['status_constructus_single'])): ?>
	    <p dir="rtl">
	    <span class="arabic xs" dir="rtl">ס.י.ז.</span>
	    <span class="arabic s" dir="rtl"><?php echo $Record['status_constructus_single']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['status_constructus_single_noun_female'])): ?>
	    <p dir="rtl">
	    <span class="arabic xs" dir="rtl">ס.י.נ.</span>
	    <span class="arabic s" dir="rtl"><?php echo $Record['status_constructus_single_noun_female']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['status_constructus_plural'])): ?>
	    <p dir="rtl">
	    <span class="arabic xs" dir="rtl">ס.ר.ז.</span>
	    <span class="arabic s" dir="rtl"><?php echo $Record['status_constructus_plural']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['status_constructus_plural_noun_female'])): ?>
	    <p dir="rtl">
	    <span class="arabic xs" dir="rtl">ס.ר.נ.</span>
	    <span class="arabic s" dir="rtl"><?php echo $Record['status_constructus_plural_noun_female']?></span>
	    </p>
	<?php endif; ?>

	<?php if(!empty($Record['root'])): ?>
	    <p dir="rtl">
	    <span class="arabic s" dir="rtl"> ש.  <?php echo $Record['root']?></span>
	    </p>
	<?php endif; ?>

    <?php endif; ?>


<?php //pridavne jmeno?>
<?php elseif("תואר"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs"> ‫ת'‬ </span>
    <span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
    </p>
    <?php if(!empty($Record['single_adj_female'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> י. נ. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['single_adj_female']?></span>
        </p>
    <?php endif; ?>

    <?php if(!empty($Record['present'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ר.ז. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['present']?></span>
        </p>
    <?php endif; ?>

    <?php if(!empty($Record['plural_adj_female'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ר.נ. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['plural_adj_female']?></span>
        </p>
    <?php endif; ?>

    <?php if(!empty($Record['status_constructus_single'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ס. י. ז. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['status_constructus_single']?></span>
        </p>
    <?php endif; ?>

    <?php if(!empty($Record['status_constructus_single_female'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ס. י. נ. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['status_constructus_single_female']?></span>
        </p>
    <?php endif; ?>

    <?php if(!empty($Record['status_constructus_plural'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ס.  ר. ז. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['status_constructus_plural']?></span>
        </p>
    <?php endif; ?>

    <?php if(!empty($Record['status_constructus_plural_female'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ס. ר. נ. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['status_constructus_plural_female']?></span>
        </p>
    <?php endif; ?>

    <?php if(!empty($Record['root'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ש.  <?php echo $Record['root']?></span>
        </p>
    <?php endif; ?>


<?php //zajmeno   ?>
<?php elseif("מילת גוף"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs" dir="ltr"> מ"ג </span>
    <span class="arabic xs" dir="ltr" style="direction:ltr"><?php echo $Record['gender']?></span>
    <span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
    </p>
   

<?php // cislovka   ?>
<?php elseif("שם מספר"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs" dir="ltr"> ש"מ‬ </span>
    <span class="arabic xs" dir="ltr" style="direction:ltr"><?php echo $Record['gender']?></span>
    <span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
    </p>
    <?php if(!empty($Record['status_constructus_single'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> </span>
        <span class="arabic" dir="rtl"><?php echo $Record['status_constructus_single']?></span>
        </p>
    <?php endif; ?>
   

<?php // sloveso   ?>
<?php elseif("פועל"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs"> פ' </span>
    <span class="arabic xs" dir="rtl"><?php echo $Record['conjugation']?></span>
    <span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
    </p>
    <?php if(!empty($Record['infinitive'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> שם פועל </span>
        <span class="arabic" dir="rtl"><?php echo $Record['infinitive']?></span>
        </p>
    <?php endif; ?>
    <?php if(!empty($Record['present'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> זמן הווה </span>
        <span class="arabic" dir="rtl"><?php echo $Record['present']?></span>
        </p>
    <?php endif; ?>
    <?php if(!empty($Record['future'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> זמן עתיד </span>
        <span class="arabic" dir="rtl"><?php echo $Record['future']?></span>
        </p>
    <?php endif; ?>
    <?php if(!empty($Record['imperative'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ציווי </span>
        <span class="arabic" dir="rtl"><?php echo $Record['imperative']?></span>
        </p>
    <?php endif; ?>
    <?php if(!empty($Record['root'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ש.  <?php echo $Record['root']?></span>
        </p>
    <?php endif; ?>


<?php //prislovce  ?>
<?php elseif("תואר הפועל"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs" dir="ltr"> תה"פ </span>
    <span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
    </p>

    <?php if(!empty($Record['prefix'])): ?>
        <p dir="rtl">
        <span class="arabic xs" dir="rtl"> בנטייה  <?php echo $Record['prefix']?></span>
        </p>
    <?php endif; ?>

   
    <?php if(!empty($Record['root'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ש.  <?php echo $Record['root']?></span>
        </p>
    <?php endif; ?>
    



<?php //predlozka  ?>
<?php elseif( "מילת יחס"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic m" dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs" dir="ltr"> מ"י </span>
    <span class="arabic m" dir="rtl"><?php echo $Record['past']?></span>
    </p>
   
    <?php if(!empty($Record['prefix'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> בנטייה  <?php echo $Record['prefix']?></span>
        </p>
    <?php endif; ?>


<?php //spojka  ?>
<?php elseif( "מילת חיבור"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic " dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs" dir="ltr"> מ"ח </span>
    <span class="arabic " dir="rtl"><?php echo $Record['past']?></span>
    </p>

<?php //citoslovce  ?>
<?php elseif( "מילת שאלה"  === $word_category_foreign): ?>
    <p dir="rtl">
    <span class="arabic " dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs" dir="ltr">  מ"ש  </span>
    <span class="arabic " dir="rtl"><?php echo $Record['past']?></span>
    </p>

<?php //ostatní uvedené  ?>
<?php elseif( !empty( $word_category_foreign )): ?>
    <p dir="rtl">
    <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
    <span class="arabic xs" dir="rtl"> <?php echo $word_category_foreign ?> </span>
    <span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
    </p>
   


<?php else: ?>
	<p dir="rtl">
	  <span class="arabic" dir="rtl"><?php echo $Record['nonvocalized']?></span>
          <span class="arabic xs" dir="rtl"> &nbsp;&nbsp;&nbsp; </span>
          <span class="arabic s" dir="ltr" style="direction:ltr"><?php echo $Record['gender']?></span>
	  <span class="arabic xs" dir="rtl"> &nbsp;&nbsp;&nbsp; </span>
	  <span class="arabic" dir="rtl"><?php echo $Record['past']?></span>
	</p>

    <?php if(!empty($Record['present'])): ?>
        <p dir="rtl">
        <span class="arabic s" dir="rtl"> ר.ז. </span>
        <span class="arabic" dir="rtl"><?php echo $Record['present']?></span>
        </p>
    <?php endif; ?>

<?php endif; ?>

</div>

<?php if (!Empty($Record["word_voice"])): ?>
  	<br /> <?php echo lang("Zvuk:") . '<a href="'.CESTA_SLOV.$Record["IDdict"].PRIPONA.'"> '.lang("přehrát zvuk").' </a>'; ?>  
<?php endif; ?>
</div>

<?php
  }//end of else
?>

<?php echo "<pre>"?>
<?php //var_dump($Record)?>
<?php echo "</pre>"?>

