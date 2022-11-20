$(document).ready(function () {
    $('.btn-cancel').on("click",function () { 
        let id = $('.btn-cancel').data('id');
        $('#cancel-popup').css('display', 'block');
        $('#cancel-popup .btn-do-cancel').attr('href','/match/cancel?id='+id);
        
     });

    $('.btn-close').on("click", function () { 
        $('#cancel-popup').css('display', 'none');

        $('#cancel-popup').attr('aria-hidden', false);
    });

});

var end = new Date('11/20/2022 11:00 PM');

var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour * 24;
var timer;

function showRemaining() {
    var now = new Date();
    var distance = end - now;
    if (distance < 0) {

        clearInterval(timer);
        //document.getElementById('countdown').innerHTML = 'EXPIRED!';

        return;
    }
    var days = Math.floor(distance / _day);
    var hours = Math.floor((distance % _day) / _hour);
    var minutes = Math.floor((distance % _hour) / _minute);
    var seconds = Math.floor((distance % _minute) / _second);

    $('.days_dash .digit').html(days);
    $('.hours_dash .digit').html(hours);
    $('.minutes_dash .digit').html(minutes);
    $('.seconds_dash .digit').html(seconds);
    //console.log(end);
}

timer = setInterval(showRemaining, 1000);