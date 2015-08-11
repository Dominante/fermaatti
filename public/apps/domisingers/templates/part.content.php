<div id="controls"><div class="breadcrumb"><div class="crumb svg last" data-dir="/"><a style="visibility: hidden;" href="/owncloud/index.php/apps/files?dir=/"><img class="svg" src="<?php print_unescaped(OCP\image_path("core", "places/home.svg")); ?>" alt="Koti"></a></div></div>
    <div class="actions creatable" style="margin-left: 20px;">
        <select style="position: relative; top: -1px;">
            <option value="" selected="">Kaikki äänialat</option>
            <option value="core/templates/mail.php">Sopraanot</option>
            <option value="core/templates/altmail.php">Altot</option>
            <option value="core/lostpassword/templates/email.php">Tenorit</option>
            <option value="settings/templates/email.new_user.php">Bassot</option>
        </select>

        <select style="position: relative; top: -1px;">
            <option value="" selected="">Kaikki jäsenet</option>
            <option value="core/templates/mail.php">Nykykuorolaiset</option>
            <option value="core/templates/altmail.php">Laulajapankissa</option>
            <option value="core/templates/altmail.php">Lopettanut</option>
        </select>

        <div style="width: 10px; display: inline-block;"></div>

        <div id="editSingers" class="button">
            <a>Muokkaa kuorolaislistaa</a>
        </div>
    </div>
    <div id="file_action_panel" activeaction="false"></div>
    <div class="notCreatable notPublic hidden">
        Käyttöoikeutesi eivät riitä tiedostojen lähettämiseen tai kansioiden luomiseen tähän sijaintiin		</div>
    <input type="hidden" name="permissions" value="31" id="permissions" original-title="">
</div>

    <table id="contactlist" style="display: table; margin-top: 40px;" class="">
        <thead>
        <tr id="contactsHeader" class="">
            <td class="name" colspan="1">
                <span class="actions_left">
                <input type="checkbox" class="toggle" id="select_all"
                       original-title="Valitse kaikki (tai älä valitse mitään)">
                <label for="select_all"></label>
                <select class="action sort permanent" name="sort" title="Lajittelujärjestys" style="">
                    <option value="fn">Nimi</option>
                    <option value="fl">Etunimi</option>
                    <option value="lf">Sukunimi</option>
                </select>
                </span>

                <span class="actions" style="display: none;">
                    <a class="icon-delete delete svg action text permanent">
                        Poista <img class="svg" alt="Poista" src="<?php print_unescaped(OCP\image_path("core", "actions/delete.svg")); ?>">
                    </a>
                    <select class="groups svg action text permanent shared" name="groups" style="">
                        <option value="-1" disabled="disabled" selected="selected">Ryhmät</option>
                        <optgroup data-action="add" label="Lisää...">
                            <option value="5">Bassot</option>
                        </optgroup>
                        <optgroup data-action="remove" label="Poista...">
                            <option value="5">Bassot</option>
                        </optgroup>
                        <option value="add">Lisää ryhmä...</option>
                    </select>
                    <a class="icon-download download svg action text permanent">Lataa</a>
                    <a class="icon-rename action svg text permanent merge edit" style="">Yhdistä</a>
                </span>
            </td>
            <td class="info tel" style="">Ääniala</td>
            <td class="info tel" style="">Jäsenyys</td>
            <td class="info tel" style="">Vastuut</td>
            <td class="info adr" style="">Sähköpostiosoite</td>
            <td class="info" style="">Puhelin</td>
            <td class="info adr" style="">Käyttäjä</td>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <textarea id="singerEditor">
[{
        "name": "Seppo Murto", 
        "vocal": "", 
        "membership": "Nykykuorolainen",
        "roles": "Kuoronjohtaja",
        "email": "seppo@murto.fi",
        "phone": "04012343545",  
        "user": "seppo-murto"
    },
    {
        "name": "Saara Sopraano", 
        "vocal": "Sopraano", 
        "membership": "Nykykuorolainen",
        "roles": "",
        "email": "saara.sopraano@helsinki.fi",
        "phone": "04012343545",  
        "user": "saara-sopraano"
    },
    {
        "name": "Aino Altto", 
        "vocal": "Altto", 
        "membership": "Nykykuorolainen",
        "roles": "",
        "email": "aino-altto@helsinki.fi",
        "phone": "04012343545",  
        "user": "aino-altto"
    },
    {
        "name": "Tuukka Tenori", 
        "vocal": "Tenori", 
        "membership": "Nykykuorolainen",
        "roles": "",
        "email": "tuukkatenori@aalto.fi",
        "phone": "04012343545",  
        "user": "tuukka-tenori"
    },
    {
        "name": "Juho Jyrkiäinen", 
        "vocal": "Basso", 
        "membership": "Nykykuorolainen",
        "roles": "Hallitus, viskaali",
        "email": "juho.jj.test@aalto.fi",
        "phone": "04012343545",  
        "user": "juho-jyrkiainen"
    },
    {
        "name": "Atte Keinänen", 
        "vocal": "Basso", 
        "membership": "Nykykuorolainen",
        "roles": "IT-työryhmä, apuisäntä",
        "email": "atte.keinanen@aalto.fi",
        "phone": "0405898383",
        "user": "atte-keinanen"
    },
  {
        "name": "Teemu Tenori", 
        "vocal": "Tenori", 
        "membership": "Laulajapankissa",
        "roles": "",
        "email": "teemu.tenori@iki.fi",
        "phone": "04012343545",  
        "user": ""
    },
{
        "name": "Armi Altto", 
        "vocal": "Altto", 
        "membership": "Lopettanut 2005",
        "roles": "",
        "email": "armi-altto@helsinki.fi",
        "phone": "04012343545",  
        "user": ""
    }
]
    </textarea>