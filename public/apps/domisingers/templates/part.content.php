<?php
$members = $_['members'];

$attributes = ['etunimi', 'sukunimi', 'puhelin1', 'email', 'stemma', 'vastuut'];

$stemmat = ['muu', 'sopraano', 'altto', 'tenori', 'basso'];
?>

<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', $attributes); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($members as $member):
    if ($member->lopettanut != '0000-00-00') continue;
    $fields = get_object_vars($member);
    $fields['stemma'] = $stemmat[$member->stemma];
    $fields['vastuut'] = implode(', ', $member->vastuut);
?>
    <tr>
        <?php foreach ($attributes as $attr): ?>
            <td><?php echo $fields[$attr]; ?></td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>