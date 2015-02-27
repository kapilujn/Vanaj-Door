// JavaScript Document

$(document).ready(function(e) {
/*	var mwindwidth = $(window).width();
	var pagewidth = $('#page2').width();
	mleft = (mwindwidth - pagewidth )/2;
	$('#page2').css('left',mleft);*/
	
	var mdoorthickness = $('#doorThickness').val();
	if(mdoorthickness==''){
//		$('#page2').find('fieldset, input, select, button').attr('disabled','disabled');
//		$('#doorThickness').removeAttr('disabled');
	}else{
		
		$('#page2').find("input,select,button").removeAttr('disabled');
		}

	$('#doorThickness').keydown(function() {
		var mdoorthickness = $(this).val();
		if(mdoorthickness==''){
//			$('#page2').find("input,select,button").attr('disabled','disabled');
//			$('#doorThickness').removeAttr('disabled');
		}else{
//			$('select').removeAttr('disabled');

			}
   
		});

	$('#plywoodType').change(function(){
		var mplytype = $(this).val();
		if (mplytype == "teak"){
			$('#teakoption').removeAttr('disabled');
			$('#paint').attr('disabled',true);			
			}
		if (mplytype == "nuwood"){
			$('#paint').removeAttr('disabled');
			$('#teakoption').attr('disabled','disabled');			
			}
			
			
		});

	$('#baton').change(function(){
		var mbaton = $(this).val();
		if(mbaton=="yes"){
			$('#batonopt').removeAttr('disabled');
			}else{
				$('#batonopt').attr('disabled',true);
				}
		
		
		});


 $('#genButton').click(function(){

		var mdoorthickness  = $('#doorThickness').val();
		var mplytype 	= $('#plywoodType').val();
		var mpaint 	  = $('#paint').val();
		var mteakoption	 = $('#teakoption:checked').length;
		var mplythickness   = $('#plythickness').val();
		var mbaton 	  = $('#baton').val();
		var mbatonoption = $('#batonopt:checked').length;
		var mmica	   = $('#mica').val();
		var mmicaoption	  = $('#micaoption').val();
		var mwidth 	  = $('#width').val()  + '.' + $('#widthopt').val();
		var mheight 	  = $('#height').val() + '.' + $('#heightopt').val();
		var mdoorsize	   = $('#doorsize').val();
		
		
/*				,*/
				

		$.post("http://madhav-cc.com/vanajdoor/getRate.php",		
			{doorthickness:mdoorthickness,plytype:mplytype,paint:mpaint, 
				width:mwidth,height:mheight,teakoption:mteakoption,
				plythickness:mplythickness,baton:mbaton,batonoption:mbatonoption,
				mica:mmica,micaoption:mmicaoption,doorsize:mdoorsize},function(data){				
//				alert(data);
			$('#doorcost').text(data);				
		}).error(function(){
			alert("Error");
			});
	
	
	});


$('#doorsize').change(function(){
	var mdoorsize = $(this).val();
	var mlen 	= $('#height').val().length;
	var mheight = $('#height').val();
	var mwidth  = $('#width').val();
	
	if(mdoorsize=="inch"){
		if(mlen>3){
					$('#height').val(mheight/25.4);			
					$('#width').val(mwidth/25.4);			
					}
	}else {
		if(mlen<4){
					$('#height').val(mheight*25.4);
					$('#width').val(mwidth*25.4);
					}
		 }
	});


$('#xtbtn').click(function(){
	alert("Hi");
	});	

});



