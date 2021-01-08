<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
    <link href="content/pages/assets/css/style.css" rel="stylesheet">
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
                    <a href="/current" class="username"><?=$this->user_username?></a>
                    <a href="/signout" class="a-border">SIGN OUT</a>
                </div>
            <?php } ?>
        </div>
        <div class="nav-center">
            <a href="/" class="site-name-text"><?=$this->site_name?></a>
        </div>
        <div class="nav-filter hidden">
            filter
        </div>
    </div>
</div>

<div id="pageContent">

    <div class="items-layout">
        <div class="filter-layout">
            <div class="filter-content">
                FILTER CONTENT
            </div>
        </div>
        <div class="items-content">
            <div class="item">
                item
            </div>
            <div class="item">
                item
            </div>
            <div class="item">
                item
            </div>
            <div class="item">
                item
            </div>
            <div class="item">
                item
            </div>
            <div class="item">
                item
            </div>

        </div>
    </div>




</div>


</body>
</html>