<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
    <link href="content/pages/assets/css/formStyle.css" rel="stylesheet">
</head>
<body>
<div id="signUpFormLayout">
    <form method="post">
        <label class="hidden">
            <input name="post" value="signup">
        </label>
        <label>
            username:
            <input name="username" type="text" autocomplete="off" id="usernameInput">
        </label>
        <br>
        <label>
            email:
            <input name="email" type="text" autocomplete="off" id="emailInput">
        </label>
        <br>
        <label>
            password:
            <input name="password" type="text" autocomplete="off" id="passwordInput">
        </label>
        <br>
        <label>
            phone_number:
            <input name="phone" type="text" autocomplete="off" id="phoneInput">
        </label>

        <br>
        <button type="submit" ></button>
    </form>
</div>

</body>
</html>