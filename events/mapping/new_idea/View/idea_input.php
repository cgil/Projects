<script language="javaScript" type="text/javascript" src="../mapping/new_idea/Controller/validate_idea.js">
</script>
<script src="../uploader/multifile_compressed.js"></script>

<form name="new_node" method="post" form enctype="multipart/form-data">
  	<div class="idea_container">
  		<div class="block_container">
            <div class="tittle">
                <div class="tittle_block">
                    Name
                </div>
                <div class="tittle_block">
                    Event
                </div>
                
                <div class="tittle_block">
                	Where 
                </div>
                <!--<div class="tittle_block">
                Images
                </div>-->
                <!--
                <div class="tittle_block">
                    Node latitude
                </div>
                <div class="tittle_block">
                    Node longitude
                </div> -->
              <div class="input_block">
                  <input type="button" class="subbutton2" name="Enter" value="nodefy" onclick="codeAddress('create');" />
              </div>
            </div>
            <div class="input">
                <div class="input_block">
                    <input type="text" name="node_name" class="textbox" />
                </div>
                <div class="input_block">
                    <input type="text" name="node_msg" class="textbox"  />
              </div>
              	<div class="input_block">
                    <input type="text" name="node_addr" class="textbox" id="create_address" />
                </div>
                
                
            <!--    
   <div class="fileinputs">
	<input type="file" class="file" />
	<div class="fakefile">
		<input />
		<img src="search.gif" />
	</div>
</div>       -->      
                
                
                <!--<div class="input_block">
					<input id="my_file_element" width="60px" type="file" name="file_1" >
                </div>-->
              
              <!--
                <div class="input_block">
                    <input type="text" name="node_lat" class="textbox" />
                </div>
                <div class="input_block">
                    <input type="text" name="node_long" class="textbox"  />
                </div> -->
              
            </div>
            <div id="loginErrors" style="color: red; float:left;">
            </div>  
            <!--<div id="files_list"></div>-->
		</div> 
    </div>
</form>
<!--
<script>

	var multi_selector = new MultiSelector( document.getElementById( 'files_list' ), 3 );

	multi_selector.addElement( document.getElementById( 'my_file_element' ) );
</script>-->