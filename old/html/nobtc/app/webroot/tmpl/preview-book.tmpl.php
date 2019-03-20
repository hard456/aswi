<fieldset id="book-fieldset">
  <legend class="input-legend">Book information</legend>
<table>
  <tbody>
    <tr>
      <td><b>Existing or new:</b></td>
      <td><?php echo($POST['add-or-select-radio']=='select')? 'Existing':'New' ;?></td>
    </tr>
    <?php if(!empty($POST['add-or-select-radio']) && $POST['add-or-select-radio'] == 'select'): ?>
    <tr>
      <td><b>Book:</b></td>
      <td><?php
      foreach($book_array as $book) {
      		if ($book['id_book']==$POST['id_book'])
      			echo $book['book_abrev'];
      } ?></td>
    </tr>
    <?php else: ?>
    <tr>
      <td><b>Book abrev:</b></td>
      <td><?=$POST['book_abrev']?></td>
    </tr>

    <tr>
      <td><b>Book name:</b></td>
      <td><?=$POST['book_name']?></td>
    </tr>

    <tr>
      <td><b>Subtitle:</b></td>
      <td><?=$POST['book_subtitle']?></td>
    </tr>

    <tr>
      <td><b>Author:</b></td>
      <td><?=$POST['book_autor']?></td>
    </tr>

    <tr>
      <td><b>Place of publication:</b></td>
      <td><?=$POST['place_of_pub']?></td>
    </tr>

    <tr>
      <td><b>Date of publication:</b></td>
      <td><?=$POST['date_of_pub']?></td>
    </tr>

    <tr>
      <td><b>Pages:</b></td>
      <td><?=$POST['pages']?></td>
    </tr>

    <tr>
      <td><b>Description:</b></td>
      <td><?=$POST['book_description']?></td>
    </tr>

    <tr>
      <td><b>Volume:</b></td>
      <td><?=$POST['volume']?></td>
    </tr>

    <tr>
      <td><b>Volume number:</b></td>
      <td><?=$POST['volume_no']?></td>
    </tr>


    <?php endif; ?>
  </tbody>
</table>
</fieldset>
