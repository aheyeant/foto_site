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
            <?php if(!$this->post_items_error) { ?>
                <?php foreach($this->post_items as $item) { ?>
                    <div class="post-items-layout">
                        <img class="post-image" src="<?=$this->deploy_prefix?><?=$item->photo_url?>">
                        <div class="item-text-content">
                            <div class="label-hover">
                                <span><?=$item->firm_name?></span>
                                <span><?=$item->model?></span>
                            </div>
                            <span class="label-hover"><?=$item->price?>$ per day</span>
                            <div class="item-button-layout">
                                <?php if($item->available) { ?>
                                    <a href="<?=$this->deploy_prefix?>/offers?id=<?=$item->id?>" class="item-button background-green">Details</a>
                                <?php } else { ?>
                                    <a href="<?=$this->deploy_prefix?>/offers?id=<?=$item->id?>" class="item-button background-red">Details</a>
                                <?php } ?>
                            </div>
                            <div class="user-link-layout">
                                <a href="<?=$this->deploy_prefix?>/account/about?id=<?=$item->user_id?>" class="user-link">
                                    <svg class="user-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.999,0c-74.443,0-135,60.557-135,135s60.557,135,135,135s135-60.557,135-135S330.442,0,255.999,0z"/><path d="M478.48,398.68C438.124,338.138,370.579,302,297.835,302h-83.672c-72.744,0-140.288,36.138-180.644,96.68l-2.52,3.779V512 h450h0.001V402.459L478.48,398.68z"/></svg>
                                    <?=$item->user_username?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <div class="page-selector">
                <?php if ($this->post_items_prev != null) { ?>
                    <a href="<?=$this->deploy_prefix?><?=$this->post_items_prev?>" class="selector-arrow">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M501.504,160.047H234.837V42.714c0-4.309-2.603-8.192-6.592-9.856c-3.989-1.664-8.576-0.747-11.627,2.304L3.115,248.495    C1.109,250.501,0,253.21,0,256.047c0,2.837,1.131,5.547,3.115,7.552l213.504,213.419c2.048,2.048,4.779,3.115,7.552,3.115    c1.365,0,2.752-0.256,4.075-0.811c3.989-1.664,6.592-5.547,6.592-9.856V352.047h266.667c5.888,0,10.667-4.779,10.667-10.667    V170.714C512.171,164.826,507.413,160.047,501.504,160.047z"/></svg>
                    </a>
                <?php } ?>

                <span class="selector-page-label"><?=$this->post_items_page?></span>

                <?php if ($this->post_items_next) { ?>
                    <a href="<?=$this->deploy_prefix?><?=$this->post_items_next?>" class="selector-arrow">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M509.035,248.212l-213.504-212.8c-3.051-3.029-7.595-3.904-11.627-2.304c-3.989,1.664-6.571,5.547-6.571,9.856v117.333    H10.667C4.779,160.298,0,165.076,0,170.964v170.667c0,5.888,4.779,10.667,10.667,10.667h266.667v116.885    c0,4.309,2.603,8.192,6.592,9.856c1.323,0.555,2.709,0.811,4.075,0.811c2.773,0,5.504-1.088,7.552-3.115l213.504-213.419    c2.005-2.005,3.115-4.715,3.115-7.552C512.171,252.927,511.04,250.218,509.035,248.212z"/></svg>
                    </a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>