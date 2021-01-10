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
    <div class="form-layout">
        <div class="form">
            <form method="post">
                <input type="hidden" name="post" readonly value="signin">
                <?php if(!$this->verify_error and !$this->signin_error) { ?>
                    <div class="form-field">
                        <span title="Only lowercase characters, numbers or '_'">Username<span class="form-field-required"> *</span></span>
                        <input type="text" name="username" autocomplete="off" required placeholder="username" title="Only lowercase characters, numbers or '_'">
                        <span class="form-error-message hidden"></span>
                    </div>
                    <div class="form-field">
                        <span title="At least 4 characters">Password<span class="form-field-required"> *</span></span>
                        <input type="password" name="password" autocomplete="off" required title="At least 4 characters">
                        <span class="form-error-message hidden"></span>
                    </div>
                <?php } else { ?>
                    <?php if ($this->log_username == null) { ?>
                        <div class="form-field">
                            <span title="Only lowercase characters, numbers or '_'">Username<span class="form-field-required"> *</span></span>
                            <input type="text" name="username" autocomplete="off" required placeholder="username" value="<?=$this->old_username?>" title="Only lowercase characters, numbers or '_'">
                            <span class="form-error-message hidden"></span>
                        </div>
                    <?php } else { ?>
                        <div class="form-field">
                            <span title="Only lowercase characters, numbers or '_'">Username<span class="form-field-required"> *</span></span>
                            <input type="text" name="username" autocomplete="off" required placeholder="username" value="<?=$this->old_username?>" title="Only lowercase characters, numbers or '_'">
                            <span class="form-error-message"><?=$this->log_username?></span>
                        </div>
                    <?php } ?>
                    <?php if ($this->log_password == null) { ?>
                        <div class="form-field">
                            <span title="At least 4 characters">Password<span class="form-field-required"> *</span></span>
                            <input type="password" name="password" autocomplete="off" required title="At least 4 characters">
                            <span class="form-error-message hidden"></span>
                        </div>
                    <?php } else { ?>
                        <div class="form-field">
                            <span title="At least 4 characters">Password<span class="form-field-required"> *</span></span>
                            <input type="password" name="password" autocomplete="off" required title="At least 4 characters">
                            <span class="form-error-message"><?=$this->log_password?></span>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if ($this->signin_error != null) { ?>
                    <div class="sign-error-message-layout">
                        <span class="sign-error-message">Wrong Username or Password</span>
                    </div>
                <?php } ?>
                <div class="form-submit">
                    <input type="submit" value="Sign in" class="form-button">
                </div>
            </form>

            <div class="alternative-layout">
                <div class="link-signup">
                    <a href="/signup" class="a-border">sign up</a>
                </div>
            </div>

        </div>
    </div>


</div>

</body>
</html>