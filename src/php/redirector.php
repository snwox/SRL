<?php
$conn=include("db-connect.php");
$res=mysqli_query($conn,"select * from urls");
while($result = mysqli_fetch_array($res)){
    if($token == $result[0]){
        mysqli_close($conn);
        header("Location: ".$result[1],true,302);
        exit(0);
    }
}
echo "<script>alert(\"url not found!\");history.go(-1);</script>";
mysqli_close($conn);
exit(0);
?>