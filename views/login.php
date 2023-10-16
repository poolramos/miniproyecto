<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forms.css">
    <title>Login</title>
</head>

<body>
    <?php
    if (isset($message)) {
        echo '<div class="message-container">' . $message . '</div>';
    }
    ?>
    <main class="form-main">
        <section class="form-container">
            <h1>Login</h1>
            <form action="../controllers/users-controller.php" method="POST">
                <div>
                    <input type="text" name="email" id="username" placeholder="Email">
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <input type="hidden" name="action" value="login">
                <button type="submit">Ingresa</button>
            </form>
            <span>o continua con estas redes sociales</span>
            <div class="social-media-container">
          
            </div>
            <span>No tienes una cuenta? <a href="../views/create-user.php">Registrate</a></span>
        </section>
    </main>
</body>

</html>
