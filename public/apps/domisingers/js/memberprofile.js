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
    var personId;
    var profile = [];
    var datepickerDefaults = {dateFormat: 'yy-mm-dd', minDate: null};

    $(document).ready(function () {
        personId = parseInt(window.location.href.split('/').pop());
        loadProfile(personId, profileLoaded);
        
        $('button.edit_section').click(function(event) {
            editSection($(event.target).closest('section'));
        });
        
        $('button.save').click(function(event) {
            saveChanges($(event.target).closest('section'));            
        });
        
        $('button.cancel').click(function(event) {
            $('.present').show();
            $('.edit').hide();
        });
        
        $('#responsibilities button.add').click(function() {
            var kausi = $('#input_vuosi').val();
            var viskaalius = $('#select_vastuu').val();
            profile['vastuut'].push({kausi: kausi, viskaalius: viskaalius});
            updateResponsibilitiesEdit();
        });
        
        $('#delete button.remove').click(function(event) {
            deleteProfile();
        });
    });
    
    function profileLoaded() {
        updateNamePresentation();
        updateStemmaPresentation();
        updateEmailPresentation();
        updatePhonePresentation();
        updateAddressPresentation();
        updateResponsibilitiesPresentation();
        updatePresencePresentation();
    }
    
    function deleteProfile() {
        $.ajax({
            url: baseUrl + '/profile/delete/' + personId,
            type: 'DELETE',
            contentType: 'application/json'
        }).done(function () {
            console.log('Profile removed, personId: ' + personId);
            $('#app-content-wrapper').html(
                '<section><b>J&auml;sen poistettu tietokannasta!</b></section>')
        }).fail(function (response, code) {
            console.error('Failed to delete profile');
        }); 
    }
    
    function editSection(section) {
        $('.present').show();
        $('.edit').hide();
        section.find('.present').hide();
        section.find('.edit').show();
        var id = section.attr('id');
        if (id == 'name') {
            $('#input_etunimi').val(profile['etunimi']);
            $('#input_sukunimi').val(profile['sukunimi']);
            $('#input_lempinimi').val(profile['lempinimi']);
            $('#input_omaasukua').val(profile['sukunimi2']);
            $('#input_entinen').val(profile['sukunimi3']);
        }
        else if (id == 'stemma') {
            $('input:radio[name=stemma]').val([profile['stemma']]);
        }
        else if (id == 'email') {
            $('#input_email').val(profile['email']);
        }
        else if (id == 'phone') {
            $('#input_puhelin').val(profile['puhelin1']);
            $('#input_puhelin2').val(profile['puhelin2']);
        }
        else if (id == 'address') {
            $('#input_katuosoite').val(profile['katuosoite']);
            $('#input_postinumero').val(profile['postinumero']);
            $('#input_kunta').val(profile['kunta']);
        }
        else if (id == 'responsibilities') {
            loadResponsibilityChoices();
            updateResponsibilitiesEdit();
        }
        else if (id == 'presence') {
            updatePresenceEdit();
        }
    }
    
    function saveChanges(section, saveChanges) {
        $('.present').show();
        $('.edit').hide();
        var id = section.attr('id');
        if (id == 'name') {
            profile['etunimi'] = $('#input_etunimi').val().trim();
            profile['sukunimi'] = $('#input_sukunimi').val().trim();
            profile['lempinimi'] = $('#input_lempinimi').val().trim();
            profile['sukunimi2'] = $('#input_omaasukua').val().trim();
            profile['sukunimi3'] = $('#input_entinen').val().trim();
            updateNamePresentation();
        }
        else if (id == 'stemma') {
            profile['stemma'] = $('input:radio[name=stemma]:checked').val();
            updateStemmaPresentation();
        }
        
        else if (id == 'email') {
            profile['email'] = $('#input_email').val().trim()
            updateEmailPresentation();
        }
        else if (id == 'phone') {
            profile['puhelin1'] = $('#input_puhelin').val().trim();
            profile['puhelin2'] = $('#input_puhelin2').val().trim();
            profile['kunta'] = $('#input_kunta').val().trim();
            updatePhonePresentation();
        }
        else if (id == 'address') {
            profile['katuosoite'] = $('#input_katuosoite').val().trim();
            profile['postinumero'] = $('#input_postinumero').val().trim();
            profile['kunta'] = $('#input_kunta').val().trim();
            updateAddressPresentation();
        }
        else if (id == 'responsibilities') {
            updateResponsibilitiesPresentation();
        }
        
        else if (id == 'presence') {
            profile['liittynyt'] = $('#input_liittyi').val().trim();
            if ($('#check_lopettanut').attr('checked') && $('#input_lopetti').val()) {
                profile['lopettanut'] = $('#input_lopetti').val().trim();
            } else {
                profile['lopettanut'] = '0000-00-00';
            }
            updatePresencePresentation();
        }
        
        $.ajax({
            url: baseUrl + '/profile/update',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({profile: profile})
        }).done(function (updatedProfile) {
            profile = updatedProfile;
        }).fail(function (response, code) {
            console.error('Failed to update profile');
            loadProfile();
        });
        
    }
    
    
    function loadResponsibilityChoices() {
        $.ajax({
            url: baseUrl + '/profile/responsibilitychoices',
            type: 'GET',
            contentType: 'application/json'
        }).done(function (response) {
            $('#input_vuosi').val((new Date).getFullYear());
            var select = $('#select_vastuu');
            select.empty();
            response.forEach(function(choice) {
                select.append($("<option/>", {value: choice, text: choice}));
            });
        }).fail(function (response, code) {
            console.error('Failed to load responsibility choices');
        }); 
    }
        
    
    function updateResponsibilitiesEdit() {
        $('#responsibilities .entry').remove();
        var template = $('#responsibilities .entry_template');
        for(i=0; i<profile['vastuut'].length; i++) {
            var r = profile['vastuut'][i];
            var row = template.clone();
            row.switchClass('entry_template', 'entry ' + i);
            row.insertBefore(template);
            row.find('.col1').text(r['kausi']);
            row.find('.col2').text(r['viskaalius']);
            row.show();
        }
        
        $('#responsibilities button.remove').click(function(event) {
            var row = event.target.closest('.row');
            var i = $(row).prop('class').split(/\s+/)[2];
            profile['vastuut'].splice(i, 1);
            updateResponsibilitiesEdit();
        });
    }
    
    function updatePresenceEdit() {
        $('#input_liittyi').datepicker(datepickerDefaults);
        $('#input_liittyi').datepicker('setDate', profile['liittynyt']);
        $('#input_lopetti').datepicker(datepickerDefaults);
        
        var finished = (profile['lopettanut'] != '0000-00-00');
        $('#check_lopettanut').attr('checked', finished);
        
        if (finished) {
            $('#input_lopetti').datepicker('setDate', profile['lopettanut']);
        } else {
            $('#input_lopetti').val('');
        }
        $('#input_lopetti').prop('disabled', !finished); 
        
        $('#check_lopettanut').change(function() {
            var finished = $(this).attr('checked');
            if (finished) {
                $('#input_lopetti').datepicker('show');
            } 
            $('#input_lopetti').prop('disabled', !finished); 
        });
    }
        
    
    function updateNamePresentation() {
        var str = profile['etunimi'] + ' ';
        if (profile['lempinimi'])
            str += '"' + profile['lempinimi'] + '" ';
        str += profile['sukunimi'];
        if (profile['sukunimi2'])
            str += ' (o.s. ' + profile['sukunimi2']+')';
        if (profile['sukunimi3'])
            str += ' (ent. ' + profile['sukunimi3']+')';
        $('#name .present .value').text(str);
    }
    
    function updateStemmaPresentation() {
        var str = ['muu', 'sopraano', 'altto', 'tenori', 'basso'][profile['stemma']];
        $('#stemma .present .value').text(str);
    }
    
    function updateEmailPresentation() {
        $('#email .present .value').text(profile['email']);
    }
    
    function updatePhonePresentation() {
        var str = profile['puhelin1'];
        if (profile['puhelin2'])
            str += '<br>' + profile['puhelin2'];
        $('#phone .present .value').html(str);
    }
    
    function updateAddressPresentation() {
        var str = profile['katuosoite']+'<br>'+profile['postinumero']+' '+profile['kunta'];
        $('#address .present .value').html(str);
    }
    
    function updateResponsibilitiesPresentation() {
        var lines = [];
        profile['vastuut'].forEach(function(r) {
            lines.push(r['kausi'] + ': ' + r['viskaalius']);
        });
        var text = lines.join('<br>').replace(/ä/g, '&auml').replace(/ö/g, '&ouml');
        $('#responsibilities .present .value').html(text);
    }
    
    function updatePresencePresentation() {
        var lines = ['liittyi ' + profile['liittynyt']];
        if (profile['lopettanut'] != '0000-00-00') {
            lines.push('lopetti ' + profile['lopettanut']);
        }
        var text = lines.join('<br>').replace(/ä/g, '&auml').replace(/ö/g, '&ouml');
        $('#presence .present .value').html(text);
    }
    
    
    function loadProfile(personId, callback) {
        $.ajax({
            url: baseUrl + '/profile/show/' + personId,
            type: 'GET',
            contentType: 'application/json'
        }).done(function (response) {
            profile = response;
            callback();
        }).fail(function (response, code) {
            console.error('Failed to fetch profile info');
        });  
    }
})(jQuery, OC);