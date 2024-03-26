<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
    $conn = mysqli_connect('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('服务器连接失败');
    $conn->query("SET NAMES 'UTF8'");
    $username = $_POST['username'];

    $sql = "select * from user where username = '$username'  or die('请您检查输入是否正确，系统没有在管理员名单中找到您')";
  

    $res = mysqli_query($conn, "select * from user where username = '{$username}';");
    
    if (!$res) {
        printf("发生错误: %s\n", mysqli_error($conn));
        exit();
    }
    $rew = mysqli_fetch_assoc($res);
    if (!$rew) {
        printf("发生错误: ");
        exit();
    }
    if($rew["zt"]!=="1"){
        mysqli_query($conn,"UPDATE user SET zt=1 WHERE username='{$username}'");
        echo "<script>alert('确认成功/请确认可以随叫随打，否则可再次点击确认以取消')</script>";
        $_SESSION['number']++;
        echo("<a href='index.php'>点击返回首页</a>");
    }

    else{
        mysqli_query($conn,"UPDATE user SET zt=0 WHERE username='{$username}'");
        echo "<script>alert('取消成功')</script>";
        $_SESSION['number']--;
        echo("<a href='index.php'>点击返回首页</a>");
    }  
    
    ?>