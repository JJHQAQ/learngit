function Pause(){
    var moveis=document.getElementById('video');
    if (moveis.paused)
    {
        moveis.play();
        document.getElementById('play-pause').setAttribute("class","music-pause");
    }else{
        moveis.pause();
        document.getElementById('play-pause').setAttribute("class","music-play");
    }
}