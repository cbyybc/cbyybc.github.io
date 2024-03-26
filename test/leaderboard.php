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
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    
    /* Style the table */
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        text-align: center;
    }
    
    /* Style table headers */
    th {
        background-color: #f2f2f2;
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    
    /* Style table cells */
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    
    /* Alternate row colors */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    /* Highlight top row */
    tr:first-child {
        background-color: #ffc107; /* Yellow */
        font-weight: bold;
    }
    
    /* Style for rank number */
    .rank {
        width: 100px;
        text-align: center;
        font-weight:bold;
        color:red;
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
    <?php
    $conn = mysqli_connect('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('服务器连接失败');
    $result = mysqli_query($conn,"SELECT * FROM user ORDER BY score DESC ");
    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
       }
       ?>
    <table>
        <th style="text-align: center;">排名</th>
        <th style="text-align: center;">id</th>
        <th style="text-align: center;">场数</th>
        <th style="text-align: center;">pt</th>
    <?php
    $i=1;
    while($row = mysqli_fetch_array($result))
    { 
        if($row['sum']==='0') continue;
        ?>  
        <tr>
            <td class=rank><?php echo $i ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['sum']; ?></td>
            <td><?php echo (float)$row['score']/10.0; ?></td>
        </tr>
    <?php $i+=1; } ?>

    </table>
    
</body>
</html>
