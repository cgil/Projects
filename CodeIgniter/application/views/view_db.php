<div class="view_container">
	<p>
    	Query: <br/>
    </p>
	<?php if(isset($query)){ ?>
	<pre>
    	<?php print_r($query); ?>
    </pre>
    
    <?php } else{ ?>
    <p>
    	Incorrect query, try again.
    </p>
    <?php } ?>

</div>