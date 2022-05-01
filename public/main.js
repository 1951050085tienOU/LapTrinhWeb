

function SetTimeHeader(){
    var toDay = new Date();
    timeString = "";
    preHour = 0;
    getMinute =  toDay.getMinutes();
    if(toDay.getHours()> 12)
    {
        preHour = toDay.getHours() - 12;
        timeString += preHour.toString() +":" +  getMinute.toString() + "  PM";
    }
    else {
        timeString += toDay.getHours().toString() + ":" +  getMinute.toString() + "  AM";
    }
    var dayOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    timeString += "   " + dayOfWeek[toDay.getDay()].toString()+ "     " + toDay.getDate() + "/"
    + toDay.getMonth().toString() + "/" + toDay.getFullYear().toString();
    
    var headerTime = document.getElementsByClassName('header--time');
    headerTime[0].innerHTML = timeString;

    

}