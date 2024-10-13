<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gawang Gamat</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            color: black;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }
    </style>
</head>
<body>

    <header>
        <h2>Gawang Gamat Email Receipt</h2>
    </header>

    <div class="container">
        <p>You have got an email from: {{ $name }}</p>

        <h3>User details:</h3>

        <p>
            <strong>Name:</strong> {{ $name }} <br>
            <strong>Email:</strong> {{ $email }} <br>
            <strong>Phone:</strong> {{ $phone }} <br>
            <strong>Message:</strong> {{ $user_query }} <br>
        </p>
    </div>

</body>
</html>
