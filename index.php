<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title></title>
    <script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
var burn = {
    calories: 1876,
    protein: 140,
    carbs: 235,
    fat: 42
}

var balance = {
    calories: 2338,
    protein: 175,
    carbs: 292,
    fat: 53
}

var create_clones = function(meals, profile) {
    for (i = 0; i < meals; i++) {
        var clone = $('#template').clone(true);
        $('[name=calories]', clone).val(window[profile].calories / meals);
        $('[name=protein]', clone).val(window[profile].protein / meals);
        $('[name=carbs]', clone).val(window[profile].carbs / meals);
        $('[name=fat]', clone).val(window[profile].fat / meals);

        $(clone).attr('id', 'clone_' + i);
        $('#work').append(clone);
        $('.clone-name', clone).text('Clone ' + i );
    }
}

var recalc = function() {
    var meals = $('#meals').val();
    profile = $('[name=profile]:checked').val();
    profile = window[profile];

    console.log(profile);

    var current = {
        calories: 0,
        fat: 0,
        protein: 0,
        carbs: 0
    }

    var count =0;

    $('[name=protein_real]').each(function(i, e){
        current.protein += parseInt($(e).val() || 0);
    });

    $('[name=fat_real]').each(function(i, e){
        current.fat += parseInt($(e).val() || 0);
    });

    $('[name=carbs_real]').each(function(i, e){
        current.carbs += parseInt($(e).val() || 0);
    });

    $('[name=calories_real]').each(function(i, e){
        if ($(e).val()) count++;

        current.calories += parseInt($(e).val() || 0);
    });

    remainder = {
        calories: profile.calories - current.calories,
        fat: profile.fat - current.fat,
        protein: profile.protein - current.protein,
        carbs: profile.carbs - current.carbs
    }

    $('[name=calories], [name=fat], [name=protein], [name=carbs]').each(function(i, e) {
        $(e).val(remainder[$(e).attr('name')] / (meals - count));
    });
}

var init_calculator = function() {
    var meals = $('#meals').val();
    var profile = $('[name=profile]').val();

    var i;

    create_clones(meals, profile);
}
jQuery(function($) {
    init_calculator();
    $('#recalc').click(function(e) { recalc();});
})
    </script>
</head>
<body>
Profile: <label for=""><input type="radio" name="profile" value="burn" />Burn</label>
<label for=""><input type="radio" name="profile" value="balance" />Balance</label>
<div>
Meals: <input type="text" name="meals" id="meals" value="5" /><br />
<input type="button" id="recalc" value="Recalc()" />
</div>
<br /><br />
<div style="display:none">
<div id="template">
    <span class="clone-name"></span><br />
    Carbs: <input type="text" name="calories"  /> <input type="text" name="calories_real" id="" /><br />
    Carbs: <input type="text" name="carbs"  /> <input type="text" name="carbs_real" id="" /><br />
    Protein: <input type="text" name="protein" id="" /> <input type="text" name="protein_real" id="" /><br />
    Fat: <input type="text" name="fat" /> <input type="text" name="fat_real" id="" /><br /><br />
</div>
</div>
<div id="work"></div>
</body>
</html>