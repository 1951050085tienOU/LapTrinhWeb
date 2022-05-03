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


let mychart = document.getElementsByClassName("mychart");

let massPopchart = new Chart(mychart[0], {
    type:'bar',
    data:{
        labels:['Recent Month', 'Total'],
        datasets:[{
            label:"Electricity",
            data:[40, 60]
        }]
    }, 
    option:{

    }
});


// fetch('server.php').then((res)=>res.json()).then(response=>{
//     console.log(response);
// }).catch(error => console.log(error));