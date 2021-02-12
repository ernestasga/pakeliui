$('#create-from').on('change', function(){
    var from = this.value
    $('#listing-preview-from').html('<i class="fa fa-map-marker-alt"> '+from);
});
$('#create-to').on('change', function(){
    var to = this.value
    $('#listing-preview-to').html('<i class="fa fa-map-marker-alt"> '+to);
});

$('#listing-vip-0').on('change', function(){
    clearPreviewClass();
});
$('#listing-vip-1').on('change', function(){
    clearPreviewClass();
    $('#listing-preview-card').addClass('listing-vip-1')
});
$('#listing-vip-2').on('change', function(){
    clearPreviewClass();
    $('#listing-preview-card').addClass('listing-vip-2')
});
$('#listing-vip-3').on('change', function(){
    clearPreviewClass();
    $('#listing-preview-card').addClass('listing-vip-3')
});
$('#listing-vip-4').on('change', function(){
    clearPreviewClass();
    $('#listing-preview-card').addClass('listing-vip-4')
});

function clearPreviewClass(){
    $('#listing-preview-card').attr('class', 'card mb-4 pl-4 pt-2 listing')
}
