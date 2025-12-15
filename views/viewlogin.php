<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de Session</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <h1>Login</h1>
        <form action="/login" method="POST">
            <input type="text" name="matricula" placeholder="Matricula" />
            <input type="password" name="password" placeholder="Contraseña" />
            <button type="submit">Ingresar</button>
            <?php
                session_start();
                if (isset($_SESSION['error_log'])):
            ?>
                <p class="info-log <?php echo $_SESSION['error_log'] ? 'error' : 'success'; ?>">
                    <?php echo htmlspecialchars($_SESSION['mensaje']); ?>
                </p>

            <?php
                unset($_SESSION['error_log']);
                unset($_SESSION['mensaje']);
                session_unset();
            ?>

            <?php endif; ?>
        </form>
    </div>
</div>
</body>
</html>