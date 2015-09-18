/**
* ownCloud - domisingers
*
* This file is licensed under the Affero General Public License version 3 or
* later. See the COPYING file.
*
* @author Tuukka Verho / Dominante <tuukka.verho@aalto.fi>
* @copyright Tuukka Verho / Dominante 2015
*/

function sortByPart(member1, member2) {
	if (member1.stemma != member2.stemma) {
		return member1.stemma > member2.stemma? 1 : -1;
	} else {
		return member1.sukunimi > member2.sukunimi? 1 : -1;
	}
}

(function ($, OC) {
	var baseUrl = OC.generateUrl('/apps/domisingers');
	var documentReady = false;
	var members;
	var showFormerMembers = false;

	loadMembers(function() {
		if (documentReady) init();
	})
	
	$(document).ready(function () {
		documentReady = true;
		if (members) init();
	});
	
	function loadMembers(callback) {
		$.ajax({
			url: baseUrl + '/list/all',
			type: 'GET',
			contentType: 'application/json'
		}).done(function (response) {
			members = response;
			members.sort(sortByPart);
			callback();
		}).fail(function (response, code) {
			console.log('Failed to fetch member list');
		});
	}
	
	function init() {
		$('#checkbox').attr('checked', showFormerMembers);              
		$('#checkbox').change(function() {
			showFormerMembers = $(this).attr('checked');
			updateList();
		});
		
		$('#input_liittyi').datepicker({dateFormat: 'yy-mm-dd', minDate: null});
		
		$('button.newprofile').click(function() { 
			newProfile();
		});
		updateList();
	}

	function updateList() {
		var tableElement =  $("#membertable");
		
		tableElement.empty();

		members.forEach(function(member) {
			if (showFormerMembers || member.lopettanut == '0000-00-00') {
				tableElement.append(getMemberRowHtml(member));
			}
		});
	}

	function getMemberRowHtml(member) {
		var stemmat = ['muu', 'sopraano', 'altto', 'tenori', 'basso'];
		detailsUrl = baseUrl + '/profile/display/' + member.personId;
		
		var fields = [
			'<a href='+detailsUrl+'>' + member.etunimi + ' ' + member.sukunimi + '</a>',
			stemmat[member.stemma],
			member.puhelin,
			member.email,
			member.vastuut.join(', ')
			];
			
		return '<tr><td>' + fields.join('</td><td>') + '</td></tr>';
	}
	
	function newProfile() {
		var params = {
			etunimi: $('#input_etunimi').val().trim(),
			sukunimi: $('#input_sukunimi').val().trim(),
			stemma: $('#select_stemma').val(),
			liittynyt: $('#input_liittyi').val()
		};
		
		if (!params['etunimi'] || !params['sukunimi'] || !params['liittynyt']) {
			console.error('Values missing: ' + params);
			return;
		}
		
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
	}
		
})(jQuery, OC);