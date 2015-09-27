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
	var personId = parseInt(window.location.href.split('/').pop());
	var documentReady = false;
	var profile;
	var profile_revert;
	var datepickerDefaults = {dateFormat: 'yy-mm-dd', minDate: null};

	// Run init() when both the DOM tree and the profile have loaded
	loadProfile(function() {
		if (documentReady) init();
	});

	$(document).ready(function () {
		documentReady = true;
		if (profile) init();
	});

	function loadProfile(callback) {
		$.ajax({
			url: baseUrl + '/profile/show/' + personId,
			type: 'GET',
			contentType: 'application/json'
		}).done(function (response) {
			profile = response;
			callback();
		}).fail(function (response, code) {
			OC.dialogs.alert('Profiilin haku epäonnistui! ', 'Virhe', function () {
				window.location = baseUrl;
			});
		});
	}

	function init() {
		$('#return_link').prop('href', baseUrl);

		$('[data-action="edit_section"]').click(function(event) {
			$('.present').show();
			$('.edit').hide();
			profile_revert = $.extend({}, profile);
			editSection($(event.target).closest('section'));
		});

		$('[data-action="save"]').click(function(event) {
			$('.present').show();
			$('.edit').hide();
			saveChanges($(event.target).closest('section'));
		});

		$('[data-action="cancel"]').click(function(event) {
			$('.present').show();
			$('.edit').hide();
			profile = profile_revert;
		});

		$('#responsibilities [data-action="add"]').click(function() {
			var kausi = $('#input_vuosi').val();
			var viskaalius = $('#select_vastuu').val();
			profile.vastuut.push({kausi: kausi, viskaalius: viskaalius});
			updateResponsibilitiesEdit();
		});

		$('#cntrls [data-action="remove"]').click(function(event) {
			var title = 'Vahvistus';
			var text = 'Poistetaanko kuorolainen? Toimintoa ei voi perua.'+
				' Huom: älä poista lopettaneita kuorolaisia vaan merkitse heille lopetuspäivämäärä!';
			OC.dialogs.confirm(text, title, function(result) {
				if (result) deleteProfile();
			});
		});

		updateAll();
	}

	function updateAll() {
		updateNamePresentation();
		updateStemmaPresentation();
		updateEmailPresentation();
		updatePhonePresentation();
		updateAddressPresentation();
		updateResponsibilitiesPresentation();
		updatePresencePresentation();
		updateUsernamePresentation();
	}

	function deleteProfile() {
		$.ajax({
			url: baseUrl + '/profile/delete/' + personId,
			type: 'DELETE',
			contentType: 'application/json'
		}).done(function () {
			console.log('Profile removed, personId: ' + personId);
			$('#app-content-wrapper').hide();
			$('#app-content-wrapper-user-deleted').show();
			window.setTimeout(function() {window.location = baseUrl;}, 1500);
		}).fail(function (response, code) {
			OC.dialogs.alert('Jäsenen poistaminen epäonnistui! ' + code, 'Virhe');
		});
	}

	// Show editing controls for a section
	function editSection(section) {
		section.find('.present').hide();
		section.find('.edit').show();
		var id = section.attr('id');
		if (id == 'name') {
			$('#input_etunimi').val(profile.etunimi);
			$('#input_sukunimi').val(profile.sukunimi);
			$('#input_lempinimi').val(profile.lempinimi);
			$('#input_omaasukua').val(profile.sukunimi2);
			$('#input_entinen').val(profile.sukunimi3);
		}
		else if (id == 'stemma') {
			$('input:radio[name=stemma]').val([profile.stemma]);
		}
		else if (id == 'email') {
			$('#input_email').val(profile.email);
		}
		else if (id == 'phone') {
			$('#input_puhelin').val(profile.puhelin1);
			$('#input_puhelin2').val(profile.puhelin2);
		}
		else if (id == 'address') {
			$('#input_katuosoite').val(profile.katuosoite);
			$('#input_postinumero').val(profile.postinumero);
			$('#input_kunta').val(profile.kunta);
		}
		else if (id == 'responsibilities') {
			loadResponsibilityChoices();
			updateResponsibilitiesEdit();
		}
		else if (id == 'presence') {
			updatePresenceEdit();
		}
	}

	// Send updated profile to the server
	function saveChanges(section, saveChanges) {
		var id = section.attr('id');
		if (id == 'name') {
			profile.etunimi = $('#input_etunimi').val().trim();
			profile.sukunimi = $('#input_sukunimi').val().trim();
			profile.lempinimi = $('#input_lempinimi').val().trim();
			profile.sukunimi2 = $('#input_omaasukua').val().trim();
			profile.sukunimi3 = $('#input_entinen').val().trim();
			updateNamePresentation();
		}
		else if (id == 'stemma') {
			profile.stemma = $('input:radio[name=stemma]:checked').val();
			updateStemmaPresentation();
		}

		else if (id == 'email') {
			profile.email = $('#input_email').val().trim()
			updateEmailPresentation();
		}
		else if (id == 'phone') {
			profile.puhelin1 = $('#input_puhelin').val().trim();
			profile.puhelin2 = $('#input_puhelin2').val().trim();
			profile.kunta = $('#input_kunta').val().trim();
			updatePhonePresentation();
		}
		else if (id == 'address') {
			profile.katuosoite = $('#input_katuosoite').val().trim();
			profile.postinumero = $('#input_postinumero').val().trim();
			profile.kunta = $('#input_kunta').val().trim();
			updateAddressPresentation();
		}
		else if (id == 'responsibilities') {
			updateResponsibilitiesPresentation();
		}

		else if (id == 'presence') {
			profile.liittynyt = $('#input_liittyi').val().trim();
			if ($('#check_lopettanut').attr('checked') && $('#input_lopetti').val()) {
				profile.lopettanut = $('#input_lopetti').val().trim();
			} else {
				profile.lopettanut = '0000-00-00';
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
			OC.dialogs.alert('Profiilin päivitys epäonnistui! ' + code, 'Virhe');
			loadProfile();
		});

	}

	// Get the possible responsibility values from server
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

	// Initialize editing controls
	function updateResponsibilitiesEdit() {
		$('#responsibilities .entry').remove();
		var template = $('#responsibilities .entry_template');
		for(i=0; i<profile.vastuut.length; i++) {
			var r = profile.vastuut[i];
			var row = template.clone();
			row.switchClass('entry_template', 'entry ' + i);
			row.insertBefore(template);
			row.find('.col1').text(r['kausi']);
			row.find('.col2').text(r['viskaalius']);
			row.show();
		}

		$('#responsibilities [data-action="remove"]').click(function(event) {
			var row = event.target.closest('.row');
			var i = $(row).prop('class').split(/\s+/)[2];
			profile.vastuut.splice(i, 1);
			updateResponsibilitiesEdit();
		});
	}

	function updatePresenceEdit() {
		$('#input_liittyi').datepicker(datepickerDefaults);
		$('#input_liittyi').datepicker('setDate', profile.liittynyt);
		$('#input_lopetti').datepicker(datepickerDefaults);

		var finished = (profile.lopettanut != '0000-00-00');
		$('#check_lopettanut').attr('checked', finished);

		if (finished) {
			$('#input_lopetti').datepicker('setDate', profile.lopettanut);
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

	// Construct the non-editable class='present' elements
	function updateNamePresentation() {
		var str = profile.etunimi + ' ';
		if (profile.lempinimi)
			str += '"' + profile.lempinimi + '" ';
		str += profile.sukunimi;
		if (profile.sukunimi2)
			str += ' (o.s. ' + profile.sukunimi2+')';
		if (profile.sukunimi3)
			str += ' (ent. ' + profile.sukunimi3+')';
		$('#name .present .value').text(str);
	}

	function updateStemmaPresentation() {
		var str = ['muu', 'sopraano', 'altto', 'tenori', 'basso'][profile.stemma];
		$('#stemma .present .value').text(str);
	}

	function updateEmailPresentation() {
		$('#email .present .value').text(profile.email);
	}

	function updatePhonePresentation() {
		var str = profile.puhelin1;
		if (profile.puhelin2)
			str += '<br>' + profile.puhelin2;
		$('#phone .present .value').html(str);
	}

	function updateAddressPresentation() {
		var str = profile.katuosoite+'<br>'+profile.postinumero+' '+profile.kunta;
		$('#address .present .value').html(str);
	}

	function updateResponsibilitiesPresentation() {
		var lines = [];
		profile.vastuut.forEach(function(resp) {
			lines.push(resp['kausi'] + ': ' + resp['viskaalius']);
		});
		var text = lines.join('<br>');
		$('#responsibilities .present .value').html(text);
	}

	function updatePresencePresentation() {
		var lines = ['liittyi ' + profile.liittynyt];
		if (profile.lopettanut != '0000-00-00') {
			lines.push('lopetti ' + profile.lopettanut);
		}
		var text = lines.join('<br>');
		$('#presence .present .value').html(text);
	}

	function updateUsernamePresentation() {
		$('#username .present .value').html(profile.ocUid || 'Ei käyttäjää');
	}
})(jQuery, OC);
