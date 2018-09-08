// // Set the date we're counting down to
// var countDownDate = new Date("Jun 14, 2018 10:00:00").getTime();
//
// // Update the count down every 1 second
// var x = setInterval(function() {
//
//     // Get todays date and time
//     var now = new Date().getTime();
//
//     // Find the distance between now an the count down date
//     var distance = countDownDate - now;
//
//     // Time calculations for days, hours, minutes and seconds
//     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//
//     // Display the result in the element with id="demo"
//     if (document.getElementById("clockCountdown")) {
//         document.getElementById("clockCountdown").innerHTML = days + "d " + hours + "h "
//             + minutes + "m " + seconds + "s ";
//
//         // If the count down is finished, write some text
//         if (distance < 0) {
//             clearInterval(x);
//             document.getElementById("clockCountdown").innerHTML = "Gooooooaaaaalllll!!!!";
//         }
//     }
// }, 1000);

var clock;

$(document).ready(function() {

    var currentDate = new Date().getTime() / 1000;
    var futureDate  = new Date("Sep 18, 2018 11:55:00").getTime() / 1000;
    var diff = futureDate - currentDate;

    clock = $('.clock').FlipClock(diff, {
        clockFace: 'DailyCounter',
        countdown: true
    });
});
