/**
 * ownCloud - domisingers
 * @author Tuukka Verho / Dominante <tuukka.verho@aalto.fi>
 * @copyright Tuukka Verho / Dominante 2015
 */


(function ($, OC) {
    var baseUrl = OC.generateUrl('/apps/domisingers');
    var personId;
    var profile;

	$(document).ready(function () {
        personId = parseInt(window.location.href.split('/').pop());
        loadProfile(personId, updateInfo);
    });
        
        
    function loadProfile(personId, callback) {
        $.ajax({
            url: baseUrl + '/profile/show/' + personId,
            type: 'GET',
            contentType: 'application/json'
        }).done(function (response) {
            profile = response;
            console.log('Profile loaded');
            updateInfo();
        }).fail(function (response, code) {
            console.log('Failed to fetch profile info');
        });
    }
    
    function updateInfo() {
        var stemmat = ['muu', 'sopraano', 'altto', 'tenori', 'basso'];
        $('#field_name').text(profile.etunimi + ' ' + profile.sukunimi);
        $('#field_stemma').text(stemmat[profile.stemma]);
        $('#field_puhelin').text(profile.puhelin1);
        $('#field_email').text(profile.email);
        $('#field_osoite').text(profile.katuosoite + ' ' + profile.postinumero + ' ' + profile.kunta);
        $('#field_liittynyt').text(profile.liittynyt);
        $('#field_lopettanut').text(profile.lopettanut);
        
        var vastuut = '';
        profile.vastuut.forEach(function(element) {
            vastuut += element['viskaalius'] + ' (' + element['kausi'] + '), ';
        });
        $('#field_vastuut').text(vastuut);
    }
})(jQuery, OC);