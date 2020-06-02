(function($) {
    $(function() {
        $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
            console.log("click");
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('div.products__tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
        });
    });
})(jQuery);