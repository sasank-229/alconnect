<?php
    ob_start();
    session_start();
    if(isset($_SESSION["studentid"])){
        header("Location: student_profile.php");
    }
    if(isset($_SESSION['alumniid'])){
        header("Location: alumni_profile.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> 
    <link rel="stylesheet" href="index.css">
    <title>AL-CONNECT</title>
</head>
<body>
    <div class="HomePage">
        <div class="Headder">
            <h1>ALCONNECT</h1>
            <div class="college">
                    <!-- <h2>Seshadri Rao Gudlavalleru Engineering College</h2>
                    <a href="https://www.gecgudlavalleru.ac.in" target="_blank"><img src="Images/gud_logo.jpeg" alt=""></a> -->
                    <a href="https://www.gecgudlavalleru.ac.in" target="_blank"><img src="Images/gud_title.png" alt=""></a>
            </div>
        </div>
        <div class="Container">
            <img class="main_img" src="Images/gud_img_3.png" alt="">
            <div class="loginIcons">
                <span class="divButton">
                    <a href="#alumni">
                        <div id="pic_text">
                            <!-- <a href="#alumni"><img src="Images/Student_icon.png" alt=""></a> -->
                            <img src="Images/Student_icon.png" alt="">
                            <h3> Alumni  access</h3>
                        </div>
                    </a>
                </span>
                <span class="divButton">
                    <a href="#student">
                        <div id="pic_text">
                            <!-- <a href="#student"><img src="Images/student.png" alt=""></a> -->
                            <img src="Images/student.png" alt="">
                            <h3> Student  access</h3>
                        </div>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="Alumni" id="alumni">
        <div class="alumniTitle">
            <img src="Images/alumni_icon_2.png" alt="">
            <h1 style="font-family:mono-space,Arial,sans-serif; font-wight: 500;">Alumni Realm</h1>
        </div>
        <div class="alumniLogin">
            <section>
                <div class="form-box">
                    <div class="form-value">
                            <?php
                                if(isset($_POST["login"])){
                                    $email = $_POST["email"];
                                    $password = $_POST["password"];
                                    // echo "$email $password";
                                    require_once "connection.php";
                                    $sql = "SELECT * FROM alumni_record WHERE email = '$email'";
                                    $result = mysqli_query($conn, $sql);
                                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    if($user){
                                        $al_id = $user['id'];
                                        if(password_verify($password, $user["password"])){
                                            session_start();
                                            $_SESSION["alumniid"]=$al_id;
                                            header("Location: alumni_dashboard.php");
                                            ob_end_flush();
                                            die();
                                        }
                                        else{
                                            echo " <div class='alert alert-danger'>Password doesn't Match</div> ";
                                        }
                                    }
                                    else{
                                        echo "<div class='alert alert-danger'>Email does not Match</div>";
                                    }
                                }
                            ?>
                        <form action="index.php" method="POST">
                            <h2>Login Routine</h2>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input type="email" name="email" required>
                                <label for="">Email</label>
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input type="password" name="password" required>
                                <label for="">Password</label>
                            </div>
                            <div class="forget">
                                <label for=""><input type="checkbox">
                                    Remember Me  <a href="#">Forgot Password ?</a>
                                </label>
                            </div>
                            <button type="submit" value="Login" name="login" class="alumni_button">Log in</button>
                            <div class="register">
                                <p>Don't have a account ?    <a href="alumni_register.php">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        </div>
    </div>
    <div class="Student" id="student">
        <div class="alumniTitle">
            <img src="Images/Student_login_icon.jpeg" alt="">
            <h1 style="font-family:mono-space,Arial,sans-serif; font-wight: 500;">Student Realm</h1>
        </div>
        <div class="studentLogin">
            <div class="login-form">
                <h1>Login Routine</h1>
                <?php
                    if(isset($_POST["student_login"])){
                        $email = $_POST["student_email"];
                        $password = $_POST["student_password"];
                        require_once "connection.php";
                        $sql = "SELECT * FROM student_record WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if($user){
                            $std_id = $user['id'];
                            if(password_verify($password, $user["password"])){
                                // $sql="SELECT id FROM student_record WHERE email = '$email'";
                                // $id = mysqli_query($conn, $sql);
                                // echo "ID: $id";
                                // $id = 1;
                                session_start();
                                $_SESSION["studentid"]=$std_id;
                                header("Location: student_dashboard.php");
                                ob_end_flush();
                               // header("Location: student_dashboard.php");
                                die();
                            }
                            else{
                                echo " <div class='alert alert-danger'>Password doesn't Match</div> ";
                                // echo " <div class='alert alert-danger'>Password does not Match</div>"
                            }
                        }
                        else{
                            echo "<div class='alert alert-danger'>Email does not Match</div>";
                        }
                    }
                ?>
                <form action="index.php" method="POST">
                    <p>Email</p>
                    <input type="text" name="student_email" placeholder="Email ID">
                    <p>Password</p>
                    <input type="password" name="student_password" placeholder="Password">
                    <div class="student_forget">
                        <button type="submit" value="Login" name="student_login" class="student_login">Login</button>
                        <!-- <label for=""><a href="#">Forgot Password ?</a></label> -->
                     </div> 
                    <div class="student_register">
                        <p>Don't have a account ?    <a href="student_register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>