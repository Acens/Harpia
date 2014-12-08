<div class="wrap">
<div class="icon32"><img src='<?php echo plugins_url('/images/icon-32.png', dirname(__FILE__))?>' /></div>
        
<h2><?php echo __('Settings', self::CLASS_NAME)?> <?php echo self::PLUGIN_NAME?>:</h2>
    
  		<table width="100%"><tr>

        <td style="vertical-align:top">
 
 		<form action="" method="post">
        		<?php
                 wp_nonce_field('update',self::CLASS_NAME);
				?>
        <div class="metabox-holder">         
		<div class="postbox" >
        
        	<h3><?php _e('Global Seettings',self::CLASS_NAME);?></h3>
        
        	<div class="inside">
                <p>
                <label ><?php _e('How many characteres to display on the image',self::CLASS_NAME)?></label>
                <select name="length" >
                	<option value="1" <?php echo self::is_selected(1,$options["length"])?>>1</option>
                    <option value="2" <?php echo self::is_selected(2,$options["length"])?>>2</option>
                    <option value="3" <?php echo self::is_selected(3,$options["length"])?>>3</option>
                    <option value="4" <?php echo self::is_selected(4,$options["length"])?>>4</option>
                    <option value="5" <?php echo self::is_selected(5,$options["length"])?>>5</option>
                </select>
                </p>
                
                 <p>
                <label><?php _e('How many tries befor locking the IP',self::CLASS_NAME);?></label>
                <select name="tentativas" >
                	<option value="3" <?php echo self::is_selected(3,$options["tentativas"])?>>3</option>
                    <option value="4" <?php echo self::is_selected(4,$options["tentativas"])?>>4</option>
                    <option value="5" <?php echo self::is_selected(5,$options["tentativas"])?>>5</option>
                    <option value="6" <?php echo self::is_selected(6,$options["tentativas"])?>>6</option>
                    <option value="7" <?php echo self::is_selected(7,$options["tentativas"])?>>7</option>
                    <option value="8" <?php echo self::is_selected(8,$options["tentativas"])?>>8</option>
                    <option value="9" <?php echo self::is_selected(9,$options["tentativas"])?>>9</option>
                    <option value="10" <?php echo self::is_selected(10,$options["tentativas"])?>>10</option>
                </select>
                <small>( <?php _e('It stays locked during the current day',self::CLASS_NAME);?> )</small>
                </p>               


                 <p>
                <label><?php _e('Remove Blocked IPs from the blacklists',self::CLASS_NAME);?>:</label>
                <br /><input type="text" name="unblock_ips" class="regular-text" /> <small>( <?php _e('Separate the ips with commas',self::CLASS_NAME);?> )</small>
               
                </p> 
 
 
                  <p>
                <label><?php _e('Change your admin username and Improve your site security',self::CLASS_NAME);?>:</label>
                <?php _e('Your Current username is',self::CLASS_NAME);?>: <strong><?php echo $user_login?></strong>
                <br /><input type="text" name="username" class="regular-text" /> <small style="color:red">( <?php _e('Attention: Memorize your new username, because you will need it to be able to login',self::CLASS_NAME);?> )</small>
               
                </p> 
                

                 <p>
                <label><?php _e('Add IPs into permanent blacklist',self::CLASS_NAME);?>:</label>
                <br /><input type="text" name="block_ips" class="regular-text" /> <small>( <?php _e('Separate the ips with commas',self::CLASS_NAME);?> )</small>
               
                </p> 
                                                               
                <p>
                <input type="submit" name="submit" value="<?php _e('Save Changes', self::CLASS_NAME);?>" class="button-primary" />
				</p>

			</div>
		</div>
        </div>
 
 
 		<div class="metabox-holder">
 		<div class="postbox">
        
        	<h3><?php _e('Visual Settings', self::CLASS_NAME);?></h3>
        
        	<div class="inside">
            	<p>
                    <?php _e("Select the font color",self::CLASS_NAME);?>  <select name="font_color" >
                        <option value="0x00000000" style="color:#000" <?php echo self::is_selected("0x00000000",$options["font_color"])?>><?php _e('Black',self::CLASS_NAME);?></option>
                        <option value="0x00ffffff" style="color:#000" <?php echo self::is_selected("0x00ffffff",$options["font_color"])?>><?php _e('White',self::CLASS_NAME);?></option>
                        <option value="0x000099cc" style="color:#00F" <?php echo self::is_selected("0x000099cc",$options["font_color"])?>><?php _e('Blue',self::CLASS_NAME);?></option>
                        <option value="0x00f00000" style="color:#F00" <?php echo self::is_selected("0x00f00000",$options["font_color"])?>><?php _e('Red',self::CLASS_NAME);?></option>
                        <option value="0x0000f000" style="color:#060" <?php echo self::is_selected("0x0000f000",$options["font_color"])?>><?php _e('Green',self::CLASS_NAME);?></option>
                    </select>
                </p>
            
                <p>
                <h4> <?php _e('Select the background image',self::CLASS_NAME);?> </h4>
                <?php
				 	
                	for($i=1;$i<9;$i++){
						echo '<input type="radio" name="background" value="'.$i.'" ' . self::is_checked($i,$options["background"]) . '><img src="'. $anderson_makiyama[self::PLUGIN_ID]->plugin_url . 'images/'. $i .'.jpg">';
						if($i%3 ==0) echo "<br>";
                    }
					echo "<input type='radio' name='background' value='' " . self::is_checked(0,$options["background"]) . "> ". __('Aleatory',self::CLASS_NAME) ." <small>( ". __('Changes each time',self::CLASS_NAME) ." )</small><br>";
                ?>
                </p>
                <p>
                <input type="submit" name="submit" value="<?php _e('Save Changes',self::CLASS_NAME);?>" class="button-primary" />
				</p>

			</div>
		</div>
        </div>
        
        </form>
          
   		</td>
        <td style="vertical-align:top; width:410px">

        

        <div class="metabox-holder">

		<div class="postbox" >

        

        	<h3 style="font-size:24px; text-transform:uppercase;color:#F00;">

        	<?php _e('Take a Look!',self::CLASS_NAME);?>

            </h3>

            

             <h3><?php _e('Best Wordpress Themes',self::CLASS_NAME)?>: <a href="http://plugin-wp.net/aff_elegantthemes" target="_blank">Elegant Themes</a></h3>

             

        	<div class="inside">

                <p>

                <a href="http://plugin-wp.net/aff_elegantthemes" target="_blank"><img src="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_url?>images/elegantthemes.jpg" ></a>

				</p>



			</div>

 
 		</div>
        </div>
        
         <div class="metabox-holder">

		<div class="postbox" >           

            <h3><?php _e('Best Autoresponder for Email Marketing',self::CLASS_NAME)?>: <a href="http://plugin-wp.net/aff_trafficwave" target="_blank">TrafficWave</a></h3>

            

        	<div class="inside">

                <p>

                <a href="http://plugin-wp.net/aff_trafficwave" target="_blank"><img src="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_url?>images/trafficwave.jpg"></a>

				</p>



			</div> 

                        

		</div>

        </div>

              

       </td>
       </tr>
       </table>


<hr />


<table>
<tr>
<td>
<img src="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_url?>images/anderson-makiyama.png" />
</td>
<td>
<ul>

<li><?php _e('Author',self::CLASS_NAME);?>: <strong>Anderson Makiyama</strong>

</li>

<li><?php _e("Author's email",self::CLASS_NAME);?>: <a href="mailto:andersonmaki@gmail.com" target="_blank">andersonmaki@gmail.com</a>

</li>

<li><?php _e('Visit the Plugin page',self::CLASS_NAME);?>: <a href="<?php echo self::PLUGIN_PAGE?>" target="_blank"><?php echo self::PLUGIN_PAGE?></a>

</li>

<li>

<?php _e("Visit the author's site",self::CLASS_NAME);?>: <a href="http://plugin-wp.net" target="_blank">www.Plugin-WP.net</a>

</li>

</ul>
</td>
</tr>
</table>

</div>