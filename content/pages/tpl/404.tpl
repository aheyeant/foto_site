<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
    <link href="/content/pages/assets/css/style.css" rel="stylesheet">
</head>
<body>
<div id="masterHead" class="master-header">
    <div class="nav-layout big">
        <div class="nav-user">
            <?php if (!$this->user_logged) { ?>
            <div class="sign-button-layout">
                <a href="/signin" class="a-border">SIGN IN</a>
            </div>
            <?php } else { ?>
            <div class="sign-button-layout">
                <a href="/account" class="user-account">
                    <svg class="nav-svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.999,0c-74.443,0-135,60.557-135,135s60.557,135,135,135s135-60.557,135-135S330.442,0,255.999,0z"/><path d="M478.48,398.68C438.124,338.138,370.579,302,297.835,302h-83.672c-72.744,0-140.288,36.138-180.644,96.68l-2.52,3.779V512 h450h0.001V402.459L478.48,398.68z"/></svg>
                    <span><?=$this->user_username?></span>
                </a>
                <a href="/signout" class="a-border">SIGN OUT</a>
            </div>
            <?php } ?>
        </div>
        <div class="nav-center">
            <a href="/" class="site-name-text"><?=$this->site_name?></a>
        </div>
        <div class="nav-filter hidden">

        </div>
    </div>
</div>

<div id="pageContent">
    <div class="not-found-layout">
        Page not found
    </div>
</div>


</body>
</html>