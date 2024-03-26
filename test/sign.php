<?php    header ( "Content-type:text/html;charset=utf-8" );

    $conn = mysqli_connect('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('数据库连接失败');
    $conn->set_charset('utf8');
    $username1 = $_POST['username1'];
    $username2 = $_POST['username2'];
    $username3 = $_POST['username3'];
    $username4 = $_POST['username4'];
    if($username1==$username2) die('一个牌桌没有两个一样的人');
    if($username1==$username3) die('一个牌桌没有两个一样的人');
    if($username1==$username4) die('一个牌桌没有两个一样的人');
    if($username3==$username2) die('一个牌桌没有两个一样的人');
    if($username4==$username2) die('一个牌桌没有两个一样的人');
    if($username3==$username4) die('一个牌桌没有两个一样的人');
    $sql1 = "select * from user where username = '$username1' or die('请您检查输入是否正确，系统没有在管理员名单中找到东家')";
    $sql2 = "select * from user where username = '$username2' or die('请您检查输入是否正确，系统没有在管理员名单中找到南家')";
    $sql3 = "select * from user where username = '$username3' or die('请您检查输入是否正确，系统没有在管理员名单中找到西家')";
    $sql4 = "select * from user where username = '$username4' or die('请您检查输入是否正确，系统没有在管理员名单中找到北家')";
    $res = mysqli_query($conn, "select * from user where username = '{$username1}';");
    if(!$res) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到东家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $rew = mysqli_fetch_assoc($res);
    if(!$rew) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到东家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $res = mysqli_query($conn, "select * from user where username = '{$username2}';");
    if(!$res) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到南家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $rew = mysqli_fetch_assoc($res);
    if(!$rew) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到南家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $res = mysqli_query($conn, "select * from user where username = '{$username3}';");
    if(!$res) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到西家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $rew = mysqli_fetch_assoc($res);
    if(!$rew) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到西家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $res = mysqli_query($conn, "select * from user where username = '{$username4}';");
    if(!$res) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到北家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $rew = mysqli_fetch_assoc($res);
    if(!$rew) {
        echo "<script>alert('请您检查输入是否正确，系统没有在管理员名单中找到北家')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $sd[1] = $_POST['pt1'];
    $sd[2] = $_POST['pt2'];
    $sd[3] = $_POST['pt3'];
    $sd[4] = $_POST['pt4'];    
    if(($sd[1]+$sd[2]+$sd[3]+$sd[4])!==100000) 
    {
        echo "<script>alert('总数不为100000')</script>";
        echo("<a href='index.php'>点击返回首页</a>");  
        exit();        
    }
    $cnt[1]=$cnt[2]=$cnt[3]=$cnt[4]=0;
    for($i=1;$i<=4;$i+=1)
    {
        for($j=1;$j<=4;$j+=1)
        {
            if($sd[$i]<$sd[$j]) $cnt[$i]+=1;
        }
        $dnt[$i-1]=0;
    }
    for($i=1;$i<=4;$i+=1)
    {
        $dnt[$cnt[$i]]+=1;
    }
    $sum[0]=500;$sum[1]=100;$sum[2]=-100;$sum[3]=-300;
    $pt1=($sd[1]-30000)/100+$sum[$cnt[1]]/$dnt[$cnt[1]];
    $pt2=($sd[2]-30000)/100+$sum[$cnt[2]]/$dnt[$cnt[2]];
    $pt3=($sd[3]-30000)/100+$sum[$cnt[3]]/$dnt[$cnt[3]];
    $pt4=($sd[4]-30000)/100+$sum[$cnt[4]]/$dnt[$cnt[4]];
    $time=time();
    $sql = "INSERT INTO data(username1,username2,username3,username4,sd1,sd2,sd3,sd4,pt1,pt2,pt3,pt4,ime)    VALUES ('{$username1}','{$username2}','{$username3}','{$username4}','{$sd[1]}' ,'{$sd[2]}','{$sd[3]}','{$sd[4]}','{$pt1}','{$pt2}','{$pt3}','{$pt4}','{$time}')";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
    mysqli_query($conn,"UPDATE user SET score=score+$pt1 WHERE username='{$username1}'");
    mysqli_query($conn,"UPDATE user SET score=score+$pt2 WHERE username='{$username2}'");
    mysqli_query($conn,"UPDATE user SET score=score+$pt3 WHERE username='{$username3}'");
    mysqli_query($conn,"UPDATE user SET score=score+$pt4 WHERE username='{$username4}'");
    mysqli_query($conn,"UPDATE user SET sum=sum+1 WHERE username='{$username1}'");
    mysqli_query($conn,"UPDATE user SET sum=sum+1 WHERE username='{$username2}'");
    mysqli_query($conn,"UPDATE user SET sum=sum+1 WHERE username='{$username3}'");
    mysqli_query($conn,"UPDATE user SET sum=sum+1 WHERE username='{$username4}'");
    echo("提交成功<br/><a href='index.php'>点击返回首页</a>")     ?>