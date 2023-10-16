<?php

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../views/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/personal.css">
    <link rel="stylesheet" href="../css/forms.css">
    <title>Change Info</title>
</head>

<body>
    <nav>
        <div>
        </div>

        <div>
            <?php

            echo '<span class"options">' . $_SESSION["userData"]["fullname"] . '</span>'
            ?>
        </div>
    </nav>
    <main>

        <?php
        if (isset($message)) {
            echo '<div class="message-container">';
            echo $message;
            echo '</div>';
        }
        ?>
        <section class="section-container">
            <a class="back-a" href="../controllers/users-controller.php?action=personalView">
                < Back</a>


                    <div class="update-container">

                        <div class="change-info">
                            <h1>Change Info</h1>
                            <span>Changes will be reflected to every services</span>
                        </div>


                        <div class="image-container-update">
                            <div>
                                <img src="" alt="">
                            </div>
                            <span>CHANGE PHOTO</span>
                        </div>



                        <form action="../controllers/users-controller.php" method="POST" class="form-update">
                            <label for="name">Name</label>
                            <div>
                                <input type="text" name="fullname" id="name" placeholder="Enter your name...">
                            </div>
                            <label for="bio">Bio</label>
                            <div>
                                <textarea name="bio" id="bio" cols="30" rows="10" placeholder="Enter your bio...">
</textarea>
                            </div>

                            <label for="phone">Phone</label>
                            <div>
                                <input type="text" name="phone" id="phone" placeholder="Enter your phone number...">
                            </div>
                            <label for="email">Email</label>
                            <div>
                                <input type="email" name="email" id="email" placeholder="Enter your email...">
                            </div>

                            <label for="password">Password</label>
                            <div>
                                <input type="text" name="pssword" id="password" placeholder="Enter your new password...">
                            </div>

                            <input type="hidden" name="action" value="updateUser">
                            <button>Save</button>
                        </form>
                    </div>

        </section>
    </main>
</body>

</html>