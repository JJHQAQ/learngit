<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel = "stylesheet" type="text/css" href="css/index.css">
        <link rel = "stylesheet" type="text/css" href="css/regist.css">
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/JJH.js"></script>
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
    <div class="registdiv">

    <h2> register</h2>
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

            <div class="inputclass">
            <label for="email">Email</label>
            <input  type="email" name="email" required>
            <div class="bottomline"></div>
            </div>

            <button class="btn" type="submit">Sign Up
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </form>


        <div class="registresult">
        <?php 
        $name = $_POST['name'];
        $password = $_POST['Password'];

        if ($name=='' && $password=='') {return;}

        $icon = new mysqli("localhost","root","12345678","my_web_user");
        if ($icon->connect_error)
        {
            echo "数据库连接失败!无法完成注册" . $icon->connect_error;
            return;
        }
        
        $sql = "SELECT user_name FROM user_inf WHERE user_name='" . $name . "' LIMIT 1;";
        $result = $icon->query($sql);
        
        if ($result->num_rows > 0)
        {
            echo "该用户名已被使用!";
            return;
        }
        if (strlen($password)<6) {
            echo "密码不能小于六个字符！";
            return;
        }

        $sql = "INSERT INTO user_inf (user_name,user_password,regist_date,user_email)
            values
            ('" .$name ."',md5('".$password."'),NOW(),'".$_POST['email']."')";
        
        if ($icon->query($sql) == TRUE){
            echo "用户注册成功,3秒后为你跳转到登录页.";
            header("Refresh:3;url=index.php");
        }else{
            echo "Error: " . $sql . "<br>" . $icon->error;
        }
        
        $icon->close();
        ?>
        </div>


    </div>
</div>

    
    </body>
</html>