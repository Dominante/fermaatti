<?php
$headers = ['nimi', 'stemma', 'puhelin', 'email', 'vastuut'];
?>

<div class='row'>
    <input type='checkbox' id='checkbox'>Näytä lopettaneet</input>
    <a class=button href='newprofile'>Lisää kuorolainen</a>
</div>
    
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