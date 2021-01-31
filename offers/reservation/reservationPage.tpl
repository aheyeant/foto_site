<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
    <link href="<?=$this->deploy_prefix?>/assets/styles/style.css" rel="stylesheet">
    <script src="<?=$this->deploy_prefix?>/assets/scripts/verify.js"></script>
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
    <div class="form-layout">
        <div class="form">
            <form method="post">
                <input type="hidden" name="post" readonly value="create-reservation">
                <input type="hidden" name="post_id" value="<?=$this->post_id?>">
                <?php if (!$this->verify_error) { ?>
                    <div class="form-field">
                        <span title="Enter your email">Email<span class="form-field-required"> *</span></span>
                        <input type="email" name="email" autocomplete="off" required placeholder="example@example.com" title="Enter your email" value="<?=$this->user_email?>">
                        <span class="form-error-message hidden"></span>
                    </div>

                    <div class="form-field">
                        <span title="Phone number must start with +">Phone number</span>
                        <input type="text" name="phone" autocomplete="off" placeholder="+420 777204045" title="Phone number must start with +" value="<?=$this->user_phone?>">
                        <span class="form-error-message hidden"></span>
                    </div>
                <?php } else { ?>
                    <div class="form-field">
                        <span title="Enter your email">Email<span class="form-field-required"> *</span></span>
                        <input type="email" name="email" autocomplete="off" required value="<?=$this->old_email?>" title="Enter your email">
                        <span class="form-error-message"><?=$this->log_email?></span>
                    </div>

                    <div class="form-field">
                        <span title="Phone number must start with +">Phone number</span>
                        <input type="text" name="phone" autocomplete="off" value="<?=$this->old_phone?>" title="Phone number must start with +">
                        <span class="form-error-message"><?=$this->log_phone?></span>
                    </div>
                <?php } ?>

                <?php if ($this->fatal_error) { ?>
                    <div class="sign-error-message-layout">
                        <span class="sign-error-message">Undefined Error</span>
                    </div>
                <?php } ?>

                <div class="form-submit">
                    <input type="submit" value="Reservation" class="form-button">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>