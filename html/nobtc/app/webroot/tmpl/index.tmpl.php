 <h1>PREDELAT DO CAKE</h1>
 <?php echo $obsah;

 exit();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title dir="ltr" lang="cs">
      Old Babylonian Text Corpus >> Klinopis.cz
    </title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="Old Babylonian, Akkadian, Text Corpus, Akkadian Dictionary, Old Babylonian cuneiform list, akkadisches Wörterbuch, altbabylonische Texte, Codex Hammurapi, mathematical texts, omina" name="Description" />


    <link rel="stylesheet" type="text/css" href="css/obtc.css" />


  </head>
  <body>
  	<div id="all">
  	<div id="hlavicka">
  		<div id="pruh">
  		<img src="img/obtclogozh.gif" alt="logo" id="logo" />
  		<div id="nadpiscontainer">
			<h1 class="hlavni"><a href="./">Old Babylonian Text Corpus v. 2</a></h1>
		</div>

		<!-- obrazky -->
  		</div><!-- end of pruh -->
  		<div id="horninavigacecontainer">
	  		<ul class="horni navigace">
	  			<li><a href="search-text.php" title="Text search in corpus">  search &amp; edit texts </a></li>
	  			<li><a onclick="this.target='_blank'" href="/utf/utf/sj.php" title="search dictionary">  search dictionary </a></li>
				<li><a href="search-catalogue.php" title="Search in text calalogue">  text catalogue </a></li>
				<li><a onclick="this.target='_blank'" href="/utf/utf/signs.html" title="catalogue of cuneiform signs">  catalogue of cuneiform signs </a></li>
				<li><a onclick="this.target='_blank'" href="/utf/utf/students.php" title="for our students in Czech">  for our students in Czech </a></li>
				<li><a onclick="" href="/pages/staff" title="contact">  contact &amp; members </a></li>
	  		</ul>
	  	</div>
		<div id="dolninavigacecontainer">
			<ul class="dolni navigace">
				<li><a href="insert-new-text.php" title=" input new text"> input new text (for members only)</a></li>
				<li><a href="admin.php" title="Admin">  admin </a></li>
				<li><a onclick="this.target='_blank'" href="/utf/utf/howtobeamember.php" title=" how to become a member">   how to become a member </a></li>
			</ul>
		</div>
  	</div><!-- end of header -->
  	<div style="clear:both"></div>

	<div id="content">
  <?php echo $obsah;?>
	</div>
	<div class="clear">
      &nbsp;
      <!-- cistic -->
    </div>
    <div id="footer">
      &#169; Furat Rahman - Faculty of Philosophy - University of West Bohemia in Pilsen and Cuneiform Circle 2002-<?php echo date('Y');?>
    </div>
	</div><!-- end of all -->
  </body>
</html>