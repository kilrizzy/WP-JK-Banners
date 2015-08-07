<?php

class Banner{
    public $id;
    public $title;
    public $date;
    public $imageURL;
    public $post;
    public $postUrl;
    public $url;

    public function __construct($post=false){
        if($post){
            $this->post = $post;
            $this->setupFromPost();
        }
    }

    public function setupFromPost(){
        $this->id = $this->post->ID;
        $this->title = $this->post->post_title;
        $this->date = $this->post->post_date;
        $this->postUrl = get_post_permalink($this->id);
        $this->url = trim($this->post->post_excerpt);
        $this->thumbId = get_post_thumbnail_id( $this->id );
        $imageURLParts = wp_get_attachment_image_src( get_post_thumbnail_id( $this->id ), 'single-post-thumbnail' );
        if($imageURLParts){
            $this->imageURL = $imageURLParts[0];
        }
    }

    public function getMostRecent(){
        $args = array(
            'post_type' => 'jkbanner',
            'posts_per_page' => '1',
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            $this->post = $query->posts[0];
            $this->setupFromPost();
        }
    }

    public function getByPostId($id){
        $args = array(
            'post_type' => 'jkbanner',
            'posts_per_page' => '1',
            'p' => $id
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            $this->post = $query->posts[0];
            $this->setupFromPost();
        }
    }
}