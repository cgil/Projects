<!-- User search form -->
<div class="search_container">
	<?php echo validation_errors(); ?>
	<?php echo form_open('form'); ?>
        <span id="search_name">
            <h5>Target:</h5>
        </span>
        <div class="scope_box">
          <input type="text" value=""<?php echo set_value('user_id'); ?>" name="user_id" size="20"/>
        </div>
        <div class="scope_button">
            <input type="submit" value="scope" name="scope" class="subbutton2" />
        </div> 
    </form>
</div>