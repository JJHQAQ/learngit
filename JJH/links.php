
<?php
    session_start();
    $name = $_SESSION['name'];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel = "stylesheet" type="text/css" href="css/index.css">
        <link rel = "stylesheet" type="text/css" href="css/link.css">
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/JJH.js"></script>
        <link rel="icon" href="img/pic.ico" type="image/x-icon">
        <title>JJH's web</title>
    </head>
    <body>



        <div class="sidenav" id="Side">
            <a href="javascript:void(0)" class="closebtn"  onclick="closeside()" >&times;</a>
            <img src="img/head.jpg" class="head"></img>
            <br/><br/><br/><br/><br/><br/><br/>
            <p style="text-align: center;">JJH_QAQ</p>
            <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About me</a></li>
            <li><a href="music.html">Music</a></li>
            <li><a href="hometown.html">Hometown</a></li>
            <li><a href="campus.html">Campus</a></li>
            <li><a href="links.php">Links</a></li>
            <div class="left-open">
            <li ><a href="#">more</a></li>
            <div class="left-open-content">
                <ul>
                    <li><a href="Courses.html">picture</a></li>
                    <li><a href="books.html">picture_2</a></li>
                    <li><a href="movies.html">Movies</a></li>
                 </ul>   
                </div>
            </div>
            </ul>
            <div id="Time">
            </div>
        </div>


<div id="main">
    <div class="linkdiv" id="linkid">
        <h2>Links</h2>
        <p style="line-height: 20px;">
    <?php
        if ($name)
        {
        echo "欢迎你  ";
        echo $name;
        echo "<br/>现在你可以在这里添加你自己的链接了！<br/>";
        }
        else{
            echo "您现在是游客登录，注册并登录后可以在此处填加自己的链接";
        }
    ?>
        </p>
        
        <div class="div3" >
            <form action="links.php" method="post">            
        <div class="inputclass">
            <label for="url">url</label>
            <input  type="text" name="url" required>
            <div class="bottomline"></div>
        </div>
            <button class="btn" type="submit">ADD
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </form>
        <button class="btn" onclick="Click();">Delete
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        <?php
            if ($name)
            {
            $del = $_GET['del'];
            if ($del==TRUE){
            $icon = new mysqli("localhost","root","12345678","my_web_user");
            if ($icon->connect_error)
            {
                echo "数据库连接失败!" . $icon->connect_error;
                return;
            }
            $sql = "UPDATE user_inf SET url=NULL WHERE user_name='".$name."';";
            $result=$icon->query($sql);

            }else{
            $url = $_POST['url'];
            if ($url!="") {
            $icon = new mysqli("localhost","root","12345678","my_web_user");
            if ($icon->connect_error)
            {
                echo "数据库连接失败!" . $icon->connect_error;
                return;
            }
            $sql = "UPDATE user_inf SET url='".$url."' WHERE user_name='".$name."';";
            $result=$icon->query($sql);
            if (!$result) {
                echo "数据更新失败！";
            }
            mysqli_close($icon);
                    }
                }
            }
        ?>
        </div>
       <?php
        $icon = new mysqli("localhost","root","12345678","my_web_user");
        if ($icon->connect_error)
        {
            echo "数据库连接失败!" . $icon->connect_error;
            return;
        }
        $sql="SELECT user_name,url FROM user_inf WHERE user_name='".$name."' AND url IS NOT NULL;";
        $result = $icon->query($sql);
        if ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            echo "<p>你的链接：&nbsp;&nbsp;&nbsp;".$row['user_name'].":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
            "<a href='".$row['url']."'>".$row['url']."</a></p>";
        }else{
            echo "<p>你的链接：&nbsp;&nbsp;&nbsp;无</p>";
        }
        $sql="SELECT user_name,url FROM user_inf WHERE url IS NOT NULL AND user_name!='".$name."' ORDER BY rand() LIMIT 5;";
        $result=$icon->query($sql);
        if (!$result) {
            echo "url数据查找失败，或者没有数据";
        }
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            echo "<p>".$row['user_name'].":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
            "<a href='".$row['url']."'>".$row['url']."</a></p>";
        }
       
       ?>
        <div class="botm" onclick="up_down();">
            More↓
        </div>
    </div>
</div>

    <script>
    function Click(){
        // alert("sljdfl");
        location.href="links.php?del=TRUE";
    }
    </script>
    </body>
</html>