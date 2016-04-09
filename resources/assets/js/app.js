/**
 * Created by marcintofilski on 03.04.2016.
 */
$(function(){
    //album pictures handle

    $('#importElements li, #photoList li').on('click', function(event) {
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

    $('#imageDescription').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var image_link = button.data('link');
        var createdTime = button.data('created-time');
        var importTime = button.data('import-time');
        var updatedTime = button.data('updated-time');
        var albumName = button.data('album-name');

        var modal = $(this);
        modal.find('#imageFullModal').attr('src',image_link);
        modal.find('#createdTimeModal').html(createdTime);
        modal.find('#importedTimeModal').html(importTime);
        modal.find('#updatedTimeModal').html(updatedTime);
        modal.find('#albumNameModal').html(albumName);
    })
});