$(document).ready(function(){
//输入框获得焦点
$("input").focus(function(event) {
    $(this).next(".bottomline").animate({"width": "100%"},500);
});
//输入框失去焦点时
$("input").blur(function(event) {
    $(this).next(".bottomline").animate({"width": "0"}, 500);
}); 
});   

 
function closeside(){
    if (document.getElementById("Side").style.width < "10%")
    {
    document.getElementById("main").style.width = "85%"
    document.getElementById("Side").style.width = "15%";
    }
    else {
        document.getElementById("main").style.width = "100%"
        document.getElementById("Side").style.width = "0%";
    }
}

function getdate(){
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth();
    var day = date.getDate();
    var hour = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var weekArr = ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'];
    var week = weekArr[date.getDay()];
       document.getElementById("Time").innerHTML = year+"年"+month+"月"+day+"日      "+ week+"    "+hour+":"+minutes+":"+seconds;
}

setInterval('getdate()',1000);

function up_down(){
    var $link = document.getElementById("linkid");
    if ($link.style.height>"50%"){
        $link.style.height="20%";
    }else{
        $link.style.height="80%";
    }
}