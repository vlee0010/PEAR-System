<div class="img-container">
    <?= $this->Html->image('zyzz-logo.png',array("class"=>"abc"))?>
</div>


    <article class="container">
<!--        title;-->




<!--        Property Image & Caption/License-->
        <figure class="listing--image">
            <img class="img-block"  src="<?php echo $detail->image_url?>" alt="Property Image(s)">
<!--        "no-display" class ==> Not showing the license info visually, but it's available for the crawlers(SEO performance).  -->
            <figcaption class="no-display">
                <?php echo $detail->image_attribution?>
            </figcaption>
        </figure>

<!--        Listing Out Property Details -->
<!--        Showing all values inside the database about a property-->
<!--        But in the real world, I might not want to show irrelevant information like the Property ID -->
        <section class="info">
            <p class="no-display"></i>Property ID: <?php echo $detail->id?></p>
            <p><i class="iconfont iconaddress"></i>Address: <?php echo $detail->address?></p>
            <p><i class="iconfont iconliushui"></i> Listing Price: <?php echo $this->Number->currency($detail->list_price, '', ['places' => 0])?></p>
            <p class="no-display">Sold Price: $<?php #//echo $detail->sold_price?></p>
            <p><i class="iconfont iconchuang"></i> Number of Bedrooms: <?php echo $detail->num_bedrooms?></p>
            <p><i class="iconfont iconxizao"></i> Number of Bedrooms: <?php echo $detail->num_bathrooms?></p>
        </section>
    </article>
    <hr>








