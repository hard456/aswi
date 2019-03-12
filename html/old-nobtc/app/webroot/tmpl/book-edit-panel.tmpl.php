    <div class="noname" id="book-info-add">
    <table>
      <tr title="Book abreviation - only in a form like e.g. Sumer_23">
        <td><label for="book_abrev">Book abbrev:</label> </td>
        <td><input size="20" maxlength="20" id="book_abrev" name="book_abrev" value="<?=$POST['book_abrev']?>" /></td>
      </tr>
   
      <tr title="Full name">
        <td><label for="book_name">Book name:</label> </td>
        <td><input size="100" maxlength="100" id="book_name" name="book_name" value="<?=$POST['book_name']?>" /> </td>
      </tr>
    
      <tr title="Subtitle">
        <td><label for="book_subtitle">Subtitle:</label> </td>
        <td><input size="100" maxlength="150" id="book_subtitle" name="book_subtitle" value="<?=$POST['book_subtitle']?>" /> </td>
      </tr>
    
      <tr title="All authors separated by comma">
        <td><label for="book_autor">Author:</label> </td>
        <td><input size="100" maxlength="100" id="book_autor" name="book_autor" value="<?=$POST['book_autor']?>" /> </td>
      </tr>
      
      <tr title="Place of publication">
        <td><label for="place_of_pub">Place of publication:</label> </td>
        <td><input size="100" maxlength="100" id="place_of_pub" name="place_of_pub" value="<?=$POST['place_of_pub']?>" /> </td>
      </tr>
      
      <tr title="Date or year of publication">
        <td><label for="book_autor">Date of publication:</label> </td>
        <td><input size="100" maxlength="100" id="date_of_pub" name="date_of_pub" value="<?=$POST['date_of_pub']?>" /> </td>
      </tr>
      
      <tr title="Pages">
        <td><label for="book_autor">Pages:</label> </td>
        <td><input size="100" maxlength="100" id="pages" name="pages" value="<?=$POST['pages']?>" /> </td>
      </tr>
    
      <tr title="Other description of the book">
        <td><label  for="book_description">Description:</label> </td>
        <td><input size="100" maxlength="400" id="book_description" name="book_description" value="<?=$POST['book_description']?>" /> </td>
      </tr>
      
      <tr title="Volume">
        <td><label for="volume">Volume:</label> </td>
        <td><input size="100" maxlength="150" id="volume" name="volume" value="<?=$POST['volume']?>" /> </td>
      </tr>
      
      <tr title="Volume number">
        <td><label for="volume_no">Volume number:</label> </td>
        <td><input size="100" maxlength="30" id="volume_no" name="volume_no" value="<?=$POST['volume_no']?>" /> </td>
      </tr>
      
    </table>
    </div>
