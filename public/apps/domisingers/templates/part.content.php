<?php
$members = $_['members'];

$headers = ['nimi', 'stemma', 'puhelin', 'email', 'vastuut'];

$stemmat = ['muu', 'sopraano', 'altto', 'tenori', 'basso'];
?>

<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', $headers); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($members as $member):
    if ($member->lopettanut != '0000-00-00') continue;
    $fields = [
        $member->etunimi.' '.$member->sukunimi,
        $stemmat[$member->stemma],
        $member->puhelin1,
        $member->email,
        implode(', ', $member->vastuut)
        ];
?>
    <tr>
        <td><?php echo implode('</td><td>', $fields); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>