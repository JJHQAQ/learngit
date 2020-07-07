
function Pause(){
    // alert("skldjf");
    var music=document.getElementById('Music');
    if (music.paused)
    {
        music.play();
        document.getElementById('mymusic').style.animation="rotating 10s linear infinite";
        document.getElementById('play-pause').setAttribute("class","music-pause");
    }else{
        music.pause();
        document.getElementById('mymusic').style.animation="rotating 10s linear infinite paused";
        document.getElementById('play-pause').setAttribute("class","music-play");
    }
    
}