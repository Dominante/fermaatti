/**
 * ownCloud - domisingers
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Tuukka Verho / Dominante <tuukka.verho@aalto.fi>
 * @copyright Tuukka Verho / Dominante 2015
 */

(function ($, OC) {
    var baseUrl = OC.generateUrl('/apps/domisingers');
    
    $(document).ready(function () {
        $('#input_aloitti').datepicker({dateFormat: 'yy-mm-dd'});
        $('#input_aloitti').datepicker('setDate', new Date());
        
        $('#finish').click(function() { 
            var params = {
                etunimi: $('#input_etunimi').val().trim(),
                sukunimi: $('#input_sukunimi').val().trim(),
                stemma: $('input:radio[name=stemma]:checked').val(),
                liittynyt: $('#input_aloitti').val()
            };
            
            if (!params['etunimi'] || !params['sukunimi'])
                return;
            
            $.ajax({
                url: baseUrl + '/profile/create',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(params)
            }).done(function (profile) {
                var personId = profile['personId'];
                console.log('Profile created, personId: ' + personId);
                window.location = baseUrl + '/profile/display/' + personId;
            }).fail(function (response, code) {
                console.log('Failed to create profile');
            });
        });
    });
})(jQuery, OC);