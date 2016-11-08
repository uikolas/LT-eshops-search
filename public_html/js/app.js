new Vue({
    el: '#app',
    data: {
        keyword: '',
        sortDescending: false,
        items: []
    },
    methods: {
        search: function () {
            var self = this;
            waitingDialog.show();

            this.$http.get(ajaxUrl, { params: { keyword : this.keyword}}).then(function (response) {
                var array = response.body;
                self.items = [];

                array.forEach(function (items) {
                    items.forEach(function (item) {
                        self.items.push(item);
                    })
                });

                waitingDialog.hide();
                self.scrollTo();

            }, function (response) {
                waitingDialog.hide();
                console.log(response)
            });
        },
        sortBy: function () {
            this.sortDescending = !this.sortDescending;

            var sorting = this.sortDescending;

            this.items.sort(function(a, b) {
                return sorting ? parseFloat(b.price) - parseFloat(a.price) : parseFloat(a.price) - parseFloat(b.price);
            });
        },
        scrollTo: function () {
            $('html, body').animate({
                scrollTop: $('.container').offset().top
            }, 1500);
        }
    }
})