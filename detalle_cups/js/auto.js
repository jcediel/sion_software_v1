/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */

 $(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false);
	check();
});
var i=$('table tr').length;

$(".addmore").on('click',function(){
	count=$('table tr').length;

    var data="<tr><td><input type='checkbox' class='case'/></td><td><span id='snum"+i+"'>"+count+".</span></td>";

    data +="<td class='col-xs-5'><article class='col-xs-12'><textarea class='form-control' id='countryname_"+i+"' name='countryname[]' rows='3'></textarea></article><article class='col-xs-3 form-group'><input class='form-control' type='text' id='phone_code_"+i+"' name='phone_code[]'/></article><article class='col-xs-3 form-group'><input class='form-control' type='text' id='country_code_"+i+"' name='country_code[]'/></article></td><td class='col-xs-6'><article class='col-xs-3'><label>Cantidad:</label><input class='form-control' type='number' id='cantidad"+i+"' name='cantidad[]'/></article><article class='col-xs-3'><label >CUPS</label><input class='form-control' type='text' id='country_no_"+i+"' name='country_no[]'/></article><article class='col-xs-3'><label >ID AUT:</label><input class='form-control' type='text' id='iddautori"+i+"' required name='iddautori[]' value='' readonly='readonly'/></article><article class='col-xs-5'><label>Intervalo:</label><select class='form-control' id='intervalo"+i+"' required name='intervalo[]'><option value=''></option><option value='60'>60 MINUTOS</option><option value='40'>40 MINUTOS</option><option value='30'>30 MINUTOS</option><option value='20'>20 MINUTOS</option><option value='15'>15 MINUTOS</option><option value='10'>10 MINUTOS</option><option value='0'>NO APLICA</option></select><input type='hidden' id='estado"+i+"' name='estado[]' value='Solicitado'></article></td></tr>";

	$('table').append(data);
	row = i ;
  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
var m = getParameterByName('idm');
	$('#countryname_'+i).autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'detalle_cups/ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'country_table',
			   row_num : row
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[0],
						value: code[0],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		id_arr = $(this).attr('id');
  		id = id_arr.split("_");
    $('#iddautori'+id[1]).val(m);
		$('#country_no_'+id[1]).val(names[1]);
		$('#phone_code_'+id[1]).val(names[2]);
		$('#country_code_'+id[1]).val(names[3]);
	}
  });

  $('#country_code_'+i).autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'detalle_cups/ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'country_table',
			   row_num : row
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[3],
						value: code[3],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
        id_arr = $(this).attr('id');
  		id = id_arr.split("_");
		$('#country_no_'+id[1]).val(names[1]);
		$('#phone_code_'+id[1]).val(names[2]);
		$('#countryname_'+id[1]).val(names[0]);
	}
  });
  $('#phone_code_'+i).autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'detalle_cups/ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'country_table',
			   row_num : row
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[2],
						value: code[2],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		id_arr = $(this).attr('id');
  		id = id_arr.split("_");
		$('#country_no_'+id[1]).val(names[1]);
		$('#country_code_'+id[1]).val(names[3]);
		$('#countryname_'+id[1]).val(names[0]);
	}
  });
  $('#country_no_'+i).autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'detalle_cups/ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'country_table',
			   row_num : row
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[1],
						value: code[1],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		id_arr = $(this).attr('id');
  		id = id_arr.split("_");
		$('#country_code_'+id[1]).val(names[3]);
		$('#phone_code_'+id[1]).val(names[2]);
		$('#countryname_'+id[1]).val(names[0]);
	}
  });

	i++;
});

function select_all() {
	$('input[class=case]:checkbox').each(function(){
		if($('input[class=check_all]:checkbox:checked').length == 0){
			$(this).prop("checked", false);
		} else {
			$(this).prop("checked", true);
		}
	});
}

function check(){
	obj=$('table tr').find('span');
	$.each( obj, function( key, value ) {
		id=value.id;
		$('#'+id).html(key+1);
	});
}

$('#countryname_1').autocomplete({
	source: function( request, response ) {
		$.ajax({
			url : 'detalle_cups/ajax.php',
			dataType: "json",
			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'country_table',
			   row_num : 1
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[0],
						value: code[0],
						data : item
					}
				}));
			}
		});
	},
	autoFocus: true,
	minLength: 0,
	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		$('#country_no_1').val(names[1]);
		$('#phone_code_1').val(names[2]);
		$('#country_code_1').val(names[3]);
	}
});

$('#country_code_1').autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'detalle_cups/ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'country_code',
			   row_num : 1
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[3],
						value: code[3],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		$('#country_no_1').val(names[1]);
		$('#phone_code_1').val(names[2]);
		$('#countryname_1').val(names[0]);
	},
	open: function() {
		$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	},
	close: function() {
		$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	}
 });

 $('#country_no_1').autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'detalle_cups/ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'country_no',
			   row_num : 1
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[1],
						value: code[1],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		$('#country_code_1 ').val(names[3]);
		$('#phone_code_1').val(names[2]);
		$('#countryname_1').val(names[0]);
	},
	open: function() {
		$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	},
	close: function() {
		$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	}
});

$('#phone_code_1').autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'detalle_cups/ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'phone_code',
			   row_num : 1
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[2],
						value: code[2],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		$('#country_code_1 ').val(names[3]);
		$('#country_no_1 ').val(names[1]);
		$('#countryname_1').val(names[0]);
	},
	open: function() {
		$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	},
	close: function() {
		$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	}
});
