<fieldset id="transliteration-info-fieldset">
  <legend class="input-legend">Transliteration information</legend>
  <table>
    <tbody>
      <tr>
        <td><b>Museum:</b></td>
        <td><?php foreach($museum_array as $mus) if ($mus['id_museum']==$POST['id_museum']) echo $mus['museum'] ?></td>
      </tr>
      <tr>
        <td><b>Museum number:</b></td>
        <td><?php echo $POST['museum_no']?></td>
      </tr>
      <tr>
        <td><b>Origin:</b></td>
        <td><?php foreach($origin_array as $orig) if ($orig['id_origin']==$POST['id_origin']) echo $orig['origin'] ?></td>
      </tr>
    <tr>
      <td><b>Type:</b></td>
      <td><?php foreach($book_type_array as $type) if ($type['id_book_type']==$POST['id_book_type']) echo $type['book_type'] ?></td>
    </tr>
    <tr>
      <td><b>Chapter in referenced book:</b></td>
      <td><?php echo $POST['chapter'] ?></td>
    </tr>
    <tr>
      <td><b>Register/Excavation number:</b></td>
      <td><?php echo $POST['reg_no'] ?></td>
    </tr>
    <tr>
      <td><b>Date:</b></td>
      <td><?php echo $POST['date'] ?></td>
    </tr>

      <?php if(!empty($POST['series'])):?>
      <tr>
        <td><b>References:</b></td>
        <td>
        <?php for($i=0; $i<count($POST['series']); $i++): ?>

        <?php echo $POST['series'][$i]?>, <?php echo $POST['number'][$i]?>, <?php echo $POST['page'][$i]?><br />

        <?php endfor;?>
        </td>
      </tr>
      <?php endif;?>
    </tbody>
  </table>
</fieldset>
