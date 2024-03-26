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
    <form action="sign.php" method="POST" >
        <div class="sign">
        <h1>录分</h1>
        <h3>请输入用户名</h3>
        <div style="text-align: center;">
        <label class="input-label">东家</label>
        <input class="input-control input-outline" type="text" name="username1">
        <label class="input-label">南家</label>
        <input class="input-control input-outline" type="text" name="username2">
        <label class="input-label">西家</label>
        <input class="input-control input-outline" type="text" name="username3">
        <label class="input-label">北家</label>
        <input class="input-control input-outline" type="text" name="username4">
        <br>
        <label class="input-label">点数</label>
        <input class="input-control input-outline" type="number" name="pt1">
        <label class="input-label">点数</label>
        <input class="input-control input-outline" type="number" name="pt2">
        <label class="input-label">点数</label>
        <input class="input-control input-outline" type="number" name="pt3">
        <label class="input-label">点数</label>
        <input class="input-control input-outline" type="number" name="pt4">
        </div>
        <h3>请确认总点数为100000点</h3>
        <h3>请确认未重复提交</h3>
        <div  style="text-align: center;">
        <button class="submit" type="submit">提交</button>
        </div>
        <br>
        </div>
    </form>
</body>
</html>
