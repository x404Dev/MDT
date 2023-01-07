//ADD FUNC
$(document).ready(function() {
    $(".item-box").click(function() {

        var id = $(this).find('.charge-id').val();
        var title = $(this).find('.charge-title').html();
        var money = $(this).find('#charge-cout').html();
        var mois = $(this).find('#charge-mois').html();

        if ($(".charge-list").find('#charge-' + id).length > 0) {

            var charges = [];
            var price = 0;
            var moisT = 0

            var charge = $(".charge-list").find('#charge-' + id)
            var charge2 = $(".charge-list-2").find('#charge-a' + id)
            var amount = parseInt(charge.find('.charge-amt').val()) + 1
            charge.find('#charge-amount').html(amount)
            charge.find(".charge-amt").val(amount)
            charge2.find("#charge-amount").html(amount)

            charge.find('.charge-cout').html(money * amount + '$')
            charge.find('.charge-mois').html(mois * amount)

            $(".charge").each(function(index) {
                var cAmount = $(this).find('.charge-amt').val()
                charges.push($(this).find(".charge-id").val() + 'x' + (cAmount));
                price += parseInt($(this).find('.charge-cout').html());
                moisT += parseInt($(this).find(".charge-mois").html());
            });



            $(".charges-list").val(charges.join(','));
            $(".cout-total").html(price);
            $(".mois-total").html(moisT);

        } else {
            $(".charge-list").append('<tr class="charge" id="charge-' + id + '"><td>' + title + ' x<span id="charge-amount">1</span><button class="charge-minus hoveru" style="border: none; background-color: transparent; color: red">[-]</button></td><td class="text-right charge-cout">' + money + '$</td><td class="text-right charge-mois">' + mois + '</td><input type="hidden" class="charge-id" value="' + id + '"><input type="hidden" class="charge-amt" value="1"></tr>');
            $(".charge-list-2").append('<div id="charge-a' + id + '"><a style="display: block">' + title + ' x<span id="charge-amount">1</span></a><hr></div>')
            var charges = [];
            var price = 0;
            var moisT = 0

            $(".charge").each(function(index) {
                var cAmount = $(this).find('.charge-amt').val()
                charges.push($(this).find(".charge-id").val() + 'x' + (cAmount));
                price += parseInt($(this).find('.charge-cout').html());
                moisT += parseInt($(this).find(".charge-mois").html());
            });

            $(".charges-list").val(charges.join(','));
            $(".cout-total").html(price);
            $(".mois-total").html(moisT);
        }
    });

    $(".charge-list").on("click", ".charge-minus", function(evt) {

        var charge = $(this).closest('.charge');
        var amount = parseInt(charge.find('.charge-amt').val())

        var id = charge.find(".charge-id").val();
        if (amount == 1) {

            $("#charge-" + id).remove();
            $("#charge-a" + id).remove();

            var charges = [];
            var price = 0;
            var moisT = 0;

            $(".charge").each(function(index) {
                var cAmount = $(this).find('.charge-amt').val()
                charges.push($(this).find(".charge-id").val() + 'x' + (cAmount));
                price += parseInt($(this).find(".item-money").html());
                moisT += parseInt($(this).find(".charge-mois").html());
            });

            $(".charges-list").val(charges.join(','));
            $(".cout-total").html(price);
            $(".mois-total").html(moisT);

        } else {

            var charges = [];
            var price = 0;
            var moisT = 0;
            var money = parseInt(charge.find('.charge-cout').html().replace('$', '')) / amount
            var mois = parseInt(charge.find('.charge-mois').html()) / amount

            charge.find('.charge-cout').html(money * (amount - 1) + '$')
            charge.find('.charge-mois').html(mois * (amount - 1))

            charge.find(".charge-amt").val(amount - 1)

            var charge2 = $(".charge-list-2").find('#charge-a' + id)
            $(".charge").each(function(index) {
                var cAmount = $(this).find('.charge-amt').val()
                charges.push($(this).find(".charge-id").val() + 'x' + (cAmount));
                price += parseInt($(this).find('.charge-cout').html());
                moisT += parseInt($(this).find(".charge-mois").html());
            });

            $(".charges-list").val(charges.join(','));

            charge.find('#charge-amount').html(amount - 1)
            charge2.find("#charge-amount").html(amount - 1)

            $(".cout-total").html(price);
            $(".mois-total").html(moisT);
        }
    });
});

$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})