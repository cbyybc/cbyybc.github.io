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
        }h1{
             text-align: center; 
        }
        h2{
             text-align: center; 
        }
        h3{
             text-align: center; 
        }
        h4{
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
            <script>
			    alert("请先登录")
                window.location.href = "index.php";
		    </script>
        <?php } ?>
        
        <?php if($name) { ?>
            <a href="profile.php">我的</a> 
            <a href="remake.php">重设密码</a>
            <a href="quit.php">注销</a> 
        <?php } ?>
        </div>
    </nav>
    <form action="datas.php" method="POST" >
        <div class="sign">
        <div style="text-align: center;">
        <h1>约雀</h1>
        <?php
            $number=0;
            $conn = mysqli_connect('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('服务器连接失败');
            $tz="1";
            $conn->query("SET NAMES 'UTF8'");
            $res = mysqli_query($conn, "select * from user where zt = '{$tz}';");
            if ($res) {
                while($rew = mysqli_fetch_assoc($res))
                {
                    $number++;
                }
            }
        ?>
        <h2>当前已有 <?php echo $number?> 人确认，分别是</h2>
        <?php
            $conn = mysqli_connect('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('服务器连接失败');
            $tz="1";
            $conn->query("SET NAMES 'UTF8'");
            $res = mysqli_query($conn, "select * from user where zt = '{$tz}';");
            if ($res) {
                while($rew = mysqli_fetch_assoc($res))
                {
                    ?><h3><?php echo $rew["username"]; ?></h3><?php
                }
            }
            
        ?>
        <h2>可替他人确认（请在当事人知晓下完成</h2>
        <h2>请保证确认后可以随开随打</h2>
        <h2>确认后再次点击则可取消确认</h2>
        
        <label class="input-label">用户名</label>
        <input class="input-control input-outline" type="text" name="username">
        <div  style="text-align: center;">
        <button class="submit" type="submit">确认</button>
        </div>
        </div>
        <br>
        </div>
    </form>
</body>
</html>
