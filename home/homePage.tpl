<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
    <link href="<?=$this->deploy_prefix?>/assets/styles/style.css" rel="stylesheet">
</head>
<body>
<div id="masterHead" class="master-header">
    <div class="nav-layout big">
        <div class="nav-user">
            <?php if (!$this->user_logged) { ?>
            <div class="sign-button-layout">
                <a href="<?=$this->deploy_prefix?>/auth/signin" class="a-border">SIGN IN</a>
            </div>
            <?php } else { ?>
            <div class="sign-button-layout">
                <a href="<?=$this->deploy_prefix?>/account" class="user-account">
                    <svg class="nav-svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.999,0c-74.443,0-135,60.557-135,135s60.557,135,135,135s135-60.557,135-135S330.442,0,255.999,0z"/><path d="M478.48,398.68C438.124,338.138,370.579,302,297.835,302h-83.672c-72.744,0-140.288,36.138-180.644,96.68l-2.52,3.779V512 h450h0.001V402.459L478.48,398.68z"/></svg>
                    <span><?=$this->user_username?></span>
                </a>
                <a href="<?=$this->deploy_prefix?>/auth/signout" class="a-border">SIGN OUT</a>
            </div>
            <?php } ?>
        </div>
        <div class="nav-center">
            <a href="<?=$this->deploy_prefix?>/home" class="site-name-text"><?=$this->site_name?></a>
        </div>
        <div class="nav-filter hidden">

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
        <div class="post-layout">
            <div class="post-items-layout">
                <img class="post-image" src="<?=$this->deploy_prefix?>/assets/camera.png">
                <div class="item-text-content">
                    <div>
                        <span>Firm</span>
                        <span>Model</span>
                    </div>
                    <span>Description</span>
                    <span>Price</span>
                    <span>Button</span>
                    <span>User</span>
                </div>
            </div>

            <?php if(!$this->post_items_error) { ?>
                <?php foreach($this->post_items as $item) { ?>
                    <div class="post-items-layout">
                        <img class="post-image" src="<?=$this->deploy_prefix?>  <?=$item->photo_url?>">
                        <div class="item-text-content">
                            <div>
                                <span><?=$item->firm_id?></span>
                                <span><?=$item->model?></span>
                            </div>
                            <span><?=$item->description?></span>
                            <span><?=$item->price?></span>
                            <span>Button</span>
                            <span><?=$item->user_id?></span>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>