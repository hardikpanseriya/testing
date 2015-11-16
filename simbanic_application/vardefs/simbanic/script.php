<?php
if(isset($simbanic))
{
	$simba_static_list = json_encode($simbanic);

	if(isset($home_state) && !empty($home_state))
	{
		$simba_home_state = $home_state;
	}
	else
	{
		$simba_home_state = '';
	}
	if(isset($home_district) && !empty($home_district))
	{
		$simba_home_district = $home_district;
	}
	else
	{
		$simba_home_district = '';
	}
	if(isset($home_taluka) && !empty($home_taluka))
	{
		$simba_home_taluka = $home_taluka;
	}
	else
	{
		$simba_home_taluka = '';
	}
	if(isset($home_city) && !empty($home_city))
	{
		$simba_home_city = $home_city;
	}
	else
	{
		$simba_home_city = '';
	}
	if(isset($home_area) && !empty($home_area))
	{
		$simba_home_area = $home_area;
	}
	else
	{
		$simba_home_area = '';
	}
	?>

	<script type="text/javascript">

	var state_obj = '<?= $simba_static_list ?>';
	var simba_state_obj = JSON.parse(state_obj);

	var state_option = document.getElementById('home_state');
	var district_option = document.getElementById('home_district');
	var area_option = document.getElementById('home_area');

	function getState()
	{
		state_option.options[0] = new Option('Select State','');

		if(simba_state_obj.hasOwnProperty('state'))
		{
			var i = 1;
			var js_simba_state_obj = simba_state_obj['state'];
			
			for(var key in js_simba_state_obj)
			{
				var state_key = key;
				var state_value = js_simba_state_obj[key];

				state_option.options[i] = new Option(state_value, state_key);

				if(state_key == '<?= $simba_home_state; ?>')
				{
					state_option.options[i].selected = 'selected';
				}
				
				i++;
			}
		}
		else
		{
			removeOptions(district_option);
		}
	}

	function getDistrict()
	{
		removeOptions(district_option);
		district_option.options[0] = new Option('Select District','');

		removeOptions(area_option);

		var state_value = document.getElementById('home_state').value;
		if(state_value)
		{
			if(simba_state_obj.hasOwnProperty(state_value))
			{
				if(simba_state_obj[state_value].hasOwnProperty('district'))
				{
					var js_simba_district_obj = simba_state_obj[state_value]['district'];

					var j = 1;

					for(var key in js_simba_district_obj)
					{
						var district_key = key;
						var district_value = js_simba_district_obj[key];
						
						district_option.options[j] = new Option(district_value, district_key);

						if(district_key == '<?= $simba_home_district; ?>')
						{
							district_option.options[j].selected = 'selected';
						}

						j++;
					}
				}
				else
				{
					removeOptions(district_option);
					removeOptions(area_option);
				}
			}
			else
			{
				removeOptions(district_option);
				removeOptions(area_option);
			}
		}
	}

	function getArea()
	{
		area_option.options[0] = new Option('Select Area','');

		var state_value = document.getElementById('home_state').value;
		var district_value = document.getElementById('home_district').value;

		if(state_value && district_value)
		{
			if(simba_state_obj[state_value].hasOwnProperty(district_value))
			{
				if(simba_state_obj[state_value][district_value].hasOwnProperty('area'))
				{
					var js_simba_area_obj = simba_state_obj[state_value][district_value]['area'];

					var m = 1;

					for(var key in js_simba_area_obj)
					{
						var area_key = key;
						var area_value = js_simba_area_obj[key];
						
						area_option.options[m] = new Option(area_value, area_key);

						if(area_key == '<?= $simba_home_area; ?>')
						{
							area_option.options[m].selected = 'selected';
						}

						m++;
					}
				}
			}
		}
	}

	function removeOptions(selectbox)
	{
	    var n;
	    for(n = selectbox.options.length - 1; n > 0; n--)
	    {
	        selectbox.remove(n);
	    }
	}



	</script>
	<?php
}
?>