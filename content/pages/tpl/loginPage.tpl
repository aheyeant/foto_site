<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
</head>
<body>
    <form method="post">
        <label style="display: none">
            <input name="action" value=" ">
        </label>
        <label>
            login:
            <input name="user_login" type="text">
        </label>
        <br>
        <label>
            email:
            <input name="user_email" type="text">
        </label>
        <br>
        <label>
            password:
            <input name="user_password" type="text">
        </label>
        <br>
        <label>
            phone_number:
            <input name="user_phone_number" type="text">
        </label>
        <br>
        <label style="display: none">
            role:
            <input name="user_role" type="text" value="ROLE_USER">
        </label>
        <br>
        <button type="submit"></button>
    </form>
</body>
</html>