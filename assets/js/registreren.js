$("#waarschuwingWachtwoorden").hide();

function controleerWachtwoorden () {
  var wachtwoord = $("#wachtwoord").val();
  var wachtwoordBevestig = $("#wachtwoordBevestig").val();

  if (wachtwoord == wachtwoordBevestig)
  {
    $("#waarschuwingWachtwoorden").hide();
  } else {
    $("#waarschuwingWachtwoorden").show();
  }
}

$( document ).ready( function() {
  $("#wachtwoordBevestig").keyup(controleerWachtwoorden);
})
