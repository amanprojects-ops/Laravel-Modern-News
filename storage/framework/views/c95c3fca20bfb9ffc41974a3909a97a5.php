<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/responsive.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/custom.css')); ?>" />
    <style>
        body {
            background: #f5f5f5;
        }

        .login_page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login_box {
            width: 400px;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .login_box h2 {
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .login_box .form-group {
            margin-bottom: 20px;
        }

        .login_box .form-control {
            border: none;
            border-bottom: 2px solid #ddd;
            border-radius: 0;
            box-shadow: none;
            transition: border-color 0.3s;
        }

        .login_box .form-control:focus {
            border-color: #1ed085;
        }

        .login_box .btn {
            background: #1ed085;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background 0.3s;
            width: 100%;
            margin-top: 20px;
        }

        .login_box .btn:hover {
            background: #17b673;
        }
    </style>
</head>

<body class="login_page">
    <div class="login_box">
        <h2>Login</h2>
        <form method="POST" action="<?php echo e(route('admin.login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required
                    autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\www\tut\news-admin\resources\views/admin/Auth/login.blade.php ENDPATH**/ ?>