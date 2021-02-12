$('#profile-image-upload').on('change', function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#profile-image-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]); // convert to base64 string
}});

$('#cover-image-upload').on('change', function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#cover-image-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]); // convert to base64 string
      }
});
