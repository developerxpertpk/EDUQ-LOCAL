<?php

/**
 * 
 *  DEFINE SETTINGS
 * 
 * */ 

// Group settings
define("BUTTONIZER_DEF_POSITION_VERTICAL", "bottom: 5%");
define("BUTTONIZER_DEF_POSITION_HORIZONTAL", "right: 5%");
define("BUTTONIZER_DEF_MENU_STYLE", 'default');
define("BUTTONIZER_DEF_MENU_ANIMATION", 'none');
define("BUTTONIZER_DEF_MENU_ANIMATION_DELAY", 10);
define("BUTTONIZER_DEF_MENU_ANIMATION_REPEAT_COUNT", 0);
define("BUTTONIZER_DEF_START_OPENED", false);
define("BUTTONIZER_DEF_MOBILE_VISIBILITY", true);
define("BUTTONIZER_DEF_DESKTOP_VISIBILITY", true);
define("BUTTONIZER_DEF_GROUP_ICON", "fa fa-plus");
define("BUTTONIZER_DEF_GROUP_ICON_SIZE", 25);

// Button settings
define("BUTTONIZER_DEF_BUTTON_ACTION", 'url');
define("BUTTONIZER_DEF_BUTTON_ACTION_NEW_TAB", false);
define("BUTTONIZER_DEF_USE_MAIN_BUTTON_STYLE", true);
define("BUTTONIZER_DEF_BUTTON_ICON_SIZE", 16);
define("BUTTONIZER_DEF_BUTTON_ICON", "fa fa-user");

// Styling button settings
define("BUTTONIZER_DEF_BACKGROUND_COLOR", '#48A4DC');
define("BUTTONIZER_DEF_BACKGROUND_COLOR_INTERACTION", '#F08419');
define("BUTTONIZER_DEF_BORDER_RADIUS", '50%');
define("BUTTONIZER_DEF_BACKGROUND_IS_IMAGE", false);

// Styling icon settings
define("BUTTONIZER_DEF_ICON_COLOR", "#FFFFFF");
define("BUTTONIZER_DEF_ICON_COLOR_INTERACTION", "#FFFFFF");
define("BUTTONIZER_DEF_ICON_IS_IMAGE", true);
define("BUTTONIZER_DEF_ICON_IMAGE_BORDER_RADIUS", 50);

// Styling label settings
define("BUTTONIZER_DEF_LABEL_COLOR_BACKGROUND", '#4E4C4CFF');
define("BUTTONIZER_DEF_LABEL_COLOR_TEXT", '#FFFFFFFF');
define("BUTTONIZER_DEF_LABEL_BORDER_RADIUS", '3px');
define("BUTTONIZER_DEF_LABEL_FONT_SIZE", 12);
define("BUTTONIZER_DEF_LABEL_VISIBILITY", "always");
define("BUTTONIZER_DEF_LABEL_MARGIN", "0px 0px 0px 0px");
define("BUTTONIZER_DEF_LABEL_PADDING", "5px 15px 5px 15px");


/**
 * 
 *  TALK TO FRONTEND
 * 
 * */ 
$buttonizerDefaultsList = [
    // Group settings
    'BUTTONIZER_DEF_POSITION_VERTICAL' => BUTTONIZER_DEF_POSITION_VERTICAL,
    'BUTTONIZER_DEF_POSITION_HORIZONTAL' => BUTTONIZER_DEF_POSITION_HORIZONTAL,
    'BUTTONIZER_DEF_MENU_STYLE' => BUTTONIZER_DEF_MENU_STYLE,
    'BUTTONIZER_DEF_MENU_ANIMATION' => BUTTONIZER_DEF_MENU_ANIMATION,
    'BUTTONIZER_DEF_MENU_ANIMATION_DELAY' => BUTTONIZER_DEF_MENU_ANIMATION_DELAY,
    'BUTTONIZER_DEF_MENU_ANIMATION_REPEAT_COUNT' => BUTTONIZER_DEF_MENU_ANIMATION_REPEAT_COUNT,
    'BUTTONIZER_DEF_START_OPENED' => BUTTONIZER_DEF_START_OPENED,
    'BUTTONIZER_DEF_MOBILE_VISIBILITY' => BUTTONIZER_DEF_MOBILE_VISIBILITY,
    'BUTTONIZER_DEF_DESKTOP_VISIBILITY' => BUTTONIZER_DEF_DESKTOP_VISIBILITY,
    'BUTTONIZER_DEF_GROUP_ICON' => BUTTONIZER_DEF_GROUP_ICON,
    'BUTTONIZER_DEF_GROUP_ICON_SIZE' => BUTTONIZER_DEF_GROUP_ICON_SIZE,

    // Button settings
    "BUTTONIZER_DEF_BUTTON_ACTION" => BUTTONIZER_DEF_BUTTON_ACTION,
    "BUTTONIZER_DEF_BUTTON_ACTION_NEW_TAB" => BUTTONIZER_DEF_BUTTON_ACTION_NEW_TAB,
    "BUTTONIZER_DEF_USE_MAIN_BUTTON_STYLE" => BUTTONIZER_DEF_USE_MAIN_BUTTON_STYLE,
    "BUTTONIZER_DEF_BUTTON_ICON_SIZE" => BUTTONIZER_DEF_BUTTON_ICON_SIZE,
    "BUTTONIZER_DEF_BUTTON_ICON" => BUTTONIZER_DEF_BUTTON_ICON,

    // Styling button settings
    "BUTTONIZER_DEF_BACKGROUND_COLOR" => BUTTONIZER_DEF_BACKGROUND_COLOR,
    "BUTTONIZER_DEF_BACKGROUND_COLOR_INTERACTION" => BUTTONIZER_DEF_BACKGROUND_COLOR_INTERACTION,
    "BUTTONIZER_DEF_BORDER_RADIUS" => BUTTONIZER_DEF_BORDER_RADIUS,
    "BUTTONIZER_DEF_BACKGROUND_IS_IMAGE" => BUTTONIZER_DEF_BACKGROUND_IS_IMAGE,

    // Styling icon settings
    "BUTTONIZER_DEF_ICON_COLOR" => BUTTONIZER_DEF_ICON_COLOR,
    "BUTTONIZER_DEF_ICON_COLOR_INTERACTION" => BUTTONIZER_DEF_ICON_COLOR_INTERACTION,
    "BUTTONIZER_DEF_ICON_IS_IMAGE" => BUTTONIZER_DEF_ICON_IS_IMAGE,
    "BUTTONIZER_DEF_ICON_IMAGE_BORDER_RADIUS" => BUTTONIZER_DEF_ICON_IMAGE_BORDER_RADIUS,

    // Styling label settings
    "BUTTONIZER_DEF_LABEL_COLOR_TEXT" => BUTTONIZER_DEF_LABEL_COLOR_TEXT,
    "BUTTONIZER_DEF_LABEL_COLOR_BACKGROUND" => BUTTONIZER_DEF_LABEL_COLOR_BACKGROUND,
    "BUTTONIZER_DEF_LABEL_BORDER_RADIUS" => BUTTONIZER_DEF_LABEL_BORDER_RADIUS,
    "BUTTONIZER_DEF_LABEL_FONT_SIZE" => BUTTONIZER_DEF_LABEL_FONT_SIZE,
    "BUTTONIZER_DEF_LABEL_VISIBILITY" => BUTTONIZER_DEF_LABEL_VISIBILITY,
    "BUTTONIZER_DEF_LABEL_MARGIN" => BUTTONIZER_DEF_LABEL_MARGIN,
    "BUTTONIZER_DEF_LABEL_PADDING" => BUTTONIZER_DEF_LABEL_PADDING,
];
define("BUTTONIZER_DEFAULTS", $buttonizerDefaultsList);