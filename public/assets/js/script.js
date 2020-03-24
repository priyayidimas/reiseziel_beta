$.fn.hasAttr = function(name) {
    return this.attr(name) !== undefined;
   };


$(document).ready(function () {
    Materialize.updateTextFields();
    // Sidenav & Menu
    $('.btn-slide').sideNav({
        menuWidth: 240,
    });
    $('.button-collapse').sideNav({
        menuWidth: 240, // Default is 300
    });
    $('.dropdown-button').dropdown({
        belowOrigin: true
    });

    // Card Alert Close Button
    $("#card-alert .close").click(function() {
        $(this).closest('#card-alert').fadeOut('slow');
      });
    



});