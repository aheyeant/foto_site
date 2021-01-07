<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
</head>
<body>
<form method="post">
    <label style="display: none">
        <input name="post" value="signup">
    </label>
    <label>
        username:
        <input name="username" type="text">
    </label>
    <br>
    <label>
        email:
        <input name="email" type="text">
    </label>
    <br>
    <label>
        password:
        <input name="password" type="text">
    </label>
    <br>
    <label>
        phone_number:
        <input name="phone" type="text">
    </label>
    <br>
    <label style="display: none">
        role:
        <input name="role" type="text" value="ROLE_ADMIN">
    </label>
    <br>
    <button type="submit"></button>
</form>
</body>
</html>