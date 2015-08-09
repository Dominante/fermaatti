/**
 * ownCloud - domisingers
 * @author Atte Keinänen / Dominante <atte.keinanen@gmail.com>
 * @copyright Atte Keinänen / Dominante 2015
 */

(function ($, OC) {
	var showingEditor = false;

	$(document).ready(function () {
		$("#editSingers").click(showOrHideEditor);

		updateSingers();
	});

	function updateSingers() {
		var singers = JSON.parse($("#singerEditor").val());

		$("#contactlist tbody").empty();

		singers.forEach(function(singer) {
			$("#contactlist tbody").append(getSingerRowHtml(singer));
		});
	}

	function showOrHideEditor() {
		showingEditor = !showingEditor;

		if (showingEditor) {
			$("#contactlist").hide();
			$("#singerEditor").show();
			$("#editSingers").html("Tallenna kuorolaislista");
		}
		else {
			updateSingers();
			$("#contactlist").show();
			$("#singerEditor").hide();
			$("#editSingers").html("Muokkaa kuorolaislistaa");
		}
	}

	function getSingerColor(singer) {
		var membership = singer.membership.toLowerCase();

		if (membership.indexOf("lopettanut") > -1 || membership.indexOf("laulajapankissa") > -1) {
			return 'rgb(180, 180, 180)';
		}
		if (singer.vocal === "Basso") {
			return 'rgb(146, 182, 85)';
		}
		else if (singer.vocal === "Tenori") {
			return 'rgb(246, 82, 85)';
		}
		else if (singer.vocal === "Altto") {
			return 'rgb(246, 182, 85)';
		}
		else if (singer.vocal === "Sopraano") {
			return 'rgb(226, 182, 130)';
		}
		else {
			return 'rgb(50, 50, 50)';
		}
	}

	function getSingerRowHtml(singer) {
		var vocalColor = getSingerColor(singer);

		//rgb(146, 182, 85)
		return '<tr class="contact" data-id="2" data-parent="2" data-backend="local" style="display: table-row;">' +
      '<td class="name thumbnail ui-draggable">' + 
      '  <input type="checkbox" id="select-2" name="id" value="1"> ' +
      '  <label for="select-2"></label>' +
      '  <div class="avatar" style="height: 32px; color: rgb(255, 255, 255); font-weight: bold; text-align: center; line-height: 32px; font-size: 17.6px; background-color: '+vocalColor+';">'+singer.name[0]+'</div>' +
      '  <a href="#1" class="nametext">'+singer.name+'</a>' +
      '  </td>' +
      '  <td>'+singer.vocal+'</td>' +
      '  <td>'+singer.membership+'</td>' +
      '  <td>'+singer.roles+'</td>' +
      '  <td class="email">' +
      '    <a href="mailto:">'+singer.email+'</a>' +
      '    <a class="icon-mail svg mailto hidden" title="Lähetä sähköpostia"></a>' +
      '  </td>' +
      '<td class="tel">'+singer.phone+'</td>' +
      '<td>'+singer.user+'</td>' +
			'</tr>';
	}
})(jQuery, OC);