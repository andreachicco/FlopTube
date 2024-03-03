<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once(dirname(__FILE__) . "/../common/head.php"); 
        set_title("Internal Server Error");
        header("HTTP/1.1 500 Internal Server Error", true, 400);
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        h1 {
            margin-top: 0;
            color: #f44336;
        }

        p {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>500 - Internal Server Error</h1>
        <p>Oops! The server encountered an error and could not complete your request.</p>
    </div>
</body>
</html>