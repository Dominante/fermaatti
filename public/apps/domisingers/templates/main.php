<?php
script('domisingers', 'memberlist');
style('domisingers', 'memberlist');
?>

<div id="app">
<div id="app-content">
<div id="app-content-wrapper">

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
	<tbody id='membertable'>
		<tr class='row_template'>
			<td><a class='name' href='{{profilelink}}'>{{name}}</a><br><span>{{stemma}}</span></td>
			<td><a href='mailto:{{email}}'>{{email}}</a><br><span>{{phone}}</span></td>
			<td><span>{{responsibilities}}</span></td>
		</tr>
	</tbody>
</table>

<div class='loading icon-loading'></div>

</div>
</div>
</div>




    
