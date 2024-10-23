<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('admin_assets/css/users.css') }}" rel="stylesheet">
    <title>GawangGamat</title>
</head>

<body>
    <nav>
        <div class="nav-left">
            <img src="./images/logo.png" alt="Logo">
            <input type="text" placeholder="Search Mediabook..">
        </div>

        <div class="nav-middle">
            <a href="{{ route('best-sellers') }}" class="active">
                <i class="">Best Seller</i>
            </a>

            <a href="#">
                <i class="fa fa-user-friends"></i>
            </a>

            <a href="{{ route('featured') }}">
                <i class="">Features</i>
            </a>
        </div>

        <div class="nav-right">
            <span class="profile"></span>

            <a href="#">
                <i class="fa fa-bell"></i>
            </a>

            <a href="#">
                <i class="fas fa-ellipsis-h"></i>
            </a>
        </div>
    </nav>

</body>

</html>