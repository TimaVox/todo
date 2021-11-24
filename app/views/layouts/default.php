<!doctype html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container">
            <a class="navbar-brand" href="/">ToDo</a>

            <div class="d-flex">
                <a class="nav-link" href="/task/create">Add</a>
                <?php if(!\App\models\User::checkAuth()) { ?>
                <a class="nav-link" href="/login">Login</a>
                <?php } else { ?>
                    <a class="nav-link" href="/logout">Logout</a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if($_SESSION['saccess']) { ?>
                    <div class="alert alert-success" role="alert">
                        <?=$_SESSION['saccess'];?>
                    </div>
                <?php } ?>
                <?= $content; ?>
            </div>
        </div>
    </div>
</body>
</html>