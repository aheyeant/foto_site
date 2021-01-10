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
    <div class="account-layout">
        <div class="account-nav">
            <div class="account-nav-field">
                <div class="flex">
                    <div class="field-link field-link-padding">
                        <a href="/account">Details</a>
                    </div>
                    <div class="field-edit">
                        <a href="/account/edit">
                            <svg class="field-edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981   c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611   C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069 L27.473,390.597L0.3,512.69z"></svg>
                        </a>
                    </div>
                </div>

            </div>
            <div class="account-nav-field">
                <div class="field-link">
                    <a href="/account/offers">My offers</a>
                </div>
            </div>
            <div class="account-nav-field">
                <div class="field-link">
                    <a href="/offers/create">New offer</a>
                </div>
            </div>
            <div class="account-nav-field">
                <div class="field-link">
                    <a href="/password/change">Password</a>
                </div>
            </div>
        </div>
        <div class="account-content-layout">
            <div class="account-content">
                <div class="form-layout">
                    <div class="form">
                        <form method="post">
                            <input type="hidden" name="post" readonly value="reset-password">
                            <?php if (!$this->verify_error) { ?>
                                <div class="form-field">
                                    <span title="At least 4 characters">Old password<span class="form-field-required"> *</span></span>
                                    <input type="password" name="old_password" autocomplete="off" required title="At least 4 characters">
                                    <span class="form-error-message"></span>
                                </div>

                                <div class="form-field">
                                    <span title="At least 4 characters">New password<span class="form-field-required"> *</span></span>
                                    <input type="password" name="new_password" autocomplete="off" required title="At least 4 characters">
                                    <span class="form-error-message"></span>
                                </div>
                            <?php } else { ?>
                                <div class="form-field">
                                    <span title="At least 4 characters">Old password<span class="form-field-required"> *</span></span>
                                    <input type="password" name="old_password" autocomplete="off" required title="At least 4 characters">
                                    <span class="form-error-message"><?=$this->log_old_password?></span>
                                </div>

                                <div class="form-field">
                                    <span title="At least 4 characters">New password<span class="form-field-required"> *</span></span>
                                    <input type="password" name="new_password" autocomplete="off" required title="At least 4 characters">
                                    <span class="form-error-message"><?=$this->log_new_password?></span>
                                </div>

                            <?php } ?>
                            <div class="form-submit">
                                <input type="submit" value="Reset" class="form-button">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>


</body>
</html>