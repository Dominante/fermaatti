$(document).ready(function(){
  
  function saveJSONPath() {
    var post = $('#domisingers').serialize();
    OC.msg.startSaving('#domisingers .msg');
    console.log(OC.filePath('domisingers','ajax','setjsonpath.php'));
    $.post( OC.filePath('domisingers','ajax','setjsonpath.php'), post, function(data) {
      OC.msg.finishedSaving('#domisingers .msg', data);
    });
  }

  // Initialize events
  $('#pathToDomiSingersJson').change(saveJSONPath);
});