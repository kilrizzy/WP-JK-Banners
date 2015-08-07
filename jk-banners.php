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
if(!class_exists('Banner')){
    require_once __DIR__.'/classes/Banner.php';
}
//Create Post Type
add_action( 'init', 'jkbanners_init' );

function jkbanners_init(){
    jkbanners_create_banner_post_type();
    //Shortcodes
    //add_shortcode( 'banners', 'jkbanners_display_banners' );
    add_shortcode( 'banner', 'jkbanners_display_banner' );
}

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

function jkbanners_display_banner( $atts ) {
    $a = shortcode_atts( array(
        'id' => false,
    ), $atts );
    $output = array();
    //
    $banner = new Banner();
    if(!$a['id']){
        $banner->getMostRecent();
    }else{
        $banner->getByPostId($a['id']);
    }
    //
    $bannerTemplate = new Template();
    $bannerTemplateResponse = $bannerTemplate->get(__DIR__.'/templates/single.php',array('banner'=>$banner));
    $output[] = $bannerTemplateResponse;

    $output = implode("\n",$output);
    return $output;

}