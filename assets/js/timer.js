function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }

        if(timer == 0){
            var getUrl = window.location;
            var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
            var logout = 1;
            $.ajax({
                url: baseUrl+'logout.php',
                type: 'POST',
                data: logout,
                success: function(result){
                    alert("Sessão expirada");
                }
            });
        }
    }, 1000);
}

window.onload = function () {
    var oneHour = 60 * 60,
        display = document.querySelector('#time');
    startTimer(oneHour, display);
};