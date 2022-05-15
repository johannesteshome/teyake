<?php 
$conn= mysqli_connect("localhost","root",'',"teyake");// create a connection to database


if (!$conn) {
    # code...
    echo '<script>alert("Connection to Database Failed.");
                setTimeout(()=>{window.open("index.php","_parent");},2000)
    </script>';

} 

//  $query="select * from teacher";
//  $connect=mysqli_query($conn,$query);// creation of connection with db table
// $data=mysqli_fetch_assoc($connect);// to fetch data from the table 
// $num=mysqli_num_rows($connect);//check the db having data or not
?>