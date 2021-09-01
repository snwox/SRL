<?php 
    $conn=include("db-connect.php");
    if(mysqli_connect_errno()){
        $nums=10000;
    }else{
        $res=mysqli_query($conn,"select * from urls");
        $nums=mysqli_num_rows($res);
    }
    $url_regex = "/^http[s]?\:\/\//i";
    $url=$_POST['url'];
    //url 정규식 체크, 그냥 http/https 만 맞춰주면 됨
    if(!preg_match($url_regex,$url)){ 
        echo "<script>alert('올바른 url 이 아닙니다');history.go(-1);</script>";
        die();  
    }
    if($nums===10000){
        echo "<script>alert('데이터베이스가 꽉 찼습니다');history.go(-1);</script>";
        die();  
    }
    if(strpos($url,"srl.kro.kr")!==false){
        echo "<script>alert('단축 url 을 다시 단축할 수 없습니다');history.go(-1);</script>";
        die();  
    }
    sleep(1);
    $result_url="";
    $token=$nums;
    
    while($row = mysqli_fetch_assoc($res)){
        if($url==$row['origin']){
            $result_url=$row['changed'];
            break;
        }
    }
    if($result_url==""){
        $query=sprintf("INSERT INTO urls (`id`,`origin`,`changed`) VALUES (%d,'%s','%s')",
                $nums,$url,'http://srl.kro.kr/'.$token);
        $res=mysqli_query($conn,$query);
        if($res===True){
            $result_url='http://srl.kro.kr/'.$token;
            
        }else{
            echo "<script>alert(\"server error!\");history.go(-1);</script>";
            die();
        }
    }
    mysqli_close($conn); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>shorten url service</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <input id="url" value=<?=$result_url?> readonly />
        <button onclick=copy()>까삐까삐</button>
        <script>
        function copy() {
            var copyText = document.getElementById("url");
            copyText.select();
            document.execCommand("Copy");
            console.log('Copied!');
        }
        </script>
    </body>
</html>