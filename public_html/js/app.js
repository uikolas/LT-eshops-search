var app = (function($) {
    var htmlBody = $('html, body');
    var searchButton = $('#search');
    var keywordInput = $('#keyword');
    var table = $("#table");
    var container = $('.container');

    init = {
        bootstrap: function() {
            table.tablesorter();
            this.onSearchClick();
            this.onKeyPress();
        },
        onSearchClick: function() {
            var self = this;
            searchButton.click(function(e){
                self.search(e);
            });
        },
        onKeyPress: function() {
            var self = this;
            htmlBody.keypress(function(e) {
                if(e.which == 13) {
                    self.search(e);
                }
            });
        },
        search: function(e) {
            e.preventDefault();

            waitingDialog.show();

            var value = keywordInput.val();

            $.getJSON(ajaxUrl, { keyword : value}, function(response){
                console.log(response);
                waitingDialog.hide();

                htmlBody.animate({
                    scrollTop: container.offset().top
                }, 1500);

                $.each(response, function(i, array){
                    $.each(array, function(i, field){
                        var row =
                            '<tr>' +
                            '<td align="center"><img src="' + field.image + '" class="width" /></td>' +
                            '<td><a href="' + field.link + '" target="_blank">' + field.name + '</a></td>' +
                            '<td>' + field.price + '</td>' +
                            '<td>' + field.shop + '</td>' +
                            '</tr>';
                        $row = $(row);
                        table.find('tbody').append($row).trigger('addRows', [$row, false]);
                    });
                });
            });
        }
    };

    return init;
})(jQuery);