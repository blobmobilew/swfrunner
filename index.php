<?php include('server.php'); 

    if (empty($_SESSION['username'])) {
        header('location: login.php');
    }
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Registration</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <div class="header">
                <h2>Home page</h2>
            </div>
            <div class="content">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="error success">
                        <h3>
                            <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            ?> 
                        </h3>
                    </div>
                <?php endif ?>

                <?php if (isset($_SESSION['username'])): ?>
                    <p>Welcome <strong><?php echo $_SESSION['username']; ?> </strong> (ID: <strong><?php 
                        $db = mysqli_connect('localhost', 'root', '', 'registration');
                        $username = $_SESSION['username'];
                        $edb = "SELECT id FROM users WHERE username = '$username'";
                        $result = mysqli_query($db, $edb);
                        $row = $result->fetch_assoc();
                        $id = (int) $row['id'];

                        echo $id; ?></strong>) (Rank: <strong><?php
                        
                        $adb = "SELECT erank FROM users WHERE username = '$username'";
                        $result2 = mysqli_query($db, $adb);
                        $row2 = $result2->fetch_assoc();
                        $erank = $row2['erank'];
                        
                        echo $erank; ?></strong>)</p>

                        <center id="center">
                            <div id="0" class="row"></div>
                        </center>   
                        <script src="js/main.js"></script>
                    <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
                <?php endif ?>
            </div>
        </body>
    </html>
