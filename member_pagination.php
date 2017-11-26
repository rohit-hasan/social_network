<?php
$query="select * from users";
$result=mysqli_query($con,$query);

$total_members= mysqli_num_rows($result);
$total_pages=ceil($total_members/$per_page);

echo "<center>
        <div id='members_pagination'>
        <a href='members.php?page=1'>First Page </a>
     
     ";
for($i=1;$i<=$total_pages;$i++){
    echo "<a href='members.php?page=$i'>$i </a>";
}
echo "<a href='members.php?page=$total_pages'> Last Page</a></center></div>";
?>

