<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Infant Watch</title>
        <link rel="stylesheet" href="stylesheet.css" type="text/css" />
    </head>
    </head>
    <body>
      
        
        <center>
            <div id="login-form">

                <?php
                $errors = array(
                    1 => "Invalid user name or password, Try again",
                    2 => "Please login to access this area"
                );

                $error_id = isset($_GET['err']) ? (int) $_GET['err'] : 0;

                if ($error_id == 1) {
                    echo '<p class="text-danger">' . $errors[$error_id] . '</p>';
                } elseif ($error_id == 2) {
                    echo '<p class="text-danger">' . $errors[$error_id] . '</p>';
                }
                ?>  

                <form action="authenticate.php" method="POST"  role="form">
                    <table class="logintable" align="center" width="30%" border="0">   

                        <h1>Infant Watch</h1>

                        <tr><!--class="form-control"-->
                            <td><input type="text" name="username"  placeholder="Username" required autofocus><br/></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="pwd" placeholder="Password" required><br/></td>
                        </tr>
                        <tr>
                            <td><button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>

    </body>
</html>
