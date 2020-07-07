<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel = "stylesheet" type="text/css" href="css/index.css">
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

        <br/><br/><br/>
        <div class="div2">
            <h2>Login</h2>
            <form action="" method="post">
            <div class="inputclass">
            <label for="name">Username</label>
            <input  type="text" name="name" required>
            
            <div class="bottomline"></div>
            </div>
            
            <div class="inputclass">
            <label for="Password">Password</label>
            <input  type="password" name="Password" required>
            <div class="bottomline"></div>
            </div>
        <div class="passresult">
        <?php


        function resultF(){

        $name = $_POST['name'];
        $password = $_POST['Password'];
        if ($name=='' && $password=='') {return;}
            
        $icon = new mysqli("localhost","root","12345678","my_web_user");
        if ($icon->connect_error)
        {
            echo "数据库连接失败!无法完成注册" . $icon->connect_error;
            return;
        }

        $sql = "SELECT user_name,user_password FROM user_inf WHERE user_name='" . $name . "' LIMIT 1;";
        $result = $icon->query($sql);
        
        if ($result->num_rows > 0)
        {
            $tmp = $result->fetch_assoc();
            if($tmp['user_password']==md5($password))
            {
                echo "密码正确<br/>三秒钟后为你跳转页面";
                $_SESSION['name'] = $name;
                header("Refresh:3;url=links.php");
            }else{
                echo "密码错误！";
                // echo $tmp['user_password'];
                // echo $password;
            }
            return ;
        }else{
            echo"用户名不存在！";
            return ;
        }
        
        return;
        }

        resultF();

        ?>
        </div>
            <button class="btn" type="submit">Sign In
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </form>
        <a href="regist.php">
        <button class="btn" >Sign Up
                <span></span>
                <span></span>
                <span></span>
                <span></span>
        </button>
        </a>
        </div>
</div>

    
    </body>
</html>