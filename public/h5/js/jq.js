//详情页选项卡切换
$(function () {
    $('#main #nav-list li').click(function () {
        $(this).addClass('nav-list').siblings().removeClass('nav-list');
        $('#main>div:eq(' + $(this).index() + ')').show().siblings().not("#nav-list").hide()
    })
});
