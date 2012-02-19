<div class="header_container">
<?php
	session_start(); 
?>

<table class="menutab" border="0" cellpadding="0" cellspacing="0">			
	<tr>
		<td style="padding:0px;margin:0px;border:0px;color:#FFFFFF;background-color:#74BAE4;">
			<table style="border-collapse:collapse;margin:0px auto;border:0px;width:900px;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:left; horizontal-align:bottom;clear:both;">
						<table style="border-collapse:collapse;border:0px;" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="imagelogo">
									<a href="<?php echo base_url(); ?>">
                                    	<img src="<?php echo base_url(); ?>Images/friendscope_logo.png" alt="Friendscope" height="40" width="220" />
                                    </a>
								</td>
								<td class="menutab">
									<!--<a class="menubigtab" href="../home.php">FriendScope</a>-->
								</td>
								<td class="menutab">
									<!--<a class="menutab" href = "">Profile</a>-->
								</td>
								<td class="menutab">
									<!--<a class="menutab" href = "">Home</a>-->
								</td>
								<td class="menutab">
                                
									<a class="menutab" href = "<?php echo base_url(); ?>help">Help</a>
								</td>
								<td class="menutab">
                                
									<a class="menutab" href = "<?php echo base_url(); ?>login">Login</a>
								</td>
								<td class="menutab">
                                
									<a class="menutab" href = "<?php echo base_url(); ?>logout">Logout</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>							
			</table>
		</td>
	</tr>				
</table>
</div>