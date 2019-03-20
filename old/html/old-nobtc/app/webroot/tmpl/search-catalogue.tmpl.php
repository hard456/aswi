<h1>Search in catalog</h1>

<fieldset id="catalog-fieldset">
    <legend class="input-legend">Enter your conditions</legend>
<form action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" id="insert-form">
<input name="-lop" value="and" checked="checked" type="radio" id="and-lop"><label for="and-lop">Match all conditions on page (AND)</label> 
<input name="-lop" value="or" type="radio" id="or-lop"><label for="or-lop">Match any condition on page (OR)</label> 
<br />

<table>
  <tr>
    <td>Book abbrev.</td>
    <td><?=get_is_or_isnot('id_book')?></td>
    <td>
        <? chooser_get_book(); ?>
    </td>
  </tr>
  <tr>
    <td>Book name</td>
    <td>
        <?= get_contain_chooser('book_name');?> 
    </td>
    <td>
      <input type="text" name="book_name" />
    </td>
  </tr>
  <tr>
    <td>Type</td>
    <td><?=get_is_or_isnot('id_book_type')?></td>
    <td>
      <? chooser_get_book_type(); ?>
    </td>
  </tr>
  <tr>
    <td>Author</td>
    <td>
        <?= get_contain_chooser('book_autor');?>  
    </td>
    <td>
      <input type="text" name="book_autor" />
    </td>
  </tr>  
  <tr>
    <td>Book chapter</td>
    <td>
        <?= get_contain_chooser('chapter');?> 
    </td>
    <td>
      <input type="text" name="chapter" />
    </td>
  </tr>
  <!--tr>
    <td>Aternate publication</td>
    <td>
        <?= get_contain_chooser('alternate-pub');?>  
    </td>
    <td>
      <input type="text" name="alternate-pub" />
    </td>
  </tr-->
  <tr>
    <td>Museum</td>
    <td><?=get_is_or_isnot('id_museum')?></td>
    <td>
        <? chooser_get_museum(); ?>
    </td>
  </tr>
  <tr>
    <td>Museum number</td>
    <td>
        <?= get_contain_chooser('museum_no');?> 
    </td>
    <td>
      <input type="text" name="museum_no" />
    </td>
  </tr>
  <tr>
    <td>Origin</td>
    <td><?=get_is_or_isnot('id_origin')?></td>
    <td>
      <? chooser_get_origin(); ?>
    </td>
  </tr>
  <tr>
    <td>View a lot of texts (1000 per site) </td>
    <td>&nbsp; </td>
    <td>
      <input name="view-all" id="view-all-id" type="checkbox" />
    </td>
  </tr>
</table>

<input type="hidden" name="actione" value="search" />

<input type="submit" name="search" value="Search" />

</form>
</fieldset>
