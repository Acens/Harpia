<div class="wrap">
<div class="icon32"><img src='<?php echo plugins_url('/images/icon-32.png', dirname(__FILE__))?>' /></div>
        
<h2><?php echo self::PLUGIN_NAME?> <?php echo __('Reports', self::CLASS_NAME)?>:</h2>
    
  		<table width="100%"><tr>
        <td style="vertical-align:top">
 
 		
        
        <div class="metabox-holder">         
		<div class="postbox" >
        	<h3><?php _e('Last 1000 successfull or failed logins',self::CLASS_NAME);?></h3>
        
        	<div class="inside">
            
            <label><?php _e('IP&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Date and Time&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Status',self::CLASS_NAME)?></label>
            
                <p>
                <select name="last_logins" size="10" multiple="multiple" >
                	<?php
					foreach($last_100_logins as $login):
					?>
                    <option><?php echo implode("&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;",$login)?></option>
                    <?php
					endforeach;
					?>
                </select>
                </p>

			</div>
		</div>
        </div>
 
 
 		<div class="metabox-holder">
 		<div class="postbox">
        
        	<h3><?php _e('All Currently Blocked IPs', self::CLASS_NAME);?></h3>
        
        	<div class="inside">
            
            	<table width="100%">
                <tr>
                <td width="50%">
                <h4><?php _e('Temporary Blocked IPs', self::CLASS_NAME);?></h4>
            	
            	<p>
                    <select name="blocked_ips" size="10" multiple="multiple" >
                        <?php
                        foreach($ips as $ip):
                        ?>
                        <option><?php echo $ip[0];?></option>
                        <?php
                        endforeach;
						
						if(empty($ips)) echo "<option>" . __('Currently there is no Ips blocked. That is good :)', self::CLASS_NAME) . "</option>";
                        ?>
                    </select>
                </p>
            	<label><?php _e('Note that temporary blocked IPs are unblocked<br> automatically on the next day!', self::CLASS_NAME);?></label>
				</td>
                <td width="50%">

                <h4 style="color:red;"><?php _e('Permanent Blocked IPs', self::CLASS_NAME);?></h4>
            	
            	<p>
                    <select name="permanent_blocked_ips" size="10" multiple="multiple" >
                        <?php
                        foreach($permanent_ips as $p_ip):
                        ?>
                        <option><?php echo $p_ip;?></option>
                        <?php
                        endforeach;
						
						if(empty($permanent_ips)) echo "<option>" . __('Currently there is no Permanent Ips blocked. That is good :)', self::CLASS_NAME) . "</option>";
                        ?>
                    </select>
                </p>
                <label><?php _e('Note that permanent blocked IPs keep blocked<br>until you unblock it manually!', self::CLASS_NAME);?></label>                
                </td>
                </tr>
                </table>
                
			</div>
		</div>
        </div>
                
        
          
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