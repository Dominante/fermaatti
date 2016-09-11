<?php
script('domisingers', 'memberprofile');
style('domisingers', 'profile');
?>

<div id="app">
<div id="app-content">
<div id="app-content-wrapper">

<?php if($_['isPrivilegedToEdit']): ?>
<style>
.privileged { display: initial; }
</style>
<?php endif; ?>
<?php if($_['isAdmin']): ?>
<style>
.admin { display: initial; }
</style>
<?php endif; ?>

<section id='name'>
    <div class='present'>
        <div class='row'>
            <span class='label'>Nimi</span><span class='value'></span><a data-action='edit_section' class='privileged icon-rename'></a>
        </div>
    </div>
    <div class='edit'>
        <div class='row'>
            <span class='label'>Etunimi</span>
            <input class='value' id='input_etunimi' type='text'>
        </div>
        <div class='row'>
            <div class='label'>Sukunimi</div>
            <input class='value' id='input_sukunimi' type='text'>
        </div>
        <div class='row'>
            <div class='label'>Lempinimi</div>
            <input class='value' id='input_lempinimi' type='text'>
        </div>
        <div class='row'>
            <div class='label'>o.s.</div>
            <input class='value' id='input_omaasukua' type='text'>
        </div>
        <div class='row'>
            <div class='label'>ent.</div>
            <input class='value' id='input_entinen' type='text'>
        </div>
        <div class='row'>
            <button data-action='cancel'>Peruuta</button>
            <button data-action='save'>Tallenna</button>
        </div>
    </div>
</section>
<section id='stemma'>
    <div class='present'>
        <div class='row'>
            <span class='label'>Stemma</span><span class='value'></span><a data-action='edit_section' class='privileged icon-rename'></a>
        </div>
    </div>
    <div class='edit'>
        <div class='row'>
            <div class='label'>Stemma</div>
            <div class='value'>
                <div class='row'><input type='radio' name='stemma' value=1>sopraano</div>
                <div class='row'><input type='radio' name='stemma' value=2>altto</div>
                <div class='row'><input type='radio' name='stemma' value=3>tenori</div>
                <div class='row'><input type='radio' name='stemma' value=4>basso</div>
                <div class='row'><input type='radio' name='stemma' value=0>muu</div>
            </div>
        </div>
         <div class='row'>
            <button data-action='cancel'>Peruuta</button>
            <button data-action='save'>Tallenna</button>
        </div>
    </div>
</section>
<section id='email'>
    <div class='present'>
        <div class='row'>
            <span class='label'>S&auml;hk&ouml;posti</span><span class='value'></span><a data-action='edit_section' class='privileged icon-rename'></a>
        </div>
    </div>
    <div class='edit'>
        <div class='row'>
            <span class='label'>S&auml;hk&ouml;posti</span>
            <input class='value' id='input_email' type='text'>
        </div>
        <div class='row'>
            <span class='label'> </span>
            <span class='value'>T&auml;m&auml; ei muuta Owncloud-tunnuksen s&auml;hk&ouml;postia</span>
        </div>
        <div class='row'>
            <button data-action='cancel'>Peruuta</button>
            <button data-action='save'>Tallenna</button>
        </div>
    </div>
</section>
<section id='phone'>
    <div class='present'>
        <div class='row'>
            <span class='label'>Puhelin</span><span class='value'></span><a data-action='edit_section' class='privileged icon-rename'></a>
        </div>
    </div>
    <div class='edit'>
        <div class='row'>
            <span class='label'>Puhelin</span>
            <input class='value' id='input_puhelin' type='text'>
        </div>
        <div class='row'>
            <span class='label'>Puhelin 2</span>
            <input class='value' id='input_puhelin2' type='text'>
        </div>
        <div class='row'>
            <button data-action='cancel'>Peruuta</button>
            <button data-action='save'>Tallenna</button>
        </div>
    </div>
</section>
<section id='address'>
    <div class='present'>
        <div class='row'>
            <span class='label'>Osoite</span><span class='value'></span><a data-action='edit_section' class='privileged icon-rename'></a>
        </div>
    </div>
    <div class='edit'>
        <div class='row'>
            <span class='label'>Katuosoite</span>
            <input class='value' id='input_katuosoite' type='text'>
        </div>
        <div class='row'>
            <span class='label'>Postinumero</span>
            <input class='value' id='input_postinumero' type='text'>
        </div>
        <div class='row'>
            <span class='label'>Kunta</span>
            <input class='value' id='input_kunta' type='text'>
        </div>
        <div class='row'>
            <button data-action='cancel'>Peruuta</button>
            <button data-action='save'>Tallenna</button>
        </div>
    </div>
</section>
<section id='responsibilities'>
    <div class='present'>
        <div class='row'>
            <span class='label'>Vastuut</span><span class='value'></span><a data-action='edit_section' class='privileged icon-rename'></a>
        </div>
    </div>
    <div class='edit'>
        <div class='row'>
            <span class='col1 tableheader'>Vuosi</span>
            <span class='col2 tableheader'>Vastuu</span>
        </div>
        <div class='row entry_template' style='display:none'>
            <span class='col1'></span>
            <span class='col2'></span>
            <a class='icon-delete' data-action='remove'></a>
        </div>
         <div class='row'>
            <div class='col1'><input id='input_vuosi' type='text'></div>
            <div class='col2'><select id='select_vastuu'></select></div>
            <button data-action='add'>lis&auml;&auml;</button>
        </div>
        <div class='row'>
            <button data-action='cancel'>Peruuta</button>
            <button data-action='save'>Tallenna</button>
        </div>
    </div>
</section>
<section id='presence'>
    <div class='present'>
        <div class='row'>
            <span class='label'>L&auml;sn&auml;olo</span><span class='value'></span><a data-action='edit_section' class='privileged icon-rename'></a>
        </div>
    </div>
    <div class='edit'>
        <div class='row'>
            <span class='label'>liittyi</span>
            <input class='value' id='input_liittyi' type='date'>
        </div>
        <div class='row'>
            <span class='label'><input type='checkbox' id='check_lopettanut'>lopetti</span>
            <input class='value' id='input_lopetti' type='date'>
        </div>
        <div class='row'>
            <span class='label'>Tauot</span>
        </div>
        <div class='row'>
            <span class='col1'>Alkoi</span>
            <span class='col2'>P&auml;&auml;ttyi</span>
            <span class='col3'>Selite</span>
        </div>
        <div class='row entry_template' style='display:none'>
            <span class='col1'></span>
            <span class='col2'></span>
            <span class='col3'></span>
            <a class='icon-delete' data-action='remove'></a>
        </div>
        <div class='row'>
            <div class='col1'><input id='input_alkoi' type='date'></div>
            <div class='col2'><input id='input_paattyi' type='date'></div>
            <div class='col3'><input id='input_selite' type='text'></div>
            <button data-action='add'>lis&auml;&auml;</button>
        </div>
        <div class='row'>
            <span class='label'>Tauot</span>
        </div>
        <div class='row'>
            <button data-action='cancel'>Peruuta</button>
            <button data-action='save'>Tallenna</button>
        </div>
    </div>
</section>
<section id='username'>
    <div class='present'>
        <div class='row'>
            <span class='label'>Käyttäjätunnus</span><span class='value'></span>
        </div>
    </div>
</section>
<section id='cntrls'>
    <div class='row'>
		<a id='return_link' href=''>&lt;&lt; Palaa listaan</a>
        <button class='admin' data-action='remove'><div class='icon-delete'></div>Poista kuorolainen</button>
    </div>
</section>

</div>
<div id='app-content-wrapper-user-deleted' style='display:none'>

<section><b>J&auml;sen poistettu tietokannasta!</b></section>

</div>
</div>
</div>
