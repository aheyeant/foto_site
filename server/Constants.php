<?php

class Constants {

    // --- Content ---
    public static $SITE_NAME = "Filmer";
    public static $SITE_NAME_UPPERCASE = "FILMER";

    // [FEL]
    //public static $FEL_SERVER = true;
    public static $FEL_SERVER = false;

    // [FEL]
    //public static $DEPLOY_PREFIX = "/~skalkste"; // fel server
    public static $DEPLOY_PREFIX = ""; // clear server


    // --- Routers ---
    public static $GET_ACTION_NAME = "get";


    public static $POST_ACTION_NAME = "post";

    public static $POST_SIGN_UP = "signup";
    public static $POST_SIGN_IN = "signin";
    public static $POST_ACCOUNT_EDIT = "edit-account";
    public static $POST_ACCOUNT_RESET_PASSWORD = "reset-password";
    public static $POST_CREATE_OFFER = "create-offer";
    public static $POST_EDIT_OFFER = "edit-offer";
    public static $POST_CREATE_RESERVATION = "create-reservation";

    // --- Helpers ---
    public static $USERNAME_MAX_LENGTH = 64;

    public static $EMAIL_MAX_LENGTH = 255;

    public static $PASSWORD_MIN_LENGTH = 4;
    public static $PASSWORD_MAX_LENGTH = 64;

    public static $PHONE_MIN_LENGTH = 7;
    public static $PHONE_MAX_LENGTH = 24;

    public static $ITEMS_PER_PAGE = 10;

    // --- DB ---
    public static $ROLE_ADMIN = "ROLE_ADMIN";
    public static $ROLE_USER = "ROLE_USER";

    public static $IMAGES_ASSETS_PATH = "/assets/images/";
    public static $FEL_IMAGES_ASSETS_PATH = "/home/skalkste/www/assets/images/";
    public static $DEFAULT_IMAGE_NAME = "camera.png";
}