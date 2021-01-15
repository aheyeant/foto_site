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
    <div class="account-layout">
        <div class="account-nav">
            <div class="account-nav-field">
                <div class="flex">
                    <div class="field-link field-link-padding">
                        <a href="<?=$this->deploy_prefix?>/account">Details</a>
                    </div>
                    <div class="field-edit">
                        <a href="<?=$this->deploy_prefix?>/account/edit">
                            <svg class="field-edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981   c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611   C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069 L27.473,390.597L0.3,512.69z"></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="account-nav-field">
                <div class="field-link">
                    <a href="<?=$this->deploy_prefix?>/account/offers">My offers</a>
                </div>
            </div>
            <div class="account-nav-field">
                <div class="field-link">
                    <a href="<?=$this->deploy_prefix?>/account/create">New offer</a>
                </div>
            </div>
            <div class="account-nav-field">
                <div class="field-link">
                    <a href="<?=$this->deploy_prefix?>/account/password">Password</a>
                </div>
            </div>
        </div>

        <div class="account-content-layout">
            <div class="account-content">
                <div class="form-layout">
                    <div class="form">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="post" readonly value="create-offer">
                            <div class="form-field">
                                <span title="Сamera firm">Firm<span class="form-field-required"> *</span></span>
                                <select name="firm" title="Сamera firm">
                                    <?php foreach($this->firms as $firm) { ?>
                                        <?php if ($firm->name == "Other") { ?>
                                            <option selected value="<?=$firm->id?>"><?=$firm->name?></option>
                                        <?php } else { ?>
                                            <option value="<?=$firm->id?>"><?=$firm->name?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="form-error-message hidden"></span>
                            </div>

                            <div class="form-field">
                                <span title="Сamera model">Model<span class="form-field-required"> *</span></span>
                                <input type="text" name="model" autocomplete="off" required placeholder="model" title="Сamera model">
                                <span class="form-error-message hidden"></span>
                            </div>

                            <div class="form-field">
                                <span title="Enter price(USD) per day">Price(USD)<span class="form-field-required"> *</span></span>
                                <input type="number" name="price" autocomplete="off" required placeholder="100" min="0" max="1000" title="Enter price(USD) per day">
                                <span class="form-error-message hidden"></span>
                            </div>

                            <div class="form-field">
                                <span title="Description max 1000 chars">description</span>
                                <textarea name="description" cols="40" rows="3" title="Description max 1000 chars"></textarea>
                                <span class="form-error-message hidden"></span>
                            </div>

                            <div class="form-field">
                                <span title="Select image">Image</span>
                                <input type="file" name="image" accept="image/png,image/jpg,image/jpeg" title="Select image">
                                <span class="form-error-message hidden"></span>
                            </div>

                            <div class="form-submit">
                                <input type="submit" value="Create" class="form-button">
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