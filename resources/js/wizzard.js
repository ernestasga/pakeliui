
require('jquery-validation');
require('jquery.steps');

$(document).ready(function() {

    $('#wizard').steps({
        onChange: function (currentIndex, newIndex, stepDirection) {
            if ($('#create-form').valid()) {
                return true;
            } else {
                return false;
            }
        },
        onFinish: function () {
            $('#create-form').submit();
         }
      });

    $('.seats_slider').on('change', function () {
        $(this).prev('h6').text(this.value);
    });
});
