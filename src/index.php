<?php
    $conn=include("php/db-connect.php");
    
    if(mysqli_connect_errno()){
        $nums=10000;
    }else{
        $res=mysqli_query($conn,"select * from urls");
        $nums=mysqli_num_rows($res);
    }
    mysqli_close($conn); 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>shorten url service</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Shorten uRL service</h1>
        <p> 남은 저장공간 : <?=10000-$nums?></p>
        <p> 단축하고자 하는 url 입력 </p>
        <form method="POST" action="action.php">
            <input type="text" id="url" name="url">
            <button type="submit">send</button>
        </form>
    </body>
</html>
