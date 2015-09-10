/**
 * ownCloud - domisingers
 * @author Atte Keinänen / Dominante <atte.keinanen@gmail.com>
 * @copyright Atte Keinänen / Dominante 2015
 */

function sortByPart(member1, member2) {
    if (member1.stemma != member2.stemma) {
        return member1.stemma > member2.stemma? 1 : -1;
    } else {
        return member1.sukunimi > member2.sukunimi? 1 : -1;
    }
}

(function ($, OC) {
    var members = [];
    var baseUrl = OC.generateUrl('/apps/domisingers');
    var ready = false;
    var showFormerMembers = false;

    loadMembers(function() { if (ready) updateList(); })
    
	$(document).ready(function () {
        ready = true;
        if (members.length > 0) updateList();
        
        $('#checkbox').attr('checked', false);              
        $('#checkbox').change(function() {
            showFormerMembers = !showFormerMembers;
            updateList();
        });
        
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
            console.log('fail');
        });
            
    }

	function updateList() {
        var tableElement =  $("#membertable");
        
        tableElement.empty();

		members.forEach(function(member) {
            if (showFormerMembers || member.lopettanut == '0000-00-00') {
                tableElement.append(getSingerRowHtml(member));
            }
		});
	}

    function getSingerRowHtml(member) {
        var stemmat = ['muu', 'sopraano', 'altto', 'tenori', 'basso'];
        
        var fields = [
            '<b>' + member.etunimi + ' ' + member.sukunimi + '</b>',
            stemmat[member.stemma],
            member.puhelin,
            member.email,
            member.vastuut.join(', ')
            ];
            
        return '<tr><td>' + fields.join('</td><td>') + '</td></tr>';
	}
})(jQuery, OC);