<?php
session_start();
include 'includes/connection.php';


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <style>
            body{padding:0;margin:0;background:#41c4f4}
        </style>
    </head> 
    <body>
        <form action="admin_login.php" method="post">
            <table align="center" bgcolor="skyblue">
                <tr>
                    <td>Admin Login Here</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" placeholder="Enter email" name="admin_email"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" placeholder="Enter password" name="admin_password"></td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="admin_login" value="Admin Login">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
if(isset($_POST['admin_login'])){
    $admin_email= mysqli_real_escape_string($con,$_POST['admin_email']);
    $admin_password= mysqli_real_escape_string($con,$_POST['admin_password']);
    $get_admin="select * from admin where admin_email='$admin_email' AND admin_password='$admin_password'";
    $run= mysqli_query($con, $get_admin);
    
    $check= mysqli_num_rows($run);
    if($check==0){
        echo "Incorrect email or password";
    }else{
        $_SESSION['admin_email']=$admin_email;
        echo "<script>window.open('index.php','_self')</script>";
    }
    
}
?>