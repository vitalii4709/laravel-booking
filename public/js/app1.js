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
        source: base_url + "/searchCities", /* Lecture 17 */
        //source: ["London", "New York", "Warsaw", "Berlin", "Auckland", "Johannesburg", "Dubai"],
        minLength: 2,
        select: function (event, ui) {
            
            console.log(ui.item.value);
        }


    });
});



//room.php /* Lecture 20 deleted code under this line */

