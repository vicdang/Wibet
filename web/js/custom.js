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

// var end = new Date('11/20/2022 11:00 PM');

// var _second = 1000;
// var _minute = _second * 60;
// var _hour = _minute * 60;
// var _day = _hour * 24;
// var timer;

// function showRemaining() {
//     var now = new Date();
//     var distance = end - now;
//     if (distance < 0) {

//         clearInterval(timer);
//         //document.getElementById('countdown').innerHTML = 'EXPIRED!';

//         return;
//     }
//     var days = Math.floor(distance / _day);
//     var hours = Math.floor((distance % _day) / _hour);
//     var minutes = Math.floor((distance % _hour) / _minute);
//     var seconds = Math.floor((distance % _minute) / _second);

//     $('.days_dash .digit').html(days);
//     $('.hours_dash .digit').html(hours);
//     $('.minutes_dash .digit').html(minutes);
//     $('.seconds_dash .digit').html(seconds);
//     //console.log(end);
// }

// timer = setInterval(showRemaining, 1000);



$(document).ready(function () {
    function addZero(i) {
        if (i < 10) {i = "0" + i}
        return i;
      } 

    
    function getMatch() { 
        $.ajax({
            url: "https://txstories.live/api/get-match-by-date/",
            type: "GET",
            success: function(res) {
                match_list = JSON.parse(res);
                // match_list.reverse();
                match_list.sort(function(a, b) {
                    var keyA = new Date(a.local_date),
                      keyB = new Date(b.local_date);
                    // Compare the 2 dates
                    if (keyA < keyB) return -1;
                    if (keyA > keyB) return 1;
                    return 0;
                });
                
                match_list.forEach(match => {
                    let local_date = new Date(match.local_date);
                    let date = new Date(local_date.getTime() + 4 * 60 * 60000);
                    
                    // console.log(date);
                    // console.log(date.getMonth());
                    if(match.time_elapsed == "finished"){
                        match_time = match.home_score + ' - ' + match.away_score;
                    }else if(match.time_elapsed == "notstarted"){
                        match_time = date.getHours()+':'+ addZero(date.getMinutes());
                    }else{
                        match_time = match.home_score + ' - ' + match.away_score + '<br><small>Ongoing</small>';
                    }

                    let content = ' <li class="match-current-item col-lg-12"><div class="row col-lg-12"><div class="col-lg-4 col-xs-12"> <div class="match-team col-lg-12"><div class="title">'+match.home_team_en+'</div><img src="'+match.home_flag+'" alt=""> </div></div>\
                            <div class="col-lg-4 col-xs-12 text-center">\
                                <h4>'+date.getDate() +"/"+ (date.getMonth()+1) +"/" + date.getFullYear()+'</h4><h2>'+ match_time+'</h2>\
                            </div>\
                            <div class="col-lg-4 col-xs-12">\
                                <div class="match-team col-lg-12">\
                                    <div class="title">'+match.away_team_en+'</div>\
                                    <img src="'+match.away_flag+'" alt="">\
                                </div>\
                            </div>\
                        </div>\
                    </li>\
                    <li class="match-current-item"> <hr></li>';
                    $("#loading").css('display','none');
                    
                    $('#match-list').append(content);
    
                });

            },
            cache: false,
    
          });
    }

    getMatch();

});