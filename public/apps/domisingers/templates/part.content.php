<?php
$headers = ['nimi', 'stemma', 'puhelin', 'email', 'vastuut'];
?>

<input type='checkbox' id='checkbox'>Näytä lopettaneet</input>

<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', $headers); ?></th>
    </tr>
  </thead>
  <tbody id='membertable'>
  <tr><td>Ladataan kuorolaislistaa...</td></tr>
  </tbody>
</table>