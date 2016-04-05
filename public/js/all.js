/**
 * Created by marcintofilski on 03.04.2016.
 */
$(function(){
    //album pictures handle

    $('#importElements li').on('click', function(event) {
        var $this = $(this);
        if (!$(event.target).is('a.fullImage i')) {
            $this.toggleClass('selected');
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop("checked", !checkbox.prop("checked"));
        }
    });
    $('#selectAllPhotos').on('click', function(event){
        event.preventDefault();
        $(this).hide();
        $('#deselectAllPhotos').show();
        $('#importElements li').each(function(){
            if(! $(this).hasClass('selected'))
                $(this).trigger('click');
        });
    });
    $('#deselectAllPhotos').on('click', function(event){
        event.preventDefault();
        $(this).hide();
        $('#selectAllPhotos').show();
        $('#importElements li').each(function(){
            if($(this).hasClass('selected'))
                $(this).trigger('click');
        });
    });
});
//# sourceMappingURL=all.js.map
