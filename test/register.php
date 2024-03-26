<?php    header ( "Content-type:text/html;charset=utf-8" );

    $conn = mysqli_connect('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('数据库连接失败');

    $conn->set_charset('utf8');
    
    
    $username = $_POST['username'];

    $password = $_POST['password'];
    $password2=$_POST['password2'];
    $phone = $_POST['phone'];
    if(!$username)
    { 
        die('用户名不能为空');
        echo("<a href='register.html'>点击返回</a>");
    }
    if($password!==$password2)
    {
        die('两次密码不一致');
        echo("<a href='register.html'>点击返回</a>");
    }
    $conn = new mysqli('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('数据库连接失败');
    $sq = "SELECT * FROM user WHERE username='{$username}' ";
    $resul = $conn->query($sq);
    $ro = $resul->fetch_assoc();
    if($ro){
        die('已重名');
        echo("<a href='register.html'>点击返回</a>");
    }

    if (strlen($password) < 8) {
        die('密码长度应大于等于8');
        echo("<a href='register.html'>点击返回</a>");
    }

    if (!((preg_match('/[a-z]/', $password) || preg_match('/[A-Z]/', $password)) && preg_match('/[0-9]/', $password) )) {
        die('密码应至少包含大小写字母和数字');
        echo("<a href='register.html'>点击返回</a>");
    }
    $sql = "INSERT INTO user(id,username,phone,password) 

                VALUES (null,'{$username}' ,'{$phone}','{$password}')";

    mysqli_query($conn,$sql) or die(mysqli_error($conn));

    echo("注册成功<br/><a href='login.html'>点击返回登录</a>")     ?>