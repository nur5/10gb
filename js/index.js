function sortWineCat(wine) {
	if ($('#cat').val() == 'All') return true;
	else if ($('#cat').val() == wine.category.category && $('#cat').val() == 'Rose') return true;
	else if ($('#cat').val() == wine.category.category) return true;
	else return false;
}
function sortWineSubCat(wine) {
	if ($('#sub').val() == 'All') return true;
	else if($('#cat').val() == 'Rose') return true;
	else if($('#sub').val() == wine.category.subcategory) return true;
	else return false;
}
var lines = null;
function printWines(wines) {
	if (lines !== null) {
		var kist = "";
		wines.filter(sortWineCat).filter(sortWineSubCat).forEach(function(w) {
			kist += '<div class="product-card"><div class="product-image">';
			kist += '<img height="256" width="107" src="' + w.img + '" alt="' + w.name + '" href="/10gb/wine/'+w.id+'">';
			kist += '</div>';
			kist += '<div class="product-info">'
			kist += '<p><a href="/10gb/wine/' + w.id + '">' + w.name + '</a></p>';
			if (w.category.category != 'Rose') {
				kist += '<h5>' + w.category.category + ' / ' + w.category.subcategory + '</h5>';
			} else {
				kist += '<h5>' + w.category.category + '</h5>';
			}
			kist += '<h6>Bottle: £' + w.pricebottle + '</h6>';
			kist += '<h6>Case: £' + w.pricecase + '</h6>';
			kist += '<select id="wine_corb' + w.id + '"><option value="B">Bottles</option><option value="C">Cases</option></select>';
			kist += '<input type="number" placeholder="Quantity" id="wine_quantity' + w.id + '"/>';
			kist += '<p id="wine_sts' + w.id + '"></p>';
			kist += '<div class="btn-group">';
			kist += '<button onclick="addToBasket(' + w.id + ');">Add to Basket</button></div></div></div>';
		});
		$('#wines').html(kist);
	}
}
function catSelection(sel) {
	if (sel.value == 'Red') {
		$('#sub').show();
		$('#sub_dry').hide();
		$('#sub_sweet').hide();
		$('#sub_light').show();
		$('#sub_full').show();
	} else if (sel.value == 'White') {
		$('#sub').show();
		$('#sub_dry').show();
		$('#sub_sweet').show();
		$('#sub_light').hide();
		$('#sub_full').hide();
	} else if (sel.value == 'Rose') {
		$('#sub').hide();
	} else if (sel.value == 'All') {
		$('#sub').show();
		$('#sub_dry').show();
		$('#sub_sweet').show();
		$('#sub_light').show();
		$('#sub_full').show();
	}

	printWines(lines);

}

function getWines() {
	catSelection($('#cat'));
	$.ajax({
		url : '/10gb/api/wines',
		method : 'GET',
		contentType : 'json',
		success : function(arr) {
			console.log(arr);
			if (Array.isArray(arr)) {
				lines = arr;
				printWines(arr);
			}
		},
		error : function(err) {
			console.log(err);
		}
	});
}
$(document).ready(getWines);
lawgin(function() {});