<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/user/<?=$user['id']?>/update" method="POST">
    <input type="text" name="name" value="<?=$user['name']?>" placeholder="Name"><br>
    <input type="email" name="email" value="<?=$user['email']?>" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Submit</button>
</form>
</body>
</html>