<div class="album_container" style="float:left; clear:both;">

  <?php $token = $this->session->userdata('album_token'); ?>
  <h6>+Albums</h6>
  <div class="album_holder">
	  <?php foreach ($all_albums as $album):?>
          <div class="album_box" style="width:150px; height:150px; float:left;">
              <div class="album_cover" style="float:left; clear:both;">
                  <a href="javascript:void(0)" onclick="get_photos_js('<?php echo $album[4] //album id ?>',
                  '<?php echo $token ?>')">
                      <img src="<?php echo $album[5] //album_cover link ?>" alt="album_cover"/> 
                  </a>
              </div>
              <div class="album_name" style="float:left;">
                  <?php echo $album[0] //Album name ?>
              </div>
          </div>
      <?php endforeach; ?>
	</div>
</div>