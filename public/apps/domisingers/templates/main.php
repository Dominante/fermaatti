<?php
script('domisingers', 'memberlist');
style('domisingers', 'memberlist');
?>

<?php
$headers = ['nimi', 'stemma', 'puhelin', 'email', 'vastuut'];
?>

<div id="app">
<div id="app-content">
<div id="app-content-wrapper">

<?php echo $_['user']; ?>
<div class='row' <?php if (!$_['isAdmin']) echo 'style="display:none"'; ?> >
	<input id='input_etunimi' placeholder='Etunimi' type='text'>
	<input id='input_sukunimi' placeholder='Sukunimi' type='text'>
	<select id='select_stemma'>
		<option value=0>ei stemmaa</option>
		<option value=1>sopraano</option>
		<option value=2>altto</option>
		<option value=3>tenori</option>
		<option value=4>basso</option>
	</select>
	<input id='input_liittyi' placeholder='liittyi'>
	<button class='newprofile'>Lisää kuorolainen</button>
</div>
<div class='row'>
	<input type='checkbox' id='checkbox'>Näytä lopettaneet</input>
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

</div>
</div>
</div>




    
