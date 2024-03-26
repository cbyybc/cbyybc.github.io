<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=0.3">
    <title>USTC麻将部</title>
    <style>
        /* 样式可以根据需要进一步完善 */
        h1{
             text-align: center; 
        }
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
        .single-line{
            white-space: pre;
            font-weight: bold;
            font-size:28px;
            color:#FF1493;
        }
        p{
            display: inline;
        }
        .aligncenter {
            clear: both;
            display: block;
            margin: auto;
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
        <?php { ?>
            <a href="profile.php">我的</a>
            <a href="remake.php">重设密码</a> 
            <a href="quit.php">注销</a> 
        <?php } ?>
        </div>
    </nav>
    <div align="center">
    <?php
        header ( "Content-type:text/html;charset=utf-8" );
        $conn = new mysqli('0.0.0.0:3306','admin','Y7zHXxFBe2iBae8K','user') or die('数据库连接失败');
        $name = $_POST['username'];
        $sq = "SELECT * FROM user WHERE username='{$name}' ";
        if(!$sq) die("未查到该用户名");
        $resul = $conn->query($sq);
        if(!$resul) die("未查到该用户名");
        $ro = $resul->fetch_assoc();
        if(!$ro) die("未查到该用户名");
        ?>
        <h1> ID/场数/PT </h1>
        <h1><?php echo $name."/".$ro["sum"]."/".(float)$ro["score"]/10.0 ?></h1>
        <p class="single-line">近10场对局位次:   </p>
        <?php
            $cnt[1]=0;$cnt[2]=0;$cnt[3]=0;$cnt[4]=0;
            $sql = "SELECT * FROM data WHERE username1='{$name}' or username2='{$name}' or username3='{$name}' or username4='{$name}' ORDER BY id DESC";
            $result = $conn->query($sql);
            $sum=0;$br=10;
            if ($result->num_rows > 0) {
                // 输出数据
                $i=1;
                while($row = $result->fetch_assoc()) {
                    $username1=$row["username1"];
                    $username2=$row["username2"];
                    $username3=$row["username3"];
                    $username4=$row["username4"];
                    $sd1=$row["sd1"];
                    $sd2=$row["sd2"];
                    $sd3=$row["sd3"];
                    $sd4=$row["sd4"];
                    $ar="";
                    if($name==$username1) {
                        $x=1;
                        if($sd1<$sd2) $x+=1;
                        if($sd1<$sd3) $x+=1;
                        if($sd1<$sd4) $x+=1;
                        if($i<=10)
                        $t[$i]=$x;
                        $cnt[$x]++;
                        $sum+=$sd1;
                    }
                    if($name==$username2) {
                        $x=1;
                        if($sd2<$sd1) $x+=1;
                        if($sd2<$sd3) $x+=1;
                        if($sd2<$sd4) $x+=1;
                        if($i<=10)
                        $t[$i]=$x;
                        $cnt[$x]++;
                        $sum+=$sd2;
                    }
                    if($name==$username3) {
                        $x=1;
                        if($sd3<$sd1) $x+=1;
                        if($sd3<$sd2) $x+=1;
                        if($sd3<$sd4) $x+=1;
                        if($i<=10)
                        $t[$i]=$x;
                        $cnt[$x]++;
                        $sum+=$sd3;
                    }
                    if($name==$username4) {
                        $x=1;
                        if($sd4<$sd1) $x+=1;
                        if($sd4<$sd2) $x+=1;
                        if($sd4<$sd3) $x+=1;
                        if($i<=10)
                        $t[$i]=$x;
                        $cnt[$x]++;
                        $sum+=$sd4;
                    }
                    $i+=1;
                }
                $br=0;
                for($k=10;$k>=1;$k-=1)
                {
                    if(isset($t[$k]))
                    {    ?><p class="single-line"><?php echo $t[$k]; ?></p><?php }
                    else{$br++;}
                    if($k===6) {    ?><p class="single-line"><?php echo " "; ?></p><?php }
                }
            }
        ?>
        <br>
        <?php
        if($br===0){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>,<?php echo $t[4] ?>,<?php echo $t[5] ?>,<?php echo $t[6] ?>,<?php echo $t[7] ?>,<?php echo $t[8] ?>,<?php echo $t[9] ?>,<?php echo $t[10] ?>" class="aligncenter"/>
        <?php
        }if($br===1){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>,<?php echo $t[4] ?>,<?php echo $t[5] ?>,<?php echo $t[6] ?>,<?php echo $t[7] ?>,<?php echo $t[8] ?>,<?php echo $t[9] ?>" class="aligncenter"/>
        <?php
        }if($br===2){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>,<?php echo $t[4] ?>,<?php echo $t[5] ?>,<?php echo $t[6] ?>,<?php echo $t[7] ?>,<?php echo $t[8] ?>" class="aligncenter"/>
        <?php
        }if($br===3){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>,<?php echo $t[4] ?>,<?php echo $t[5] ?>,<?php echo $t[6] ?>,<?php echo $t[7] ?>" class="aligncenter"/>
        <?php
        }if($br===4){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>,<?php echo $t[4] ?>,<?php echo $t[5] ?>,<?php echo $t[6] ?>" class="aligncenter"/>
        <?php
        }if($br===5){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>,<?php echo $t[4] ?>,<?php echo $t[5] ?>" class="aligncenter"/>
        <?php
        }if($br===6){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>,<?php echo $t[4] ?>" class="aligncenter"/>
        <?php
        }if($br===7){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>,<?php echo $t[3] ?>" class="aligncenter"/>
        <?php
        }if($br===8){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>,<?php echo $t[2] ?>" class="aligncenter"/>
        <?php
        }if($br===9){
        ?>
        <img src="zhexian.php?a=<?php echo $t[1] ?>" class="aligncenter"/>
        <?php } ?>
        <br>
        <?php $summ=$cnt[1]+$cnt[2]+$cnt[3]+$cnt[4];?>
        <?php if($summ!==0) { ?>
        <p class="single-line">总顺位分布：<?php echo $cnt[1]."(".(int)(100*$cnt[1]/$summ)."%) ".$cnt[2]."(".(int)(100*$cnt[2]/$summ)."%) ".$cnt[3]."(".(int)(100*$cnt[3]/$summ)."%) ".$cnt[4]."(".(int)(100*$cnt[4]/$summ)."%) " ?></p>
        <img src="bing.php?a=<?php echo $cnt[1] ?>,<?php echo $cnt[2] ?>,<?php echo $cnt[3] ?>,<?php echo $cnt[4] ?>" class="aligncenter"/>
        
        <h5 align="center">深绿一位，浅绿二位，黄色三位，红色四位</h5>
        <p class="single-line">总场均点：<?php echo (int)($sum/$summ) ?></p>
        <?php }?>
        <h1>最近30场数据</h1>
    <?php    
        $sql = "SELECT * FROM data WHERE username1='{$name}' or username2='{$name}' or username3='{$name}' or username4='{$name}' ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            $i=1;
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
                $ar="";
                $tt=$row["ime"];
                if($name==$username1) {
                    $x=1;
                    if($sd1<$sd2) $x+=1;
                    if($sd1<$sd3) $x+=1;
                    if($sd1<$sd4) $x+=1;
                    if($x===1) $ar="一";
                    if($x===2) $ar="二";
                    if($x===3) $ar="三";
                    if($x===4) $ar="四";
                    $t[30-$i]=$x;
                }
                if($name==$username2) {
                    $x=1;
                    if($sd2<$sd1) $x+=1;
                    if($sd2<$sd3) $x+=1;
                    if($sd2<$sd4) $x+=1;
                    if($x===1) $ar="一";
                    if($x===2) $ar="二";
                    if($x===3) $ar="三";
                    if($x===4) $ar="四";
                    $t[30-$i]=$x;
                }
                if($name==$username3) {
                    $x=1;
                    if($sd3<$sd1) $x+=1;
                    if($sd3<$sd2) $x+=1;
                    if($sd3<$sd4) $x+=1;
                    if($x===1) $ar="一";
                    if($x===2) $ar="二";
                    if($x===3) $ar="三";
                    if($x===4) $ar="四";
                    $t[30-$i]=$x;
                }
                if($name==$username4) {
                    $x=1;
                    if($sd4<$sd1) $x+=1;
                    if($sd4<$sd2) $x+=1;
                    if($sd4<$sd3) $x+=1;
                    if($x===1) $ar="一";
                    if($x===2) $ar="二";
                    if($x===3) $ar="三";
                    if($x===4) $ar="四";
                    $t[30-$i]=$x;
                }
    ?>
            
            <table align="center">
                <thead>
                    <tr>
                        <th style="color:green"><?php echo(date("m-d H:i",$tt)); ?></th>
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
                        ?>
                    </td>
                    <?php
                    echo "<h2 style=\"color:green;text-align:center\">$ar</h2>"; 
                    if($name==$username1)
                        if($pt1>0)
                        echo  "<h2 style=\"color:green;text-align:center\">+$pt1</h2>"; 
                        else
                        echo  "<h2 style=\"color:red;text-align:center\">$pt1</h2>"; 
                    if($name==$username2)
                        if($pt2>0)
                        echo  "<h2 style=\"color:green;text-align:center\">+$pt2</h2>"; 
                        else
                        echo  "<h2 style=\"color:red;text-align:center\">$pt2</h2>"; 
                    if($name==$username3)
                        if($pt3>0)
                        echo  "<h2 style=\"color:green;text-align:center\">+$pt3</h2>"; 
                        else
                        echo  "<h2 style=\"color:red;text-align:center\">$pt3</h2>"; 
                    if($name==$username4)
                        if($pt4>0)
                        echo  "<h2 style=\"color:green;text-align:center\">+$pt4</h2>"; 
                        else
                        echo  "<h2 style=\"color:red;text-align:center\">$pt4</h2>"; 
                    ?>
                    </tr>
                </tbody>
            </table>
            </div>
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
