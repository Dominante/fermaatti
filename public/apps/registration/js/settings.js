/*global $, OC, document*/
/*eslint quotes: [2, "single"], curly: 2*/

$(document).ready(function() {
	'use strict';

	function generateNewUrl() {
		$.post(OC.generateUrl('/apps/registration/settings/newAuthHash'), {}, function(result) {
			$('#registration_url').text($('#registration_url').text().replace(/auth=.*/, 'auth=' + result.data.hash));
		});
	}

	function saveSettings() {
		var post = $('#registration').serialize();
		$.post(OC.generateUrl('/apps/registration/settings'), post);
	}

	$('#registered_user_group').change(saveSettings);
	$('#allowed_domains').change(saveSettings);
	$('#allowed_domains').change(saveSettings);
	$('#registration').keypress(function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
		}
	});
	$('#generate_new_url').click(function(event) {
		event.preventDefault();
		generateNewUrl();
	});
});
