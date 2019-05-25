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

    data +="<td><article class='col-xs-12'><textarea class='form-control' id='countryname_"+i+"' name='countryname[]' rows='3'></textarea></article><article class='col-xs-3 form-group'><input class='form-control' type='hidden' id='country_no_"+i+"' name='country_no[]'/></article><article class='col-xs-3 form-group'><input class='form-control' type='hidden' id='phone_code_"+i+"' name='phone_code[]' readonly='readonly'/></article><article class='col-xs-3 form-group'><input class='form-control' type='hidden' id='country_code_"+i+"' name='country_code[]' readonly='readonly'/></article><article class='col-xs-3 form-group'><input class='form-control' type='hidden' id='idm_prod"+i+"' required name='idm_prod[]' value='' readonly='readonly'/></article></td><td><input type='text' class='form-control' required name='cantidad[]'></td><td><textarea id='observacion"+i+"' name='observacion[]' rows='5' class='form-control'></textarea><input class='form-control' type='hidden' id='estado"+i+"' required name='estado[]' value='1'/></td></tr>";

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
  			url : 'procedimientos/ajax.php',
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
    $('#idm_prod'+id[1]).val(m);
		$('#country_no_'+id[1]).val(names[1]);
		$('#phone_code_'+id[1]).val(names[2]);
		$('#country_code_'+id[1]).val(names[3]);
	}
  });

  $('#profesional'+i).autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'procedimientos/profesional.php',
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
  			url : 'procedimientos/ajax.php',
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
  			url : 'procedimientos/ajax.php',
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
			url : 'procedimientos/ajax.php',
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
  			url : 'procedimientos/ajax.php',
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
  			url : 'procedimientos/ajax.php',
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
  			url : 'procedimientos/ajax.php',
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
