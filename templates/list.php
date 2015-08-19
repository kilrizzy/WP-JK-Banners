<?php foreach($banners as $banner){ ?>
<div class="banner banner-id-<?php echo $banner->id; ?>">
    <a href="<?php echo $banner->url; ?>">
        <img src="<?php echo $banner->imageURL; ?>" class="img-responsive" />
    </a>
</div>
<?php } ?>