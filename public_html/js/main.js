$(document).ready(function(){
    $("#table").tablesorter();
    $('#search').click(function(e){
        searcher(e);
    });
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        searcher(e);
    }
});

function searcher(e) {
    e.preventDefault();
    //$('#table tbody tr').remove();
    $.tablesorter.clearTableBody( $("#table") );
    waitingDialog.show();

    var value = $('#keyword').val();

    $.getJSON(ajaxUrl, { keyword : value}, function(response){
        console.log(response);
        waitingDialog.hide();

        $('html, body').animate({
            scrollTop: $('.container').offset().top
        }, 1500);

        $.each(response, function(i, array){
            $.each(array, function(i, field){
                var row = '<tr>' +
                    '<td align="center"><img src="' + field.image + '" class="width" /></td>' +
                    '<td><a href="' + field.link + '" target="_blank">' + field.name + '</a></td>' +
                    '<td>' + field.price + '</td>' +
                    '<td>' + field.shop + '</td>' +
                    '</tr>';
                $row = $(row);
                $('#table tbody').append($row).trigger('addRows', [$row, false]);
            });
        });
    });
}

var waitingDialog = waitingDialog || (function ($) {
    'use strict';

    // Creating modal dialog's DOM
    var $dialog = $(
        '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
        '<div class="modal-dialog modal-m">' +
        '<div class="modal-content">' +
        '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
        '<div class="modal-body">' +
        '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
        '</div>' +
        '</div></div></div>');

    return {
        /**
         * Opens our dialog
         * @param message Custom message
         * @param options Custom options:
         * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
         * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
         */
        show: function (message, options) {
            // Assigning defaults
            if (typeof options === 'undefined') {
                options = {};
            }
            if (typeof message === 'undefined') {
                message = 'Ieškoma';
            }
            var settings = $.extend({
                dialogSize: 'm',
                progressType: '',
                onHide: null // This callback runs after the dialog was hidden
            }, options);

            // Configuring dialog
            $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
            $dialog.find('.progress-bar').attr('class', 'progress-bar');
            if (settings.progressType) {
                $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
            }
            $dialog.find('h3').text(message);
            // Adding callbacks
            if (typeof settings.onHide === 'function') {
                $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                    settings.onHide.call($dialog);
                });
            }
            // Opening dialog
            $dialog.modal();
        },
        /**
         * Closes dialog
         */
        hide: function () {
            $dialog.modal('hide');
        }
    };

})(jQuery);