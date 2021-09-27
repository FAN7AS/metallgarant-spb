function resetpole(npol)
{
	if (npol.value == 'ОАО Супер Компания' || npol.value == 'Обработка любых материалов' || npol.value == 'Иванов Иванъ Иванович' || npol.value == 'Самый главный' || npol.value == '+7 495 1111111' || npol.value == '111111, Москва, ул. Центральная, 11' || npol.value == 'ivanov@company.ru' || npol.value == 'Требуется весь ассортимент нержавеющего и цветного металлопроката.' || npol.value == 'Требуется помощь в выборе цветного или нержавеющего металлопроката.' || npol.value == 'Вопрос о поставках цветного или нержавеющего металлопроката.')
	{
		npol.value='';
		npol.className='TxtBlack';
	}
	if (npol.value == 'Поиск по каталогу')
	{
		npol.value='';
		npol.className='txtinput2';
	}
}

function backpole(npol)
{
	if (npol.value == '' || npol.value == ' ')
	{
		npol.value='Поиск по каталогу';
		npol.className='txtinput';
	}
}

function vocol()
{

	document.orderform.namecomp.className='TxtGray';
	document.orderform.sphedet.className='TxtGray';
	document.orderform.fio.className='TxtGray';
	document.orderform.dolgn.className='TxtGray';
	document.orderform.telef.className='TxtGray';
	document.orderform.faks.className='TxtGray';
	document.orderform.adres.className='TxtGray';
	document.orderform.email.className='TxtGray';
	document.orderform.txtzak.className='TxtGray';

}

function vocol2()
{

	document.soobform.namecomp.className='TxtGray';
	document.soobform.sphedet.className='TxtGray';
	document.soobform.fio.className='TxtGray';
	document.soobform.dolgn.className='TxtGray';
	document.soobform.telef.className='TxtGray';
	document.soobform.faks.className='TxtGray';
	document.soobform.adres.className='TxtGray';
	document.soobform.email.className='TxtGray';
	document.soobform.txtzak.className='TxtGray';

}

function vocol3()
{

	document.voprform.namecomp.className='TxtGray';
	document.voprform.sphedet.className='TxtGray';
	document.voprform.fio.className='TxtGray';
	document.voprform.dolgn.className='TxtGray';
	document.voprform.telef.className='TxtGray';
	document.voprform.faks.className='TxtGray';
	document.voprform.adres.className='TxtGray';
	document.voprform.email.className='TxtGray';
	document.voprform.txtzak.className='TxtGray';

}

function zvp()
{
	document.getElementById('truba_nerzav_k_vd').select();
}

function comta(tt)
{

	if (tt.className=="answervopros3") 
	{
		var vg = "";
		var vgy = "";
		var vt = "";
		var vty = "";
		for (var i=1; i<6; i++)
		{
			vg="cat"+i;
			vgy = document.getElementById(vg);
			vgy.className = "answervopros1";
			vt="met"+i;
			vty = document.getElementById(vt);
			vty.className = "nocalc"
		}

		var vo = tt.id;
		vo = "met" + vo.substring(3);
		var vi = document.getElementById(vo);
		vi.className = "yescalc";
		tt.className = "answervopros2";

		if (tt.id == "cat1") 
		{
			document.getElementById('ptl1').checked = "true";
		}
		if (tt.id == "cat2") 
		{
			document.getElementById('atl1').checked = "true";
		}
		if (tt.id == "cat3") 
		{
			document.getElementById('mtl1').checked = "true";
		}
		if (tt.id == "cat4") 
		{
			document.getElementById('ltl1').checked = "true";
		}
		if (tt.id == "cat5") 
		{
			document.getElementById('btl1').checked = "true";
		}

		if (document.getElementById('nip1').className == "yescalc") document.getElementById('truba_nerzav_k_vd').select();
		if (document.getElementById('nip2').className == "yescalc") document.getElementById('truba_nerzav_p_vy').select();
		if (document.getElementById('nip3').className == "yescalc") document.getElementById('list_nerzav_sh').select();
		if (document.getElementById('nip4').className == "yescalc") document.getElementById('plita_nerzav_sh').select();
		if (document.getElementById('nip5').className == "yescalc") document.getElementById('lenta_nerzav_sh').select();
		if (document.getElementById('nip6').className == "yescalc") document.getElementById('polosa_nerzav_sh').select();
		if (document.getElementById('nip7').className == "yescalc") document.getElementById('krug_nerzav_vd').select();
		if (document.getElementById('nip8').className == "yescalc") document.getElementById('kvadrat_nerzav_sh').select();
		if (document.getElementById('nip9').className == "yescalc") document.getElementById('shest_nerzav_vd').select();
		if (document.getElementById('nip10').className == "yescalc") document.getElementById('ugol_nerzav_vy').select();
		if (document.getElementById('nip11').className == "yescalc") document.getElementById('shvel_nerzav_vy').select();
		if (document.getElementById('nip12').className == "yescalc") document.getElementById('prov_nerzav_vd').select();

		calcm();
	}

}

function vomta(tt)
{

	if (tt.className=="answervopros1") 
	{
		tt.className = "answervopros3";
	}
}

function tomta(tt)
{

	if (tt.className=="answervopros3") 
	{
		tt.className = "answervopros1";
	}
}

function ncomta(tt)
{


	if (tt.className=="nep3") 
	{
		var vg = "";
		var vgy = "";
		var vt = "";
		var vty = "";
		for (var i=1; i<13; i++)
		{
			vg="nop"+i;
			vgy = document.getElementById(vg);
			vgy.className = "nep1";
			vt="nip"+i;
			vty = document.getElementById(vt);
			vty.className = "nocalc"
		}

		var vo = tt.id;
		vo = "nip" + vo.substring(3);
		var vi = document.getElementById(vo);
		vi.className = "yescalc";
		tt.className = "nep2";

		if (document.getElementById('cat1').className == "answervopros2") 
		{
			document.getElementById('ptl1').checked = "true";
		}
		if (document.getElementById('cat2').className == "answervopros2") 
		{
			document.getElementById('atl1').checked = "true";
		}
		if (document.getElementById('cat3').className == "answervopros2") 
		{
			document.getElementById('mtl1').checked = "true";
		}
		if (document.getElementById('cat4').className == "answervopros2") 
		{
			document.getElementById('ltl1').checked = "true";
		}
		if (document.getElementById('cat5').className == "answervopros2") 
		{
			document.getElementById('btl1').checked = "true";
		}

		if (tt.id == "nop1") 
		{
			document.getElementById('truba_nerzav_k_vd').value = 0;
			document.getElementById('truba_nerzav_k_ts').value = 0;
			document.getElementById('truba_nerzav_k_dl').value = 0;
			document.getElementById('truba_nerzav_k_vs').value = 0;
			document.getElementById('truba_nerzav_k_vd').select();
		}
		if (tt.id == "nop2")
		{
			document.getElementById('truba_nerzav_p_vy').value = 0;
			document.getElementById('truba_nerzav_p_sh').value = 0;
			document.getElementById('truba_nerzav_p_ts').value = 0;
			document.getElementById('truba_nerzav_p_dl').value = 0;
			document.getElementById('truba_nerzav_p_vs').value = 0;
			document.getElementById('truba_nerzav_p_vy').select();
		}
		if (tt.id == "nop3")
		{
			document.getElementById('list_nerzav_sh').value = 0;
			document.getElementById('list_nerzav_dl').value = 0;
			document.getElementById('list_nerzav_ts').value = 0;
			document.getElementById('list_nerzav_kl').value = 0;
			document.getElementById('list_nerzav_op').value = 0;
			document.getElementById('list_nerzav_vs').value = 0;
			document.getElementById('list_nerzav_sh').select();
		}
		if (tt.id == "nop4")
		{
			document.getElementById('plita_nerzav_sh').value = 0;
			document.getElementById('plita_nerzav_dl').value = 0;
			document.getElementById('plita_nerzav_ts').value = 0;
			document.getElementById('plita_nerzav_kl').value = 0;
			document.getElementById('plita_nerzav_op').value = 0;
			document.getElementById('plita_nerzav_vs').value = 0;
			document.getElementById('plita_nerzav_sh').select();
		}
		if (tt.id == "nop5")
		{
			document.getElementById('lenta_nerzav_sh').value = 0;
			document.getElementById('lenta_nerzav_dl').value = 0;
			document.getElementById('lenta_nerzav_ts').value = 0;
			document.getElementById('lenta_nerzav_op').value = 0;
			document.getElementById('lenta_nerzav_vs').value = 0;
			document.getElementById('lenta_nerzav_sh').select();
		}
		if (tt.id == "nop6")
		{
			document.getElementById('polosa_nerzav_sh').value = 0;
			document.getElementById('polosa_nerzav_dl').value = 0;
			document.getElementById('polosa_nerzav_ts').value = 0;
			document.getElementById('polosa_nerzav_vs').value = 0;
			document.getElementById('polosa_nerzav_sh').select();
		}
		if (tt.id == "nop7")
		{
			document.getElementById('krug_nerzav_vd').value = 0;
			document.getElementById('krug_nerzav_dl').value = 0;
			document.getElementById('krug_nerzav_vs').value = 0;
			document.getElementById('krug_nerzav_vd').select();
		}
		if (tt.id == "nop8")
		{
			document.getElementById('kvadrat_nerzav_sh').value = 0;
			document.getElementById('kvadrat_nerzav_dl').value = 0;
			document.getElementById('kvadrat_nerzav_vs').value = 0;
			document.getElementById('kvadrat_nerzav_sh').select();
		}
		if (tt.id == "nop9")
		{
			document.getElementById('shest_nerzav_vd').value = 0;
			document.getElementById('shest_nerzav_dl').value = 0;
			document.getElementById('shest_nerzav_vs').value = 0;
			document.getElementById('shest_nerzav_vd').select();
		}
		if (tt.id == "nop10")
		{
			document.getElementById('ugol_nerzav_vy').value = 0;
			document.getElementById('ugol_nerzav_sh').value = 0;
			document.getElementById('ugol_nerzav_ts').value = 0;
			document.getElementById('ugol_nerzav_dl').value = 0;
			document.getElementById('ugol_nerzav_vs').value = 0;
			document.getElementById('ugol_nerzav_vy').select();
		}
		if (tt.id == "nop11")
		{
			document.getElementById('shvel_nerzav_vy').value = 0;
			document.getElementById('shvel_nerzav_sh').value = 0;
			document.getElementById('shvel_nerzav_ts').value = 0;
			document.getElementById('shvel_nerzav_dl').value = 0;
			document.getElementById('shvel_nerzav_vs').value = 0;
			document.getElementById('shvel_nerzav_vy').select();
		}
		if (tt.id == "nop12")
		{
			document.getElementById('prov_nerzav_vd').value = 0;
			document.getElementById('prov_nerzav_dl').value = 0;
			document.getElementById('prov_nerzav_vs').value = 0;
			document.getElementById('prov_nerzav_vd').select();
		}
	}

}

function nvomta(tt)
{

	if (tt.className=="nep1") 
	{
		tt.className = "nep3";
	}
}

function ntomta(tt)
{

	if (tt.className=="nep3") 
	{
		tt.className = "nep1";
	}
}

function toknum(n, e)
{

	if (!e) e = window.event || null; 

	var nn = n.value;

	if ((nn.indexOf(".")>=0) || (nn.indexOf(",")>=0)) 
	{
		if (window.event)
		{
			if ((e.keyCode < 48) || (e.keyCode > 57)) e.returnValue = false;
		}
		else
		{
			if (((e.charCode < 48) || (e.charCode > 57)) && (e.charCode != 0)) e.preventDefault();
		}
	}
	else
	{
		if (window.event)
		{
			if (((e.keyCode < 48) || (e.keyCode > 57)) && (e.keyCode != 44) && (e.keyCode != 46)) e.returnValue = false;
		}
		else
		{
			if (((e.charCode < 48) || (e.charCode > 57)) && (e.charCode != 44) && (e.charCode != 46) && (e.charCode != 0)) e.preventDefault();
		}
	}

} 

function calcm()
{

	var pi = Math.PI.toFixed(8);

	if (document.getElementById('cat1').className == "answervopros2") 
	{
		if (document.getElementById('ptl1').checked) var plotn = parseFloat(document.getElementById('ptl1').value.replace(',', '.'));
		if (document.getElementById('ptl2').checked) var plotn = parseFloat(document.getElementById('ptl2').value.replace(',', '.'));
		if (document.getElementById('ptl3').checked) var plotn = parseFloat(document.getElementById('ptl3').value.replace(',', '.'));
		if (document.getElementById('ptl4').checked) var plotn = parseFloat(document.getElementById('ptl4').value.replace(',', '.'));
		if (document.getElementById('ptl5').checked) var plotn = parseFloat(document.getElementById('ptl5').value.replace(',', '.'));
		if (document.getElementById('ptl6').checked) var plotn = parseFloat(document.getElementById('ptl6').value.replace(',', '.'));
		if (document.getElementById('ptl7').checked) var plotn = parseFloat(document.getElementById('ptl7').value.replace(',', '.'));
		if (document.getElementById('ptl8').checked) var plotn = parseFloat(document.getElementById('ptl8').value.replace(',', '.'));
		if (document.getElementById('ptl9').checked) var plotn = parseFloat(document.getElementById('ptl9').value.replace(',', '.'));
		if (document.getElementById('ptl10').checked) var plotn = parseFloat(document.getElementById('ptl10').value.replace(',', '.'));
		if (document.getElementById('ptl11').checked) var plotn = parseFloat(document.getElementById('ptl11').value.replace(',', '.'));
		if (document.getElementById('ptl12').checked) var plotn = parseFloat(document.getElementById('ptl12').value.replace(',', '.'));
		if (document.getElementById('ptl13').checked) var plotn = parseFloat(document.getElementById('ptl13').value.replace(',', '.'));
		if (document.getElementById('ptl14').checked) var plotn = parseFloat(document.getElementById('ptl14').value.replace(',', '.'));
	}
	if (document.getElementById('cat2').className == "answervopros2") 
	{
		if (document.getElementById('atl1').checked) var plotn = parseFloat(document.getElementById('atl1').value.replace(',', '.'));
		if (document.getElementById('atl2').checked) var plotn = parseFloat(document.getElementById('atl2').value.replace(',', '.'));
		if (document.getElementById('atl3').checked) var plotn = parseFloat(document.getElementById('atl3').value.replace(',', '.'));
		if (document.getElementById('atl4').checked) var plotn = parseFloat(document.getElementById('atl4').value.replace(',', '.'));
		if (document.getElementById('atl5').checked) var plotn = parseFloat(document.getElementById('atl5').value.replace(',', '.'));
		if (document.getElementById('atl6').checked) var plotn = parseFloat(document.getElementById('atl6').value.replace(',', '.'));
		if (document.getElementById('atl7').checked) var plotn = parseFloat(document.getElementById('atl7').value.replace(',', '.'));
		if (document.getElementById('atl8').checked) var plotn = parseFloat(document.getElementById('atl8').value.replace(',', '.'));
		if (document.getElementById('atl9').checked) var plotn = parseFloat(document.getElementById('atl9').value.replace(',', '.'));
		if (document.getElementById('atl10').checked) var plotn = parseFloat(document.getElementById('atl10').value.replace(',', '.'));
		if (document.getElementById('atl11').checked) var plotn = parseFloat(document.getElementById('atl11').value.replace(',', '.'));
	}
	if (document.getElementById('cat3').className == "answervopros2") 
	{
		if (document.getElementById('mtl1').checked) var plotn = parseFloat(document.getElementById('mtl1').value.replace(',', '.'));
		if (document.getElementById('mtl2').checked) var plotn = parseFloat(document.getElementById('mtl2').value.replace(',', '.'));
		if (document.getElementById('mtl3').checked) var plotn = parseFloat(document.getElementById('mtl3').value.replace(',', '.'));
	}
	if (document.getElementById('cat4').className == "answervopros2") 
	{
		if (document.getElementById('ltl1').checked) var plotn = parseFloat(document.getElementById('ltl1').value.replace(',', '.'));
		if (document.getElementById('ltl2').checked) var plotn = parseFloat(document.getElementById('ltl2').value.replace(',', '.'));
		if (document.getElementById('ltl3').checked) var plotn = parseFloat(document.getElementById('ltl3').value.replace(',', '.'));
		if (document.getElementById('ltl4').checked) var plotn = parseFloat(document.getElementById('ltl4').value.replace(',', '.'));
		if (document.getElementById('ltl5').checked) var plotn = parseFloat(document.getElementById('ltl5').value.replace(',', '.'));
		if (document.getElementById('ltl6').checked) var plotn = parseFloat(document.getElementById('ltl6').value.replace(',', '.'));
		if (document.getElementById('ltl7').checked) var plotn = parseFloat(document.getElementById('ltl7').value.replace(',', '.'));
	}
	if (document.getElementById('cat5').className == "answervopros2") 
	{
		if (document.getElementById('btl1').checked) var plotn = parseFloat(document.getElementById('btl1').value.replace(',', '.'));
		if (document.getElementById('btl2').checked) var plotn = parseFloat(document.getElementById('btl2').value.replace(',', '.'));
		if (document.getElementById('btl3').checked) var plotn = parseFloat(document.getElementById('btl3').value.replace(',', '.'));
		if (document.getElementById('btl4').checked) var plotn = parseFloat(document.getElementById('btl4').value.replace(',', '.'));
		if (document.getElementById('btl5').checked) var plotn = parseFloat(document.getElementById('btl5').value.replace(',', '.'));
		if (document.getElementById('btl6').checked) var plotn = parseFloat(document.getElementById('btl6').value.replace(',', '.'));
		if (document.getElementById('btl7').checked) var plotn = parseFloat(document.getElementById('btl7').value.replace(',', '.'));
		if (document.getElementById('btl8').checked) var plotn = parseFloat(document.getElementById('btl8').value.replace(',', '.'));
		if (document.getElementById('btl9').checked) var plotn = parseFloat(document.getElementById('btl9').value.replace(',', '.'));
		if (document.getElementById('btl10').checked) var plotn = parseFloat(document.getElementById('btl10').value.replace(',', '.'));
	}

	if (document.getElementById('nip1').className == "yescalc") var izd = 1;
	if (document.getElementById('nip2').className == "yescalc") var izd = 2;
	if (document.getElementById('nip3').className == "yescalc") var izd = 3;
	if (document.getElementById('nip4').className == "yescalc") var izd = 4;
	if (document.getElementById('nip5').className == "yescalc") var izd = 5;
	if (document.getElementById('nip6').className == "yescalc") var izd = 6;
	if (document.getElementById('nip7').className == "yescalc") var izd = 7;
	if (document.getElementById('nip8').className == "yescalc") var izd = 8;
	if (document.getElementById('nip9').className == "yescalc") var izd = 9;
	if (document.getElementById('nip10').className == "yescalc") var izd = 10;
	if (document.getElementById('nip11').className == "yescalc") var izd = 11;
	if (document.getElementById('nip12').className == "yescalc") var izd = 12;

	if (izd == 1)
	{
		var diametr = parseFloat(document.getElementById('truba_nerzav_k_vd').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('truba_nerzav_k_ts').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('truba_nerzav_k_dl').value.replace(',', '.'));

		if ((diametr > 0) && (tolshina > 0) && (dlina > 0) && (diametr > tolshina) && (plotn > 0))
		{
			var massa = (diametr-tolshina)*tolshina*dlina*plotn*pi/1000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('truba_nerzav_k_vs').value = massa;
			}
			else 
			{
				document.getElementById('truba_nerzav_k_vs').value = ves;
			}
		}
		else document.getElementById('truba_nerzav_k_vs').value = 0;
	}

	if (izd == 2)
	{
		var vysota = parseFloat(document.getElementById('truba_nerzav_p_vy').value.replace(',', '.'));
		var shirina = parseFloat(document.getElementById('truba_nerzav_p_sh').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('truba_nerzav_p_ts').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('truba_nerzav_p_dl').value.replace(',', '.'));

		if ((vysota > 0) && (shirina > 0) && (tolshina > 0) && (dlina > 0) && (vysota > tolshina) && (shirina > tolshina) && (plotn > 0))
		{
			var massa = (vysota*shirina-(vysota-tolshina*2)*(shirina-tolshina*2))*dlina*plotn/1000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('truba_nerzav_p_vs').value = massa;
			}
			else 
			{
				document.getElementById('truba_nerzav_p_vs').value = ves;
			}
		}
		else document.getElementById('truba_nerzav_p_vs').value = 0;
	}

	if (izd == 3)
	{
		var shirina = parseFloat(document.getElementById('list_nerzav_sh').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('list_nerzav_dl').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('list_nerzav_ts').value.replace(',', '.'));
		var kolvo = parseFloat(document.getElementById('list_nerzav_kl').value.replace(',', '.'));

		if ((kolvo > 0) && (shirina > 0) && (tolshina > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = tolshina*shirina*dlina*kolvo*plotn/1000000000;
			var plosh = dlina*shirina*kolvo/1000000;
			var ves = massa.toFixed(3);
			var obpl = plosh.toFixed(3);
			if (plosh.toString().length < obpl.toString().length) 
			{
				document.getElementById('list_nerzav_op').value = plosh;
			}
			else 
			{
				document.getElementById('list_nerzav_op').value = obpl;
			}
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('list_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('list_nerzav_vs').value = ves;
			}
		}
		else 
		{
			document.getElementById('list_nerzav_op').value = 0;
			document.getElementById('list_nerzav_vs').value = 0;
		}
	}

	if (izd == 4)
	{
		var shirina = parseFloat(document.getElementById('plita_nerzav_sh').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('plita_nerzav_dl').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('plita_nerzav_ts').value.replace(',', '.'));
		var kolvo = parseFloat(document.getElementById('plita_nerzav_kl').value.replace(',', '.'));

		if ((kolvo > 0) && (shirina > 0) && (tolshina > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = tolshina*shirina*dlina*kolvo*plotn/1000000000;
			var plosh = dlina*shirina*kolvo/1000000;
			var ves = massa.toFixed(3);
			var obpl = plosh.toFixed(3);
			if (plosh.toString().length < obpl.toString().length) 
			{
				document.getElementById('plita_nerzav_op').value = plosh;
			}
			else 
			{
				document.getElementById('plita_nerzav_op').value = obpl;
			}
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('plita_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('plita_nerzav_vs').value = ves;
			}
		}
		else 
		{
			document.getElementById('plita_nerzav_op').value = 0;
			document.getElementById('plita_nerzav_vs').value = 0;
		}
	}

	if (izd == 5)
	{
		var shirina = parseFloat(document.getElementById('lenta_nerzav_sh').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('lenta_nerzav_dl').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('lenta_nerzav_ts').value.replace(',', '.'));

		if ((shirina > 0) && (tolshina > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = tolshina*shirina*dlina*plotn/1000000000;
			var plosh = dlina*shirina/1000;
			var ves = massa.toFixed(3);
			var obpl = plosh.toFixed(3);
			if (plosh.toString().length < obpl.toString().length) 
			{
				document.getElementById('lenta_nerzav_op').value = plosh;
			}
			else 
			{
				document.getElementById('lenta_nerzav_op').value = obpl;
			}
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('lenta_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('lenta_nerzav_vs').value = ves;
			}
		}
		else 
		{
			document.getElementById('lenta_nerzav_op').value = 0;
			document.getElementById('lenta_nerzav_vs').value = 0;
		}
	}

	if (izd == 6)
	{
		var shirina = parseFloat(document.getElementById('polosa_nerzav_sh').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('polosa_nerzav_dl').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('polosa_nerzav_ts').value.replace(',', '.'));

		if ((shirina > 0) && (tolshina > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = tolshina*shirina*dlina*plotn/1000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('polosa_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('polosa_nerzav_vs').value = ves;
			}
		}
		else document.getElementById('polosa_nerzav_vs').value = 0;
	}

	if (izd == 7)
	{
		var diametr = parseFloat(document.getElementById('krug_nerzav_vd').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('krug_nerzav_dl').value.replace(',', '.'));

		if ((diametr > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = diametr*diametr*dlina*pi*plotn/4000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('krug_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('krug_nerzav_vs').value = ves;
			}
		}
		else document.getElementById('krug_nerzav_vs').value = 0;
	}

	if (izd == 8)
	{
		var shirina = parseFloat(document.getElementById('kvadrat_nerzav_sh').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('kvadrat_nerzav_dl').value.replace(',', '.'));

		if ((shirina > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = shirina*shirina*dlina*plotn/1000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('kvadrat_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('kvadrat_nerzav_vs').value = ves;
			}
		}
		else document.getElementById('kvadrat_nerzav_vs').value = 0;
	}

	if (izd == 9)
	{
		var diametr = parseFloat(document.getElementById('shest_nerzav_vd').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('shest_nerzav_dl').value.replace(',', '.'));

		if ((diametr > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = diametr*diametr*dlina*0.8660254*plotn/1000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('shest_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('shest_nerzav_vs').value = ves;
			}
		}
		else document.getElementById('shest_nerzav_vs').value = 0;
	}

	if (izd == 10)
	{
		var vysota = parseFloat(document.getElementById('ugol_nerzav_vy').value.replace(',', '.'));
		var shirina = parseFloat(document.getElementById('ugol_nerzav_sh').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('ugol_nerzav_ts').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('ugol_nerzav_dl').value.replace(',', '.'));

		if ((vysota > 0) && (shirina > 0) && (tolshina > 0) && (dlina > 0) && (vysota > tolshina) && (shirina > tolshina) && (plotn > 0))
		{
			var massa = (vysota*tolshina+(shirina-tolshina)*tolshina)*dlina*plotn/1000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('ugol_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('ugol_nerzav_vs').value = ves;
			}
		}
		else document.getElementById('ugol_nerzav_vs').value = 0;
	}

	if (izd == 11)
	{
		var vysota = parseFloat(document.getElementById('shvel_nerzav_vy').value.replace(',', '.'));
		var shirina = parseFloat(document.getElementById('shvel_nerzav_sh').value.replace(',', '.'));
		var tolshina = parseFloat(document.getElementById('shvel_nerzav_ts').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('shvel_nerzav_dl').value.replace(',', '.'));

		if ((vysota > 0) && (shirina > 0) && (tolshina > 0) && (dlina > 0) && (vysota > tolshina) && (shirina > tolshina) && (plotn > 0))
		{
			var massa = (vysota*tolshina*2+(shirina-tolshina*2)*tolshina)*dlina*plotn/1000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('shvel_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('shvel_nerzav_vs').value = ves;
			}
		}
		else document.getElementById('shvel_nerzav_vs').value = 0;
	}

	if (izd == 12)
	{
		var diametr = parseFloat(document.getElementById('prov_nerzav_vd').value.replace(',', '.'));
		var dlina = parseFloat(document.getElementById('prov_nerzav_dl').value.replace(',', '.'));

		if ((diametr > 0) && (dlina > 0) && (plotn > 0))
		{
			var massa = diametr*diametr*dlina*pi*plotn/4000000000;
			var ves = massa.toFixed(3);
			if (massa.toString().length < ves.toString().length) 
			{
				document.getElementById('prov_nerzav_vs').value = massa;
			}
			else 
			{
				document.getElementById('prov_nerzav_vs').value = ves;
			}
		}
		else document.getElementById('prov_nerzav_vs').value = 0;
	}
}

function vot(vv)
{
	var vo = vv.id;
	vo = "o" + vo.substring(1);

	var tmp11='';
	var tmp12='';
	var tmp21='';
	var tmp22='';
	for (var i=1; i<6; i++)
	{
		if (i!=vo.substring(1))
		{
			tmp11="v"+i;
			tmp12 = document.getElementById(tmp11);
			tmp21="o"+i;
			tmp22 = document.getElementById(tmp21);
			tmp12.className = "vopros1";
			tmp22.className = "otvet1";
		}
	}

	var vi = document.getElementById(vo);
	if (vi.className=="otvet1") 
	{
		vi.className = "otvet2";
		vv.className = "vopros2";
	}
	else 
	{
		vi.className = "otvet1";
		vv.className = "vopros1";
	}
}