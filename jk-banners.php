<?php
/**
 * Plugin Name: JK Banners
 * Plugin URI: http://jeffkilroy.com
 * Description: Manage and view banner posts
 * Version: 1.0.0
 * Author: Jeffrey Kilroy
 * Author URI: http://jeffkilroy.com
 * License: GPL2
 */

//Require JK PostDeveloper
if(!class_exists('WPDeveloper')){
    require_once( 'classes/WPDeveloper.php' );
}
$wpDeveloper = new WPDeveloper();
$wpDeveloper->verify();

//Create Post Type
add_action( 'init', 'jkbanners_create_banner_post_type' );
function jkbanners_create_banner_post_type(){
    $postType = new PostType();
    $postType->name = 'jkbanner';
    $postType->urlSlug = 'banner';
    $postType->labelPlural = 'Banners';
    $postType->labelSingular = 'Banner';
    $postType->excerptTitle = 'URL';
    $postType->excerptHelp = 'URL directed to when clicked';
    $postType->create();
}