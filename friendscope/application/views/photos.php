<div class="photo_container" id="photos" style="float:left; clear:both;">
    <h7>+Photos</h7>
    <div class="photo_holder">
		<?php foreach ($album_photos as $photo):?>
            <div class="photo_box" style="float:left;">
            
<!-- This is code for the lightbox -->

				<!-- Thumbnail for photo outside -->
				<a href = "javascript:void(0)" onclick = "photo_popup('<?php echo $photo['images'][0]['source']; ?>','<?php echo $photo['from']['name']; ?>')" alt="<?php echo $photo['from']['name'];  ?>')"><img src="<?php echo $photo['images'][2]['source']; ?>" alt="<?php echo $photo['from']['name'];  ?> "/> 
                </a>
     		</div>
<!-- End of lightbox -->
        
        <?php endforeach; ?>
    </div>
                
</div>

    <div class="lightbox_container" id="lightbox_container">
        <!-- lightbox overlay and content area -->
        <div id="light" class="white_content">
            <!-- Close button -->
            <div id="close">
                <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';document.getElementById('lightbox_container').style.position='static';">X
                </a>
            </div>
    
            <!-- Large photo inside of lightbox -->
            <div class="photo_big" id="photo_insert">
            </div> 
        </div>
        <!-- Black background -->
        <div id="fade" class="black_overlay">
        </div> 
     </div>