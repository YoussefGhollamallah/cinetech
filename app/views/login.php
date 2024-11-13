<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$user = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $userdata = $user->login($_POST['username'], $_POST['password']);
        if ($userdata){
            $_SESSION['user'] = $userdata;
            header('Location: profile');
            exit();
        } else {
            echo 'Email ou mot de passe incorrect';
        }
    }
}

if(isset($_SESSION['user'])) {
    header('Location: profile');
    exit();
}

?>

<section>
    <h1>Login</h1>
    <form action="" class="register" method="post">
        <div>
            <input type="text" name="username" placeholder="Email" required>
        </div>

        <div>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div>
            <input type="submit" value="Login">
        </div>
    </form>

    <p>Vous n'avez pas de compte ? <a href="register">Inscrivez-vous</a></p>	
</section>