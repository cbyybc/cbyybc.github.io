<?php  
    //参数以a为参数名传入，a的文本形态应该是用“,”分割的若干数字连接的字符串   
    //这里首先判断a是否存在  
    if($_GET["a"]=="") die("0");  
    //将得到的数据分解，存入数组$shuju中  
    $shuju=preg_split("~,~",$_GET["a"]);  
    $xx=$shuju[0];
    $shuju[0]=$shuju[1];
    $shuju[1]=$xx;
    $xx=$shuju[2];
    $shuju[2]=$shuju[3];
    $shuju[3]=$xx;
    //再次判断数据的合法性，返回错误代码  
    if(count($shuju)==0) die("2");  
    //定义整个图形的宽度和高度   
    //读者可以根据需要修改这两个变量的值  
    $tukuan=300;  
    $tugao=150;  
      
    //定义一个数组，用来存放每一个色块的角度范围  
    $jiaodu = array();  
    //定义存贮数据和的变量  
    $total=0;  
    //遍历数组求和  
    for ($i = 0; $i < count($shuju); $i++) {  
        if(!is_numeric($shuju[$i])) die("1");  
        $shuju[$i]*=1000;  
        if($shuju[$i]===0) $shuju[$i]=5;
        }  
    for ($i = 0; $i < count($shuju); $i++) {  
    if(!is_numeric($shuju[$i])) die("1");  
    $total+=$shuju[$i];  
    }  
    //再次遍历，计算色块角度并存入数组  
    for ($i = 0; $i < count($shuju); $i++) {  
    array_push ($jiaodu, round(360*$shuju[$i]/$total));  
    }  
      
    //创建图像  
    $image = imagecreate($tukuan, $tugao);  
    //定义一个灰色背景色,这个颜色其实就是大家很熟悉的页面色系16进制数字表示的#EEEEEE  
    $white = imagecolorallocate($image, 0xEE, 0xEE, 0xEE);  
      
    //再定义10对深浅对应的彩色，存入二维数组  
    $yanse = array(  
    array(  
    imagecolorallocate($image, 0x97, 0xbd, 0x00),  
    imagecolorallocate($image, 0x00, 0x99, 0x00),  
    imagecolorallocate($image, 0xcc, 0x33, 0x00),  
    imagecolorallocate($image, 0xff, 0xcc, 0x00),  
    imagecolorallocate($image, 0x33, 0x66, 0xcc),  
    imagecolorallocate($image, 0x33, 0xcc, 0x33),  
    imagecolorallocate($image, 0xff, 0x99, 0x33),  
    imagecolorallocate($image, 0xcc, 0xcc, 0x99),  
    imagecolorallocate($image, 0x99, 0xcc, 0x66),  
    imagecolorallocate($image, 0x66, 0xff, 0x99)  
    ),  
    array(  
    imagecolorallocate($image, 0x4f, 0x66, 0x00),  
    imagecolorallocate($image, 0x00, 0x33, 0x00),  
    imagecolorallocate($image, 0x48, 0x10, 0x00),  
    imagecolorallocate($image, 0x7d, 0x64, 0x00),  
    imagecolorallocate($image, 0x17, 0x30, 0x64),  
    imagecolorallocate($image, 0x1a, 0x6a, 0x1a),  
    imagecolorallocate($image, 0x97, 0x4b, 0x00),  
    imagecolorallocate($image, 0x78, 0x79, 0x3c),  
    imagecolorallocate($image, 0x55, 0x7e, 0x27),  
    imagecolorallocate($image, 0x00, 0x93, 0x37)  
    )  
    );  
      
    //由下至上画10个像素高的深色饼图，作为阴影  
    $yuanxin_x=$tukuan/2;  
    for ($h = $tugao/2+5; $h > $tugao/2-5; $h--) {  

    $kaishi=0;  
    $jieshu=0;  
    for ($i = 0; $i < count($shuju); $i++) {  
    $kaishi=$kaishi+0;  
    $jieshu=$kaishi+$jiaodu[$i];  
    $yanse_i=fmod($i,10);  
    imagefilledarc($image,$yuanxin_x,$h,$tukuan,$tugao-20,$kaishi,$jieshu,$yanse[1][$yanse_i],IMG_ARC_PIE);  
    $kaishi+=$jiaodu[$i];  
    $jieshu+=$jiaodu[$i];  
    }  
    }  
      
    //在最高处(也就是$h最小时)画一个浅色饼图，这个浅色图跟先画上的深色饼图就能产生立体效果了  
    for ($i = 0; $i < count($shuju); $i++) {  
    $kaishi=$kaishi+0;  
    $jieshu=$kaishi+$jiaodu[$i];  
    $yanse_i=fmod($i,10);  
    imagefilledarc($image, $yuanxin_x, $h, $tukuan, $tugao-20, $kaishi, $jieshu, $yanse[0][$yanse_i], IMG_ARC_PIE);  
    $kaishi+=$jiaodu[$i];  
    $jieshu+=$jiaodu[$i];  
    }  
    //设定文件头   
    header('Content-type: image/png');  
    //输出图像  
    imagepng($image);  
    //释放资源   
    imagedestroy($image);  
    ?>  