//ADD FUNC
$(".item-box").click(function() {

    var id = $(this).find('.item-id').val();
    var title = $(this).find('.item-title').html();
    var money = $(this).find('.item-money').html();
    if ($(".item-list").find('#' + id).length > 0) {
        $("#" + id).remove();
        $("#a" + id).remove();

        var items = "";
        var price = 0;

        $(".item").each(function(index) {
            items = items + ',' + $(this).find(".item-id").val();
            price += parseInt($(this).find(".item-money").html());
        });

        $(".items-cause").val(items);
        $(".items-total").html(price + "$");

    } else {
        $(".item-list").append('<tr class="item" id="' + id + '"><td>' + title + '</td><td class="text-right item-money">' + money + '$</td><input type="hidden" class="item-id" value="' + id + '"></tr>');
        $(".item-list-2").append('<div id="a' + id + '"><a style="display: block">' + title + '</a><hr></div>')
        var items = "";
        var price = 0;

        $(".item").each(function(index) {
            items = items + ',' + $(this).find(".item-id").val();
            price += parseInt($(this).find(".item-money").html());
        });

        $(".items-cause").val(items);
        $(".items-total").html(price + "$");
    }
});

$("#btn-del-rap").click(function() {

    $("#delete-rapport").submit();

});

$("#btn-del-dos").click(function() {

    $("#delete-dossier").submit();

});

$("#btn-del-com").click(function() {

    $("#delete-coma").submit();

});

$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})