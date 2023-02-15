/*
import './bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
*/
$(function () {
    $(".datepicker").datepicker();
});


$(function () {
    $(".autocomplete").autocomplete({
        source: base_url + "/searchCities", 
        //source: ["London", "New York", "Warsaw", "Berlin", "Auckland", "Johannesburg", "Dubai"],
        minLength: 2,
        select: function (event, ui) {
            
            console.log(ui.item.value);
        }


    });
});





