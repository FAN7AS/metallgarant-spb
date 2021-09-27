jQuery(document).ready(function($){
	jQuery('<span class="dec"></span>').insertBefore('.assort-prod p:not(.ttl):not(:eq(0))');
	if(jQuery('.assort-prod p:not(.ttl)').length<4){
		jQuery('.assort-prod').addClass('sm');
	}










			var diametr, square, side, length, thickness, weight, height, width, density = 7900;
			function weightTube (diametr, length, thickness){
				var radius = diametr / 2;
				var radius2 = radius - thickness;
				var raznica = radius*radius - radius2*radius2;
				weight = 3.14159 * density / 1000000 * length * raznica / 1000;
				$('#weight').val(weight.toFixed(3));
			}
			function weightTubePr (width, height, length, thickness){
				weight = density * length * (height * width - (height - thickness * 2) * (width - thickness * 2)) / 1000000000;
				$('#weight').val(weight.toFixed(3));
			}
			function weightList (width, countList, length, thickness){
				weight = density * countList * lenght * width * thickness / 1000000000;
				$('#weight').val(weight.toFixed(3));
			}
			function squareList (width, length){
				square = lenght * width / 1000000;
				$('#square-list, #square-plita, #square-lenta').val(square.toFixed(3));
			}
			function weightPrutok (length, diametr) {
				weight = 3.14159 * density * lenght * diametr * diametr / 1000000000 / 4;
				$('#weight').val(weight.toFixed(3));
			}
			function weightkvadrat (length, side) {
				weight = density * lenght * side * side / 1000000000;
				$('#weight').val(weight.toFixed(3));
			}
			function weightsix (length, diametr) {
				weight = density * lenght * diametr * diametr * 2 / 4 * 1.7321 / 1000000000;
				$('#weight').val(weight.toFixed(3));
			}
			function weightUgolok(lenght, width, height, thickness) {
				weight = density * lenght * ( thickness * width + thickness * ( height - thickness )) / 1000000000;
				$('#weight').val(weight.toFixed(3));
			}
			function weightShveller(lenght, width, height, thickness){
				weight = density * lenght * ( (width -2 * thickness) * thickness + 2 * thickness * height ) / 1000000000;
				$('#weight').val(weight.toFixed(3));
			}

			$('#type').change(function(){
				$('#weight').val("0.00");
				$('#outer-diametr-tube, #length-tube, #wall-thickness-tube, #height-tube , #width-tube, #wall-thickness-tube-pr, #length-tube-pr, #square-list, #square-plita, #square-lenta').val("");
				$('.tube, .tube-profile, .list, .plita, .shina, .prutok, .kvadrat, .six, .ugolok, .shveller, .provoloka, .lenta').css('display', 'none');
				var numberProkat = $(this).val();
				if(numberProkat == 1){
					$('.tube').css('display', 'block');
				} else if (numberProkat == 2){
					$('.tube-profile').css('display', 'block');
				} else if (numberProkat == 3){
					$('.list').css('display', 'block');
				} else if (numberProkat == 4){
					$('.plita').css('display', 'block');
				} else if (numberProkat == 5){
					$('.lenta').css('display', 'block');
				} else if (numberProkat == 6){
					$('.shina').css('display', 'block');
				} else if (numberProkat == 7){
					$('.prutok').css('display', 'block');
				} else if (numberProkat == 8){
					$('.kvadrat').css('display', 'block');
				} else if (numberProkat == 10){
					$('.six').css('display', 'block');
				} else if (numberProkat == 11){
					$('.ugolok').css('display', 'block');
				} else if (numberProkat == 12){
					$('.shveller').css('display', 'block');
				} else if (numberProkat == 13){
					$('.provoloka').css('display', 'block');
				}
			});


			//расчет веса трубы
			$('#outer-diametr-tube').change(function(){
				diametr = $(this).val();
				length = $('#length-tube').val();
				thickness = $('#wall-thickness-tube').val();
				weightTube (diametr, length, thickness);
			});
			$('#length-tube').change(function(){
				length = $(this).val();
				diametr = $('#outer-diametr-tube').val();
				thickness = $('#wall-thickness-tube').val();
				weightTube (diametr, length, thickness);
			});
			$('#wall-thickness-tube').change(function(){
				thickness = $(this).val();
				diametr = $('#outer-diametr-tube').val();
				length = $('#length-tube').val();
				weightTube (diametr, length, thickness);
			});
			//конец расчета веса трубы

			//расчет веса трубы профильной
			$('#height-tube').change(function(){
				height = $(this).val();
				width = $('#width-tube').val();
				thickness = $('#wall-thickness-tube-pr').val();
				length = $('#length-tube-pr').val();
				weightTubePr (width, height, length, thickness);
			});
			$('#width-tube').change(function(){
				width = $(this).val();
				height = $('#height-tube').val();
				thickness = $('#wall-thickness-tube-pr').val();
				length = $('#length-tube-pr').val();
				weightTubePr (width, height, length, thickness);
			});
			$('#wall-thickness-tube-pr').change(function(){
				thickness = $(this).val();
				height = $('#height-tube').val();
				width = $('#width-tube').val();
				length = $('#length-tube-pr').val();
				weightTubePr (width, height, length, thickness);
			});
			$('#length-tube-pr').change(function(){
				length = $(this).val();
				height = $('#height-tube').val();
				width = $('#width-tube').val();
				thickness = $('#wall-thickness-tube-pr').val();
				weightTubePr (width, height, length, thickness);
			});
			//конец расчета веса трубы профильной

			//расчет веса листа
			$('#lenght-list').change(function(){
				lenght = $(this).val();
				width = $('#width-list').val();
				countList = $('#count-list').val();
				thickness = $('#thickness-list').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			$('#width-list').change(function(){
				width = $(this).val();
				lenght = $('#lenght-list').val();
				countList = $('#count-list').val();
				thickness = $('#thickness-list').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			$('#count-list').change(function(){
				countList = $(this).val();
				lenght = $('#lenght-list').val();
				width = $('#width-list').val();
				thickness = $('#thickness-list').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			$('#thickness-list').change(function(){
				thickness = $(this).val();
				lenght = $('#lenght-list').val();
				width = $('#width-list').val();
				countList = $('#count-list').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			//конец расчета веса листа
			//расчет веса плиты
			$('#lenght-plita').change(function(){
				lenght = $(this).val();
				width = $('#width-plita').val();
				countList = $('#count-plita').val();
				thickness = $('#thickness-plita').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			$('#width-plita').change(function(){
				width = $(this).val();
				lenght = $('#lenght-plita').val();
				countList = $('#count-plita').val();
				thickness = $('#thickness-plita').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			$('#count-plita').change(function(){
				countList = $(this).val();
				lenght = $('#lenght-plita').val();
				width = $('#width-plita').val();
				thickness = $('#thickness-plita').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			$('#thickness-plita').change(function(){
				thickness = $(this).val();
				lenght = $('#lenght-plita').val();
				width = $('#width-plita').val();
				countList = $('#count-plita').val();
				weightList (width, countList, length, thickness);
				squareList (width, length);
			});
			//конец расчета веса плиты
			//расчет веса ленты
			$('#lenght-lenta').change(function(){
				lenght = $(this).val();
				width = $('#width-lenta').val();
				countList = $('#count-lenta').val();
				thickness = $('#thickness-lenta').val();
				weightList (width, 1, length, thickness);
				squareList (width, length);
			});
			$('#width-lenta').change(function(){
				width = $(this).val();
				lenght = $('#lenght-lenta').val();
				countList = $('#count-lenta').val();
				thickness = $('#thickness-lenta').val();
				weightList (width, 1, length, thickness);
				squareList (width, length);
			});
			$('#thickness-lenta').change(function(){
				thickness = $(this).val();
				lenght = $('#lenght-lenta').val();
				width = $('#width-lenta').val();
				countList = $('#count-lenta').val();
				weightList (width, 1, length, thickness);
				squareList (width, length);
			});
			//конец расчета веса ленты
			//расчет веса шины
			$('#lenght-shina').change(function(){
				lenght = $(this).val();
				width = $('#width-shina').val();
				countList = $('#count-shina').val();
				thickness = $('#thickness-shina').val();
				weightList (width, 1, length, thickness);
			});
			$('#width-shina').change(function(){
				width = $(this).val();
				lenght = $('#lenght-shina').val();
				countList = $('#count-shina').val();
				thickness = $('#thickness-shina').val();
				weightList (width, 1, length, thickness);
			});
			$('#thickness-shina').change(function(){
				thickness = $(this).val();
				lenght = $('#lenght-shina').val();
				width = $('#width-shina').val();
				countList = $('#count-shina').val();
				weightList (width, 1, length, thickness);
			});
			//конец расчета веса шины
			//расчет веса прутка
			$('#lenght-prutok').change(function(){
				lenght = $(this).val();
				diametr = $('#diametr-prutok').val();
				weightPrutok (length, diametr);
			});
			$('#diametr-prutok').change(function(){
				diametr = $(this).val();
				lenght = $('#lenght-prutok').val();
				weightPrutok (length, diametr);
			});
			//конец расчета веса прутка
			//расчет веса квадрата
			$('#lenght-kvadrat').change(function(){
				lenght = $(this).val();
				side = $('#side-kvadrat').val();
				weightkvadrat (length, side);
			});
			$('#side-kvadrat').change(function(){
				side = $(this).val();
				lenght = $('#lenght-kvadrat').val();
				weightkvadrat (length, side);
			});
			//конец расчета веса квадрата
			//расчет веса шестигранника
			$('#lenght-six').change(function(){
				lenght = $(this).val();
				diametr = $('#diametr-six').val();
				weightsix (length, diametr);
			});
			$('#diametr-six').change(function(){
				diametr = $(this).val();
				lenght = $('#lenght-six').val();
				weightsix (length, diametr);
			});
			//конец расчета веса шестигранника
			//расчет веса уголка
			$('#lenght-ugolok').change(function(){
				lenght = $(this).val();
				width = $('#width-ugolok').val();
				height = $('#height-ugolok').val();
				thickness = $('#thickness-ugolok').val();
				weightUgolok(lenght, width, height, thickness);
			});
			$('#width-ugolok').change(function(){
				width = $(this).val();
				lenght = $('#lenght-ugolok').val();
				height = $('#height-ugolok').val();
				thickness = $('#thickness-ugolok').val();
				weightUgolok(lenght, width, height, thickness);
			});
			$('#height-ugolok').change(function(){
				height = $(this).val();
				lenght = $('#lenght-ugolok').val();
				width = $('#width-ugolok').val();
				thickness = $('#thickness-ugolok').val();
				weightUgolok(lenght, width, height, thickness);
			});
			$('#thickness-ugolok').change(function(){
				thickness = $(this).val();
				lenght = $('#lenght-ugolok').val();
				width = $('#width-ugolok').val();
				height = $('#height-ugolok').val();
				weightUgolok(lenght, width, height, thickness);
			});
			//конец расчета веса уголка
			//расчет веса швеллера
			$('#lenght-shveller').change(function(){
				lenght = $(this).val();
				width = $('#width-shveller').val();
				height = $('#height-shveller').val();
				thickness = $('#thickness-shveller').val();
				weightShveller(lenght, width, height, thickness);
			});
			$('#width-shveller').change(function(){
				width = $(this).val();
				lenght = $('#lenght-shveller').val();
				height = $('#height-shveller').val();
				thickness = $('#thickness-shveller').val();
				weightShveller(lenght, width, height, thickness);
			});
			$('#height-shveller').change(function(){
				height = $(this).val();
				lenght = $('#lenght-shveller').val();
				width = $('#width-shveller').val();
				thickness = $('#thickness-shveller').val();
				weightShveller(lenght, width, height, thickness);
			});
			$('#thickness-shveller').change(function(){
				thickness = $(this).val();
				lenght = $('#lenght-shveller').val();
				width = $('#width-shveller').val();
				height = $('#height-shveller').val();
				weightShveller(lenght, width, height, thickness);
			});
			//конец расчета веса швеллера
			//расчет веса проволоки
			$('#lenght-provoloka').change(function(){
				lenght = $(this).val();
				diametr = $('#diametr-provoloka').val();
				weightPrutok (length, diametr);
			});
			$('#diametr-provoloka').change(function(){
				diametr = $(this).val();
				lenght = $('#lenght-provoloka').val();
				weightPrutok (length, diametr);
			});
			//конец расчета веса проволоки
		});