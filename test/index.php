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
        h1{
             text-align: center; 
        }
        h2,h3{
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
    <h1>本网站专为USTC使用</h1>
    <h2>录分请在对局前征求场上四人的同意</h2>
    <h2>采用ML规则，+50/+10/-10/-30处理</h2>
    <h2>若有同分，则均分额外点数</h2>
    <h2>约雀时请确保走前再次点击"确认"以取消</h2>
    <h2>“我的”内可查看个人数据</h2>
    <h2>“查询战绩”可查看他人数据</h2>
    <h2>不建议经常修改密码</h2>
    <h2>排行榜实时更新，场数为0不会排入</h2>
    <h2>服务器很脆弱，拒绝多次提交</h2>
    <h2>杜绝一切不正打、违法行为</h2>
    <h2>祝获得更好的打雀体验</h2>
    <h3>若要改名/提建议请联系管理</h3>
    <h3>或发送至3345039979@qq.com</h3>
    
    <h5>域名还在申请，将就用下ip算了</h5>
</body>
</html>
