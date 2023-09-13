

let alertMessage = (function() {
    function alertMessage() {}
    alertMessage.prototype.error = function(message) {
        let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<strong>Error!</strong>'+' '+
                        '<span id="pesanErr">'+message+'</span>'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>';
        return html;
    };
    alertMessage.prototype.success = function(message) {
        let html = '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                        '<strong>Success!</strong>'+' '+
                        '<span>'+message+'</span>'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>';
        return html;
    };
    return alertMessage;
})();

function hanyaAngka(target){
    $(target).keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
}


// Let the magic of JavaScript start here
function getTime(){
    var today = new Date();
    var currHr = today.getHours();
    var currMin = today.getMinutes();
    var currSec = today.getSeconds();

    var month = new Array(12);
    month[1] =  "Januari";
    month[2] = "Februari";
    month[3] = "Maret";
    month[4] = "April";
    month[5] = "Mei";
    month[6] = "Juni";
    month[7] = "Juli";
    month[8] = "Agustus";
    month[9] = "September";
    month[10] = "Oktober";
    month[11] = "November";
    month[12] = "Desember";

    var tgl = today.getDate() + ' ' + month[today.getMonth()] + ' ' + today.getFullYear();

    var weekday = new Array(7);
    weekday[0] =  "Minggu";
    weekday[1] = "Senin";
    weekday[2] = "Selasa";
    weekday[3] = "Rabu";
    weekday[4] = "Kamis";
    weekday[5] = "Jum'at";
    weekday[6] = "Sabtu";
    var weekDay = weekday[today.getDay()];
    var greeting = '';
    var hours = currHr;
    var currTime = '';
    if(currHr <= 12){
      hours = hours;
    }
    if(currHr < 12){
      greeting = 'Selamat Pagi';
      hours = hours;
    }else if (currHr < 18){
      greeting = 'Selamat Siang';
    }else{
      greeting = 'Selamat Malam';
    }
    if(currMin < 10){
      currMin = "0" + currMin;
    }  
    if(currSec < 10){
      currSec = "0" + currSec;
    }
  
    currTime = hours + " : " + currMin + " : " + currSec
  
    $("#jam").html(greeting + " | " + weekDay + ', ' + tgl + " | " + currTime);
  }
  
  setInterval(function(){ getTime() });