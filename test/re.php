<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
    $conn = mysqli_connect('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('服务器连接失败');
    $conn->query("SET NAMES 'UTF8'");
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $password3 = $_POST['password3'];
    $name=$_SESSION['username'];
    $sql = "select * from user where username = '$name' and password=$password or die('密码错误')";
    $res = mysqli_query($conn, "select * from user where username = '{$name}' and password='{$password}';");
    if (!$res) {
        printf("密码错误: %s\n", mysqli_error($conn));
        echo("<a href='remake.html'><br/>点击返回</a>");
        exit();
    }
    $rew = mysqli_fetch_assoc($res);
    if (!$rew) {
        printf("密码错误 ");
        echo("<a href='remake.html'><br/>点击返回</a>");
        exit();
    }
    if($password2!==$password3)
    {
        die('两次密码不一致');
        echo("<a href='remake.html'><br/>点击返回</a>");
        exit();
    }
    if (strlen($password2) < 8) {
        die('密码长度应大于等于8');
        echo("<a href='remake.html'><br/>点击返回</a>");
    }

    if (!((preg_match('/[a-z]/', $password2) || preg_match('/[A-Z]/', $password2)) && preg_match('/[0-9]/', $password2) )) {
        die('密码应至少包含大小写字母和数字');
        echo("<a href='remake.html'>点击返回</a>");
    }
    mysqli_query($conn,"UPDATE user SET password='{$password2}' WHERE username='{$name}'");
    echo("修改成功<br/><a href='index.html'>点击返回首页</a>")
    ?>