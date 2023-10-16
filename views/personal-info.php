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
    <title>Personal Info</title>
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
        if (!isset($_SESSION['loggedin'])) {
            header('Location: ../views/login.php');
            exit;
        }
        $userData = $_SESSION['userData'];

        ?>
        <div>
            <h1>Personal info</h1>
            <h2>Basic info, like your name and photo</h2>
        </div>

        <section class="personal-info-container">
            <div class="profile-section">
                <div>
                    <h3>Profile</h3>
                    <span class="small-text">Some info may be visible to other people</span>
                </div>
                <div>
                    <a class="edit-button" href="../controllers/users-controller.php?action=updateView">Edit</a>
                </div>
            </div>
            </div>
            <div>
                <span>PHOTO</span>
                <div>
                    <img src="" alt="Image Profile">
                    <!-- echo '<img src="' . $imageUrl . '" alt="Image Profile">'; -->
                </div>
            </div>
            <div>
                <span>NAME</span>
                <div>
                    <span><?php echo $userData["fullname"]; ?> </span>
                </div>
            </div>
            <div>
                <span>BIO</span>
                <div>
                    <span><?php echo $userData["bio"]; ?> </span>
                </div>
            </div>
            <div>
                <span>PHONE</span>
                <div>
                    <span><?php echo $userData["phone"]; ?> </span>
                </div>
            </div>
            <div>
                <span>EMAIL</span>
                <div>
                    <span> <?php echo $userData["email"]; ?> </span>
                </div>
            </div>
            <div>
                <span>PASSWORD</span>
                <div>
                    <span>************</span>
                </div>
            </div>

        </section>

    </main>
</body>

</html>