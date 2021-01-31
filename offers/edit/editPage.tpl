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
    <div class="account-layout">
        <div class="account-content-layout">
            <div class="account-content">
                <div class="form-layout">
                    <div class="form">
                        <form method="post" onsubmit="return editOfferVerify()">
                            <input type="hidden" name="post" readonly value="edit-offer">
                            <input type="hidden" name="id" readonly value="<?=$this->post->id?>">
                            <div class="form-field">
                                <span title="Сamera firm">Firm<span class="form-field-required"> *</span></span>
                                <select name="firm" title="Сamera firm">
                                    <?php foreach($this->firms as $firm) { ?>
                                    <?php if ($firm->id == $this->post->firm_id) { ?>
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
                                <input id="input_model" type="text" name="model" autocomplete="off" required placeholder="model" title="Сamera model" value="<?=$this->post->model?>">
                                <span id="error_model" class="form-error-message hidden"></span>
                            </div>

                            <div class="form-field">
                                <span title="Enter price(USD) per day">Price(USD)<span class="form-field-required"> *</span></span>
                                <input id="input_price" type="number" name="price" autocomplete="off" required placeholder="100" min="0" max="1000" title="Enter price(USD) per day" value="<?=$this->post->price?>">
                                <span id="error_price" class="form-error-message hidden"></span>
                            </div>

                            <div class="form-field">
                                <span title="Description max 1000 chars">description</span>
                                <textarea id="input_description" name="description" cols="40" rows="3" title="Description max 1000 chars"><?=$this->post->description?></textarea>
                                <span id="error_description" class="form-error-message hidden"></span>
                            </div>

                            <div class="form-submit">
                                <input type="submit" value="Save" class="form-button">
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