<?php
$dbc = mysqli_connect('localhost','root','','test');

if (isset($_POST['submit']))
{
    $user_name = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $user_pass = mysqli_real_escape_string($dbc, trim($_POST['pass']));

    $query = "SELECT userId, name FROM `users` WHERE name = '$user_name' AND password = SHA('$user_pass')";
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 1)
    {
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/test/pages/index.php';
        $row = mysqli_fetch_assoc($data);

        setcookie('user_id', $row['userId'], time() + (60*60*24));
        setcookie('user_name', $row['name'], time() + (60*60*24));

        header('Location: ' . $home_url);
    }
    else
    {
        echo 'Не верный логин или пароль';
    }
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

    <title>Login</title>
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<span class="login100-form-title p-b-26">
						Добро пожаловать
					</span>
                <span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-brightness-2"></i>
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Правильный email адрес: a@b.c">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Введите пароль">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="pass">
                    <span class="focus-input100" data-placeholder="Пароль"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" name="submit">
                            Войти
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-115">
						<span class="txt1">
							Нет аккаунта?
						</span>

                    <a class="txt2" href="register.php">
                        Зарегистрироваться
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>