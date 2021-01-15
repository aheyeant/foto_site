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
    <div class="post-detail-main-layout">
        <div class="post-detail-layout">
            <?php if (!$this->user_owned) { ?>
                <div class="post-detail-content">
                <div class="post-detail-icon">
                    <img class="image" alt="Post icon" src="<?=$this->deploy_prefix?><?=$this->post->photo_url?>"/>
                </div>
                <div class="post-detail-item">
                    <?=$this->post->firm_name?> <?=$this->post->model?>
                </div>
                <div class="post-detail-item">
                    Description: <?=$this->post->description?>
                </div>
                <div class="post-detail-item">
                    Price: <?=$this->post->price?>$ per day
                </div>

                <?php if ($this->post->available) { ?>
                    <div class="post-detail-item color-green">
                        <a href="<?=$this->deploy_prefix?>/offers/reservation?id=<?=$this->post->id?>" class="reservation-button background-green">
                            Make Reservation
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="post-detail-item color-red">
                        <a class="reservation-button background-red">
                            Unavailable
                        </a>
                    </div>
                <?php } ?>
                <br/>
                <br/>
                <br/>
                <div class="post-detail-item">
                    <a href="<?=$this->deploy_prefix?>/account/about?id=<?=$this->post->user_id?>" class="post-detail-user-link">
                        <svg class="post-detail-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M255.999,0c-74.443,0-135,60.557-135,135s60.557,135,135,135s135-60.557,135-135S330.442,0,255.999,0z"/><path d="M478.48,398.68C438.124,338.138,370.579,302,297.835,302h-83.672c-72.744,0-140.288,36.138-180.644,96.68l-2.52,3.779V512 h450h0.001V402.459L478.48,398.68z"/></svg>
                        <?=$this->post->user_username?>
                    </a>
                </div>
            </div>
            <?php } else { ?>
                <div class="post-detail-content">
                    <div class="post-detail-icon">
                        <img class="image" alt="Post icon" src="<?=$this->deploy_prefix?><?=$this->post->photo_url?>"/>
                    </div>
                    <div class="post-detail-item">
                        <?=$this->post->firm_name?> <?=$this->post->model?>
                    </div>
                    <div class="post-detail-item">
                        Description: <?=$this->post->description?>
                    </div>
                    <div class="post-detail-item">
                        Price: <?=$this->post->price?>$ per day
                    </div>

                    <?php if ($this->post->available) { ?>
                        <div class="post-detail-item color-green">
                            <a class="reservation-button background-green">Available</a>
                        </div>
                    <?php } else { ?>
                        <div class="post-detail-item color-red">
                            <a class="reservation-button background-red">Unavailable</a>
                        </div>
                    <?php } ?>

                    <br/>
                    <br/>
                    <br/>
                    <div class="post-detail-item">
                        <div class="edit-buttons-layout">
                            <div class="edit-buttons-container">
                                <a href="<?=$this->deploy_prefix?>/offers/edit?id=<?=$this->post->id?>>" class="link" title="Edit">
                                    <svg class="icon-edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M476.828,302.249c-10.794,0-19.542,8.748-19.542,19.542v151.125H39.087V54.718h151.125    c10.794,0,19.542-8.748,19.542-19.542c0-10.794-8.748-19.542-19.542-19.542H19.545c-10.794,0-19.542,8.748-19.542,19.542v457.282    C0.003,503.252,8.752,512,19.545,512h457.282c10.794,0,19.542-8.748,19.542-19.542V321.791    C496.37,310.998,487.621,302.249,476.828,302.249z"/><path d="M506.271,75.426l-69.693-69.7C432.917,2.058,427.947,0,422.762,0c-5.185,0-10.149,2.058-13.816,5.726L178.35,236.321    c-2.371,2.365-4.084,5.296-4.996,8.514l-27.359,97.059c-1.915,6.807-0.006,14.116,4.996,19.119    c3.713,3.713,8.703,5.726,13.816,5.726c1.765,0,3.55-0.241,5.296-0.73l97.059-27.359c3.224-0.912,6.156-2.632,8.52-4.996    l230.589-230.595C513.905,95.43,513.905,83.053,506.271,75.426z M251.658,302.412l-58.58,16.506l16.513-58.567L422.762,47.181    l42.061,42.061L251.658,302.412z"/><rect x="208.103" y="235.027" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -134.3583 244.2405)" width="39.084" height="98.556"></rect></svg>
                                </a>
                                <a href="<?=$this->deploy_prefix?>/offers/visible?id=<?=$this->post->id?>" class="link" title="Visible">
                                    <svg class="icon-visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M244.917,157.867c-48,0-87.1,39.1-87.1,87.1s39.1,87.1,87.1,87.1s87.1-39.1,87.1-87.1S292.917,157.867,244.917,157.867z      M244.917,297.767c-29.1,0-52.8-23.7-52.8-52.8s23.7-52.8,52.8-52.8s52.8,23.7,52.8,52.8S274.017,297.767,244.917,297.767z"/><path d="M486.617,255.067c4.6-6.3,4.4-14.9-0.5-21c-74.1-91.1-154.1-137.3-237.9-137.3c-142.1,0-240.8,132.4-244.9,138     c-4.6,6.3-4.4,14.9,0.5,21c74,91.2,154,137.4,237.8,137.4C383.717,393.167,482.417,260.767,486.617,255.067z M241.617,358.867     c-69.8,0-137.8-38.4-202.4-114c25.3-29.9,105.7-113.8,209-113.8c69.8,0,137.8,38.4,202.4,114     C425.317,274.967,344.917,358.867,241.617,358.867z"/></svg>
                                </a>
                                <a href="<?=$this->deploy_prefix?>/offers/delete?id=<?=$this->post->id?>>" class="link" title="Delete">
                                    <svg class="icon-delete" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><polygon points="353.574,176.526 313.496,175.056 304.807,412.34 344.885,413.804"/><rect x="235.948" y="175.791" width="40.104" height="237.285"/><polygon points="207.186,412.334 198.497,175.049 158.419,176.52 167.109,413.804"/><path d="M17.379,76.867v40.104h41.789L92.32,493.706C93.229,504.059,101.899,512,112.292,512h286.74     c10.394,0,19.07-7.947,19.972-18.301l33.153-376.728h42.464V76.867H17.379z M380.665,471.896H130.654L99.426,116.971h312.474     L380.665,471.896z"/><path d="M321.504,0H190.496c-18.428,0-33.42,14.992-33.42,33.42v63.499h40.104V40.104h117.64v56.815h40.104V33.42    C354.924,14.992,339.932,0,321.504,0z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>