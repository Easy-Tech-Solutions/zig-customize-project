<?php   


if(isset($_POST['userreg'])){
    include('../sql_connection/config.php');  
    $fullname = $_POST['Fullname'];  
    $username = $_POST['Username']; 
    $mail = $_POST['Email'];
    $phone = $_POST['Phone'];
    $password = $_POST['Password'];  
    
       
        $sql = "select * from user where username = '$username' and password = '$password'";  
        $table = mysqli_query($conn, $sql);
        if(mysqli_num_rows($table)>0){

            echo "<script> alert('User already Exists');
            window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';
           </script>";
          
        }
        
        else{

            $sql = "INSERT INTO user(customer_name, username ,customer_mail, customer_phone, password)VALUES('$fullname', '$username', '$mail', '$phone', '$password')";
            
       
          
        if(mysqli_query($conn,$sql)){ 
           
            echo "<script> alert('Registration successful');
             window.location = '/ZIG-CUSTOMIZE-PROJECT/pages/account.php';
            </script>";
           	  
        }  
        else{  
            echo "error" .mysqli_error($conn);
        } 

    }

    }    
?>  