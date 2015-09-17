<?php
script('domisingers', 'newprofile');
style('domisingers', 'profile');
?>

<div id="app">
<div id="app-content">
<div id="app-content-wrapper">

<section id='name'>
        <div class='row'>
            <span class='label'>Etunimi</span>
            <input class='value' id='input_etunimi' type='text'>
        </div>
        <div class='row'>
            <div class='label'>Sukunimi</div>
            <input class='value' id='input_sukunimi' type='text'>
        </div>
</section>
<section id='stemma'>
        <div class='row'>
            <div class='label'>Stemma</div>
            <div class='value'>
                <div class='row'><input type='radio' name='stemma' value=1>sopraano</div>
                <div class='row'><input type='radio' name='stemma' value=2>altto</div>
                <div class='row'><input type='radio' name='stemma' value=3>tenori</div>
                <div class='row'><input type='radio' name='stemma' value=4>basso</div>
                <div class='row'><input type='radio' name='stemma' value=0 checked=true>muu</div>
            </div>
        </div>
</section>
<section id='date'>
        <div class='row'>
            <span class='label'>Aloitti</span>
            <input class='value' id='input_aloitti' type='date'>
        </div>
</section>
<section id='buttons'>
    <div class='row'>
        <a class='button' href='list/all'>Peruuta</a>
        <a class='button' id='finish'>Lis&auml;&auml;</a>
    </div>
</section>

</div>
</div>
</div>