
 $(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false);
	check();
});

var i=$('table tr').length;

$(".addmore").on('click',function(){
	count=$('table tr').length;

    var data="<tr><td><input type='checkbox' class='case'/></td><td><span id='snum"+i+"'>"+count+".</span></td>";
    data +="<td><input class='form-control' type='text' id='idmfmedhosp"+i+"' name='idmfmedhosp[]' value='' readonly='readonly' /></td> <td><input class='form-control' type='text'  name='countryname[]'/></td><td><select class='form-control' id='phone_code_"+i+"' name='phone_code[]'><option value='0'></option><option value='intravenosa'>intravenosa</option><option value='oral'>oral</option><option value='intramuscular'>Intramuscular</option><option value='sublingual'>sublingual</option><option value='topica'>Tópica</option><option value='transdermica'>Transdérmica</option><option value='oftalmica'>Oftálmica</option><option value='otica'>Ótica</option><option value='intranasal'>Intranasal</option><option value='inhalatoria'>Inhalatoria</option><option value='rectal'>Rectal</option><option value='vaginal'>Vaginal</option><option value='subcutanea'>Subcutánea</option></select></td><td><select class='form-control' id='country_code_1' name='country_code[]' required=''><option value=''></option><option value='24'>24 Horas</option><option value='12'>12 Horas</option><option value='8'>8 Horas</option><option value='6'>6 Horas</option><option value='4'>4 Horas</option></select></td><td><input class='form-control' type='number' id='dosis1"+i+"' name='dosis1[]' value='0'/><input class='form-control' type='hidden' id='estadomed' name='estado[]' value='Solicitado'/></td><td><input class='form-control' type='number' id='dosis2"+i+"' name='dosis2[]' value='0'/></td><td><input class='form-control' type='number' id='dosis3"+i+"' name='dosis3[]' value='0'/></td><td><input class='form-control' type='number' id='dosis4"+i+"' name='dosis4[]' value='0'/></td><td><textarea class='form-control' type='text' id='obsfmedhosp"+i+"' name='obsfmedhosp[]' ></textarea></td></tr>";

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
  			url : 'autocomplete1/ajax.php',
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
      $('#idmfmedhosp'+id[1]).val(m);
      $('#codmed'+id[1]).val(names[2]);
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
			url : 'autocomplete1/ajax.php',
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


	}
});

$('#country_code_1').autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'autocomplete1/ajax.php',
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
		$('#codmed_1').val(names[1]);
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
  			url : 'autocomplete1/ajax.php',
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
    $('#dosis1'+id[1]).val(names[2]);
	},
	open: function() {
		$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	},
	close: function() {
		$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	}
});
