<fieldset id="catalog-fieldset">
    <legend class="input-legend">Catalogue information</legend>
    <div>

    <div id="rightcorner">
      <a href="edit-book.php?id_book=<?php echo $found_cat['id_book'] ?>">edit book</a> |
      <a href="edit-transliteration-info.php?id_transliteration=<?php echo $id_transliteration ?>">edit transliteration info</a>
    </div>

    </div>
<table>
  <tr>
    <td class="title">Book abrev.</td>
    <td><?php echo $found_cat['book_abrev']?></td>
  </tr>
  <tr>
    <td class="title">Book name</td>
    <td><?php echo $found_cat['book_name']?></td>
  </tr>
  <tr>
    <td class="title">Book subtitle</td>
    <td><?php echo $found_cat['book_subtitle']?></td>
  </tr>
  <tr>
    <td class="title">Book author</td>
    <td><?php echo $found_cat['book_autor']?></td>
  </tr>
  <tr>
    <td class="title">Place of pub.</td>
    <td><?php echo $found_cat['place_of_pub']?></td>
  </tr>
  <tr>
    <td class="title">Date of pub.</td>
    <td><?php echo $found_cat['date_of_pub']?></td>
  </tr>
  <tr>
    <td class="title">Pages</td>
    <td><?php echo $found_cat['pages']?></td>
  </tr>
  <tr>
    <td class="title">Book desc.</td>
    <td><?php echo $found_cat['book_description']?></td>
  </tr>
  <tr>
    <td class="title">Volume</td>
    <td><?php echo $found_cat['volume']?></td>
  </tr>
  <tr>
    <td class="title">Volume number</td>
    <td><?php echo $found_cat['volume_no']?></td>
  </tr>
  <tr>
    <td class="title">Book type</td>
    <td><?php echo $found_cat['book_type']?></td>
  </tr>
  <tr>
    <td class="title">Chapter</td>
    <td><?php echo $found_cat['chapter']?></td>
  </tr>
  <tr>
    <td class="title">Museum</td>
    <td><?php echo $found_cat['museum'].", ".$found_cat['place']?></td>
  </tr>
  <tr>
    <td class="title">Museum no.</td>
    <td><?php echo $found_cat['museum_no']?></td>
  </tr>
  <tr>
    <td class="title">Reg. (Excavation) no.</td>
    <td><?php echo $found_cat['reg_no']?></td>
  </tr>
  <tr>
    <td class="title">Date</td>
    <td><?php echo $found_cat['date']?></td>
  </tr>
  <tr>
    <td class="title">Origin (Ancient name / Modern name) </td>
    <td><?php echo $found_cat['old_name'].' / '.$found_cat['origin']?></td>
  </tr>
  <tr>
    <td class="title">Note </td>
    <td><?php echo $found_cat['note']?></td>
  </tr>
  <tr>
    <td class="title">References (handcopy)</td>
    <td><?php
         foreach($references as $key=>$reference) {
           echo ($reference['series']." ".$reference['number'].", ".$reference['plate']. "<br />");
         }
    ?></td>
  </tr>
</table>
</fieldset>
