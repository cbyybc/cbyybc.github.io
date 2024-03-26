<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(!isset($_SESSION['username'])) { $_SESSION['username']=false;};
$name = $_SESSION['username'];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=0.3">
    <title>USTC麻将部</title>
    <style>
        /* 样式可以根据需要进一步完善 */
        nav {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .user-area {
            float: right;
            margin-right: 20px;
        }
        table {
        width: 400px;
        border-top: 1px solid #999;
        border-left: 1px solid #999;
        border-right: 1px solid #999;
        border-bottom: 1px solid #999;
        text-align: center;
        }
        .number {
          text-align: center;
        }
        .text {
          text-align: center;
        }
        .table_one {
            border-spacing: 15px 10px;
        }
        .table_two {
            margin-left: 20px;
            border-spacing: 20px;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">主页</a>
        <a href="signin.php">录分</a>
        <a href="data.php">约雀</a>
        <a href="records.php">对局记录</a>
        <a href="leaderboard.php">排行榜</a>
        <a href="query.php">查询战绩</a>
        <div class="user-area">
        <?php if(!$name) { ?>
            <a href="login.html">登录</a>
            <a href="register.html">注册</a>
        <?php } ?>
        
        <?php if($name) { ?>
            <a href="profile.php">我的</a> 
            <a href="remake.php">重设密码</a>
            <a href="quit.php">注销</a> 
        <?php } ?>
        </div>
    </nav>
    <h1>仅展示最近30局</h1>
    <?php
        header ( "Content-type:text/html;charset=utf-8" );
        $conn = new mysqli('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('数据库连接失败');
        $sql = "SELECT * FROM data ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            $i=0;
            while($row = $result->fetch_assoc()) {
                if($i>30) break;
                $username1=$row["username1"];
                $username2=$row["username2"];
                $username3=$row["username3"];
                $username4=$row["username4"];
                $sd1=$row["sd1"];
                $sd2=$row["sd2"];
                $sd3=$row["sd3"];
                $sd4=$row["sd4"];
                $pt1=(float)($row["pt1"])/10.0;
                $pt2=(float)($row["pt2"])/10.0;
                $pt3=(float)($row["pt3"])/10.0;
                $pt4=(float)($row["pt4"])/10.0;
                $t=$row["ime"];
    ?>
            <h2 style="color:green" align="center"><?php echo(date("m-d H:i",$t)); ?></h2>
            <table align="center">
                <thead>
                    <tr>
                        <th style="color:#FF1493"><?php echo $result->num_rows-$i; ?></th>
                        <th>东家</th>
                        <th>南家</th>
                        <th>西家</th>
                        <th>北家</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo "id" ?></td>
                        <td><?php echo $username1 ?></td>
                        <td><?php echo $username2 ?></td>
                        <td><?php echo $username3 ?></td>
                        <td><?php echo $username4 ?></td>
                    </tr>
                    <tr>
                        <td><?php echo "点数" ?></td>
                        <td><?php echo $sd1 ?></td>
                        <td><?php echo $sd2 ?></td>
                        <td><?php echo $sd3 ?></td>
                        <td><?php echo $sd4 ?></td>
                    </tr>
                    <tr>
                        <td><?php echo "pt" ?></td>
                        <td><?php 
                        if($pt1>0)
                        echo  "<font color=green>$pt1</font>"; 
                        else
                        echo  "<font color=red>$pt1</font>"; 
                        ?></td>
                        <td><?php 
                        if($pt2>0)
                        echo  "<font color=green>$pt2</font>"; 
                        else
                        echo  "<font color=red>$pt2</font>"; 
                         ?></td>
                        <td><?php 
                        if($pt3>0)
                        echo  "<font color=green>$pt3</font>"; 
                        else
                        echo  "<font color=red>$pt3</font>"; 
                         ?></td>
                        <td><?php 
                        if($pt4>0)
                        echo  "<font color=green>$pt4</font>"; 
                        else
                        echo  "<font color=red>$pt4</font>"; 
                         ?></td>
                    </tr>
                </tbody>
            </table>
    <?php
                $i++;
            }
        } else {
            echo "0 结果";
        }
        $conn->close();
    ?>
</body>
</html>
