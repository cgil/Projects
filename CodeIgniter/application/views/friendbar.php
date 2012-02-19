<div class="friendbar_container">
<h7>+Friends</h7>
    <div class="friendbar_holder">
		<?php foreach ($friends_query as $friend):?>
            <div class="friend_box" style="word-wrap:break-word;">
            	<a href="javascript:void(0)" 
                	onclick="get_albums_js('<?php echo $friend->target_id ?>')"> 
                    	<?php echo $friend->target_name; ?>
                  </a>
     		</div>       
        <?php endforeach; ?>
    </div>
</div>