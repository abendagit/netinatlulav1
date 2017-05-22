
// Init

var position;
var numberOfSets;

$(document).ready(function () {
    position = 1;
    setSetsPrices(false);
    createSelectSets();
    createSelectAmuta();
    // createSelectDelivery();
    createSelectArea();
    createSelectPickup();
//     $('.delivery').change(function () {
//        onDeliveryChange();
//    });
});

function setSetsPrices(withYemeniEtrog) {
    var prices = withYemeniEtrog ? setsPrices['עם אתרוג תימני'].price : setsPrices['רגיל'].price;
    numberOfSets = prices.length;
    $.each(prices, function (index, value) {
        $('#sets_amount_' + index).text(value);
    });
    onQuantityChange();
}

function createSelectSets() {
	$('.selectSets').each(function() {
		for (var i = 0; i <= maxNumOfSets; i++) {
			 $('<option/>').text(i).appendTo($(this));
		}		
	});
}

function createSelectAmuta() {
	$.each(amutaLogos, function(index, value) {
		row = '<tr>';
		$.each(value, function(key, value) {
			row += '<td class=amuta_td><img class="amuta_img" onClick="onAmutaSelected($(this))" src="' + value + '" title= "' + key + '" /></td>';
		})
		row += '</tr>';
		$('#selectAmuta').append(row);
	});
}

function createSelectDelivery() {
	$('.deliveryTextStyle').each(function () {
		$(this).text(deliveryTexts[$(this).attr('id')]);
	});
	$('.deliveryCommentStyle').each(function () {
		$(this).text(deliveryTexts[$(this).attr('id')]);
	});
	onDeliveryChange();
}

function createSelectArea() {
    $('<option/>').text(textForSelectArea).appendTo($('#selectArea'));
	$.each(pickupLocations, function(key, value) {
	    $('<option/>').text(key).appendTo($('#selectArea'));
	});
	
	$('#selectArea').change(createSelectPickup);
}

function createSelectPickup() {
	$('#selectPickup').empty();
    if ($('#selectArea').val() == textForSelectArea) {
        return;
    }
    $.each(pickupLocations[$('#selectArea').val()], function (key, value) {
        if (value[6].trim() === "פתוחה") {
            $('<option/>').text(key).appendTo($('#selectPickup'));
        }
    });
}

// Navigation

function onPrev() {
    hideAndShow(-1);		
}

function onNext() {
	if (position == 1) {	
		if ($('#total').text() == 0) {
			alert(textToShowIfNoSetsWhereChosen);
			return;
		}	
	}
	
	if (position == 2) {
		if ($('.amuta_img_selected').length == 0) {
			alert(textToShowIfNoAmutaWasChosen);
			return;
		}
        if (isOnlyDonationSet()) {
            // No need to pick pickup location
            hideAndShow(2);
            return;
        }
	}
	
	if (position == 3) {
		if ($('#selectPickup').text() == '') {
			alert(textToShowIfNoPickupWasChosen);
			return;
		}
	}
    hideAndShow(1);	
}

function hideAndShow(i) {
	hide('part' + position); 

	position += i;
	show('part' + position);
    show('prev');
    show('next');
    hide('PayPal');
    if (position == 1) {
        hide('prev');
    }
    if (position == 4) {
		hide('next');
		show('PayPal');
		updateShoppingCart();        
    }
}

function hide(id) {
	$('#' + id).hide();
}

function show(id) {
	$('#' + id).show();
}

function hideClass(name) {
	$('.' + name).hide();
}

function showClass(name) {
	$('.' + name).show();
}

// Actions

function onQuantityChange() {
	var sum = 0;
	for (var i = 0; i < numberOfSets; ++i) {
		var t = $('#sets_amount_' + i).text() * $('#sets_quantity_' + i).val();
		$('#total' + i).text(t);
		sum += t;
	}
	$('#total').text(sum);
}

function onAmutaSelected(selectedObject) {
	$('.amuta_img_selected').removeClass('amuta_img_selected');
	selectedObject.addClass('amuta_img_selected');
}

function onDeliveryChange() {
	if ($('.delivery:checked').val() == 1) {
		showClass('choosePickup');
	}
	if ($('.delivery:checked').val() == 2) {
		hideClass('choosePickup');
	}
}

function isOnlyDonationSet() {
    for (var i = 0; i < numberOfSets - 1; ++i) {
        if ($('#sets_quantity_' + i).val() > 0) {
            return false;
        }
    }
    return true;
}

// Details + shopping cart

function validateForm() {
    var res = true;
    $.each(["first_name", "last_name", "night_phone_b", "email"], function(index, value) {
        if (!updateDetail(value))
        {
            if (res) {
                alert(textToShowIfDetailsAreMissing);                
            }
            res = false;
        }
    });
    $("#custom").val($("#night_phone_b").val());
    return res;
}

function updateDetail(id) {
    $('[name=' + id +']').val($('#' + id).val());
    return $('#' + id).val() != "";
}

function updateShoppingCart() {
    $('.cartItems').remove();
    var itemIndex = 1;

    // Sets
	for (var i = 0; i < numberOfSets; ++i) {
		var q = document.getElementById('sets_quantity_' + i).selectedIndex;
		if (q > 0) {
            var name = $('#sets_item_name_' + i).text();
            var amount = $('#sets_amount_' + i).text();
            addItemToPayPal(itemIndex, name, amount, q);
			itemIndex++;
		}
	}

//    if ($('#yemeni_etrog').is(':checked')) {
//        addItemToPayPal(itemIndex, textToShowInPaypalForYemeniEtrog, 0, 1);
//        itemIndex++;        
//    }

    // Amuta
	$("#image_url").val($('.amuta_img_selected')[0].src.replace(".jpg", "p.jpg"));
    var textToShow = textToShowInPaypalForAmuta + $('.amuta_img_selected')[0].title;
    addItemToPayPal(itemIndex, textToShow, 0, 1);
    itemIndex++;

    // Delivery
    if (isOnlyDonationSet()) {
        return;
    }

    // Delivery
//    addItemToPayPal(itemIndex, deliveryTexts['textForPickup'], 0, 1);
    area = $('#selectArea').val();
    pickup = $('#selectPickup').val();
    details = pickupLocations[area][pickup];
    pointOfPickup = pickup + ' אצל - ' + details[2] + ', בכתובת: ' + details[1] + ', בטלפון: ' + details[3];
//    addDetailsToPayPalItem(itemIndex, "נק' איסוף: ", pointOfPickup);
    addItemToPayPal(itemIndex, pointOfPickup, 0, 1);
    itemIndex++;

    /**
    // Delivery
    textToShow = $($('.delivery:checked').parent().children()[1]).text();
    amount = ($('.delivery:checked').val() == 2) ? priceOfDelivery : 0;
    addItemToPayPal(itemIndex, textToShow, amount, 1);
    if ($('.delivery:checked').val() == 1) {
        area = $('#selectArea').val();
        pickup = $('#selectPickup').val();
        details = pickupLocations[area][pickup];
        pointOfPickup = pickup + ' אצל - ' + details[2] + ', בכתובת: ' + details[1] + ', בטלפון: ' + details[3];
    	addDetailsToPayPalItem(itemIndex, "נק' איסוף: ", pointOfPickup);
    }
    itemIndex++;
    */
}

function addItemToPayPal(i, name, amount, quantity) {
    addInputToPayPal("item_name_" + i, name);
    addInputToPayPal("amount_" + i, amount);
    addInputToPayPal("quantity_" + i, quantity);
}

function addDetailsToPayPalItem(i, title, details) {
    addInputToPayPal("on0_" + i, title);
    addInputToPayPal("os0_" + i, details);
}

function addInputToPayPal(id, value) {
    $("#PayPal").append('<input class="cartItems" type="hidden" id=' + id + ' name=' + id + ' value="' + value + '">');
}
