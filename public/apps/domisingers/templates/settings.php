<form id="domisingers" class="section">
    <h2>Kuorolaiset</h2>
    <p>Tiedot kuorolaisista haetaan JSON-tiedostosta, jota voidaan säilyttää esimerkiksi admin-käyttäjän kansiossa. Sieltä käsin se on tarpeen mukaan muokattavissa.</p>
    <label for="pathToDomiSingersJson">Polku JSON-tiedostoon: </label>
    <?php
    $path = OCP\Config::getAppValue('domisingers', 'json_path');
    ?>
    <input style="width: 250px;" type="text" name="pathToDomiSingersJson" id="pathToDomiSingersJson" value="<?php echo $path; ?>" original-title="">
    <span class="msg"></span>
</form>