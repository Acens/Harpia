<?php
/*
Plugin Name: Captcha on Login
Plugin URI: http://plugin-wp.net/captcha-on-login
Description: Protect your blog from login brute force attacks adding a captcha on login page
Author: Anderson Makiyama
Version: 2.0
Author URI: http://plugin-wp.net
*/

class Anderson_Makiyama_Captcha_On_Login{

	const CLASS_NAME = 'Anderson_Makiyama_Captcha_On_Login';
	public static $CLASS_NAME = self::CLASS_NAME;
	const PLUGIN_ID = 5;
	public static $PLUGIN_ID = self::PLUGIN_ID;
	const PLUGIN_NAME = 'Captcha On Login';
	public static $PLUGIN_NAME = self::PLUGIN_NAME;
	const PLUGIN_PAGE = 'http://plugin-wp.net/captcha-on-login';
	public static $PLUGIN_PAGE = self::PLUGIN_PAGE;
	const PLUGIN_VERSION = '2.0';
	public static $PLUGIN_VERSION = self::PLUGIN_VERSION;
	public $plugin_basename;
	public $plugin_path;
	public $plugin_url;
	
	public function get_static_var($var) {

        return self::$$var;

    }
	
	public function activation(){
		
		$options = get_option(self::CLASS_NAME . "_options");

		if(!isset($options['length'])) $options['length'] = 5;
		if(!isset($options['tentativas'])) $options['tentativas'] = 5;
		if(!isset($options['background'])) $options['background'] = 0;
		if(!isset($options['font_color'])) $options['font_color'] = '0x00f00000';

		update_option(self::CLASS_NAME . "_options", $options);
		
	}
	
	public function Anderson_Makiyama_Captcha_On_Login(){ //__construct()

		$this->plugin_basename = plugin_basename(__FILE__);
		$this->plugin_path = dirname(__FILE__) . "/";
		$this->plugin_url = WP_PLUGIN_URL . "/" . basename(dirname(__FILE__)) . "/";
		
		load_plugin_textdomain( self::CLASS_NAME, false, strtolower(str_replace(" ","-",self::PLUGIN_NAME)) . '/lang' );	

	}
	

	public function settings_link($links) { 
		global $anderson_makiyama;
	  
		$settings_link = '<a href="options-general.php?page='. self::CLASS_NAME .'">'. __('Settings',self::CLASS_NAME) . '</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}	
	

	public function options(){

		global $anderson_makiyama;

		global $user_level;

		get_currentuserinfo();


		if (function_exists('add_options_page')) { //Adiciona pagina na seção Configurações
			
			add_options_page(self::PLUGIN_NAME, self::PLUGIN_NAME, 1, self::CLASS_NAME, array(self::CLASS_NAME,'options_page'));
		
		}
		if (function_exists('add_submenu_page')){ //Adiciona pagina na seção plugins
			
			add_submenu_page( "plugins.php",self::PLUGIN_NAME,self::PLUGIN_NAME,1, self::CLASS_NAME, array(self::CLASS_NAME,'options_page'));			  
		}

  		 add_menu_page(self::PLUGIN_NAME, self::PLUGIN_NAME,1, self::CLASS_NAME,array(self::CLASS_NAME,'options_page'), plugins_url('/images/icon.png', __FILE__));
		 
		 add_submenu_page(self::CLASS_NAME, self::PLUGIN_NAME,__('Report',self::CLASS_NAME),1, self::CLASS_NAME . "_Report", array(self::CLASS_NAME,'report_page'));
		 
		 add_submenu_page(self::CLASS_NAME, self::PLUGIN_NAME,__('Help page',self::CLASS_NAME),1, self::CLASS_NAME . "_Help", array(self::CLASS_NAME,'help_page'));
		 
		 global $submenu;
		 if ( isset( $submenu[self::CLASS_NAME] ) )
			$submenu[self::CLASS_NAME][0][0] = __('Settings',self::CLASS_NAME);

	}	

	

	public function options_page(){

		global $anderson_makiyama, $wpdb, $user_ID, $user_level, $user_login;

		get_currentuserinfo();

		if ($user_level < 10) { //Limita acesso para somente administradores

			return;

		}	

		$options = get_option(self::CLASS_NAME . "_options");

		if ($_POST['submit']) {

			if(!wp_verify_nonce( $_POST[self::CLASS_NAME], 'update' ) ){
				
				print 'Sorry, your nonce did not verify.';
  				exit;
   
			}
			
			$options['length'] = $_POST['length'];
			$options['background'] = $_POST['background'];
			$options['font_color'] = $_POST['font_color'];
			$options['tentativas'] = $_POST['tentativas'];
			
			$admin_login = trim($_POST['username']);
			
			$unblock_ips = $_POST['unblock_ips'];
			
			$block_ips = $_POST['block_ips'];

			//Se não existe, cria $permanent_ips
			if(!isset($options["permanent_ips"])){
							   
				$permanent_ips = array();
				
			}else{
				
				$permanent_ips = $options["permanent_ips"];
				
			}//
							
			if(!empty($unblock_ips)){
			
				$unblock_ips = explode(",",$unblock_ips);
				$unblock_ips = array_map('trim',$unblock_ips);
				
				if(!isset($options["ips"])){
								   
					$ips = array();
					
				}else{
					
					$ips = $options["ips"];
					
				}
				
				//Controla ips bloqueado do dia
				
				$keep_ips = array();
				
				foreach($ips as $ip){
					
					if(in_array($ip[0],$unblock_ips)) continue;
					
					$keep_ips[] = $ip;
					
				}
				
				$options["ips"] = $keep_ips;
				
				//Controla ips permanentemente bloqueados
				
				$keep_p_ips = array();
				
				foreach($permanent_ips as $p_ip){
					
					if(in_array($p_ip,$unblock_ips)) continue;
					
					$keep_p_ips[] = $p_ip;
					
				}
				
				$options["permanent_ips"] = $keep_p_ips;				
				
			}
			
			if(!empty($block_ips)){//Adiciona na lista de ips bloqueados permanentemente

				$block_ips = explode(",",$block_ips);
				$block_ips = array_map('trim',$block_ips);
				
				$permanent_ips = array_merge($permanent_ips,$block_ips);
				$permanent_ips = array_unique($permanent_ips);
				
				$options["permanent_ips"] = $permanent_ips;				
				
			}
			

			update_option(self::CLASS_NAME . "_options", $options);
			
			
			if(!empty($admin_login)){
			
                
                $table_name = $wpdb->prefix . "users";

                $data = array('user_login'=>$admin_login);                
                $where = array('ID'=>$user_ID);
                $format = array('%s');
                $wformat = array('%d');
                
                $update = $wpdb->update( $table_name, $data, $where, $format, $wformat);
				
			
			}
			
			
			echo '<div id="message" class="updated">';
			echo '<p><strong>'. __('Settings has been saved successfully!',self::CLASS_NAME) . '</strong></p>';
			echo '</div>';			

		}


		include("templates/options.php");

	}		


	public function help_page(){

		global $anderson_makiyama;

		include("templates/help.php");

	}	
	
	
	public function report_page(){

		global $anderson_makiyama;
		
		$options = get_option(self::CLASS_NAME . "_options");
		
		if(!isset($options["last_100_logins"])){
						   
			$last_100_logins = array();
			
		}else{
			
			$last_100_logins = $options["last_100_logins"];
			
		}
		
		$last_100_logins = array_reverse($last_100_logins);
		
		//IPs bloqueados do dia
		if(!isset($options["ips"])){
						   
			$ips = array();
			
		}else{
			
			$ips = $options["ips"];
			
		}

		//IPs permanentemente bloqueados
		if(!isset($options["permanent_ips"])){
						   
			$permanent_ips = array();
			
		}else{
			
			$permanent_ips = $options["permanent_ips"];
			
		}
		
		include("templates/report.php");

	}		
	

	public static function make_data($data, $anoConta,$mesConta,$diaConta){

	   $ano = substr($data,0,4);
	   $mes = substr($data,5,2);
	   $dia = substr($data,8,2);

	   return date('Y-m-d',mktime (0, 0, 0, $mes+($mesConta), $dia+($diaConta), $ano+($anoConta)));	

	}

	public static function add_to_login_form(){
		
		global $anderson_makiyama;
		
		$options = get_option(self::CLASS_NAME . "_options");
		
		$length = isset($options['length'])?$options['length']:5;
		
		if(!session_id()) session_start();
		
		$_SESSION[self::CLASS_NAME . "_code"] = self::get_code($length);
		$_SESSION[self::CLASS_NAME . "_font_color"] = $options["font_color"];
		$_SESSION[self::CLASS_NAME . "_background"] = $options["background"];
		
		echo
				'<p>
					<label>
						<img style="width:160px !important;" src="'. $anderson_makiyama[self::PLUGIN_ID]->plugin_url.'get_image.php" /><br/>
						'. __('Enter the Image Code',self::CLASS_NAME) .'
						<input type="text" name="codigo" class="input" value="" size="20" tabindex="1000"><br/>
					</label>
				</p>';	
				
	}
	
	
	public function check_code($cookie_checking=false){
		
		global $anderson_makiyama; 
		
		if(!session_id()) session_start();
		
		if(!isset($_POST["log"]) && !$cookie_checking) return; //Sem envio do formulario e não é checagem de cookie
		
		$total_error_code = isset($_SESSION[self::CLASS_NAME . "_total_error_code"])?$_SESSION[self::CLASS_NAME . "_total_error_code"]:0;
		
		$options = get_option(self::CLASS_NAME . "_options");
		
		//Verifica se IP foi bloqueado
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$today = date("Y-m-d");
		
		$day_ips = array();
		
		$bloqueado = false;

		//Verifica se não está entre os ips bloqueados do dia
		if(!isset($options["ips"])){
						   
			$ips = array();
			
		}else{
			
			$ips = $options["ips"];	
			
		}
		
		for($i=0;$i<count($ips);$i++){
			
			if($ips[$i][1] == $today){
				
				$day_ips[] = $ips[$i];
				if($ips[$i][0] == $ip) $bloqueado = true;
				
			}
			
		}
		
		$options["ips"] = $day_ips;
		//

		//Verifica se não está na lista permanente de ips bloqueados
		if(!isset($options["permanent_ips"])){
						   
			$permanent_ips = array();
			
		}else{
			
			$permanent_ips = $options["permanent_ips"];	
			if(in_array($ip,$permanent_ips)) $bloqueado = true;
		}
		//		
		
		if($bloqueado){
			
			$anderson_makiyama[self::PLUGIN_ID]->log_logins(__('Failed: IP already blocked',self::CLASS_NAME),$options);
			
			wp_logout();
			
			echo "<script>alert(' . " . __('Your IP has been Locked! Try again tomorrow',self::CLASS_NAME) . " ');document.location='" . wp_login_url() . "';</script>";
			
			exit;
			
		}

		if($_SESSION[self::CLASS_NAME . "_total_error_code"] >= $options["tentativas"]){

			
			//retorna 
			$options = $anderson_makiyama[self::PLUGIN_ID]->block_ip($options);
			
			$anderson_makiyama[self::PLUGIN_ID]->log_logins(__('Failed: exceeded max number of tries',self::CLASS_NAME),$options);

			wp_logout();
			
			echo "<script>alert('". __('Your IP has been Locked! Try again tomorrow',self::CLASS_NAME) ."');document.location='" . wp_login_url() . "';</script>";
			
			exit;
			
		}
		
		if(!isset($_SESSION[self::CLASS_NAME . "_code"]) || empty($_POST['codigo']) || strtolower($_SESSION[self::CLASS_NAME . "_code"]) != strtolower($_POST['codigo'])){
			
			$anderson_makiyama[self::PLUGIN_ID]->log_logins(__('Failed: image code did not match',self::CLASS_NAME),$options);
			
			wp_logout();
			
			echo "<script>alert('". __('The Image Code is incorrect! Try again!',self::CLASS_NAME) ."');document.location='" . wp_login_url() . "';</script>";
           
		    $total_error_code++; $_SESSION[self::CLASS_NAME . "_total_error_code"] = $total_error_code;
			
			exit;
			
			
		}
		
		return true;
			
	}
		
	public function login_failed($errors){
		
		global $anderson_makiyama;
		
		$options = get_option(self::CLASS_NAME . "_options");
		
		$anderson_makiyama[self::PLUGIN_ID]->log_logins(__('Failed: Login or Password did not match',self::CLASS_NAME),$options);
	
		return($errors);
		
	}


	public function login_success(){
		
		global $anderson_makiyama;
		
		$options = get_option(self::CLASS_NAME . "_options");

		//Verifica se Não Foi Bloqueado já		
		$anderson_makiyama[self::PLUGIN_ID]->log_logins(__('Success',self::CLASS_NAME),$options);
	
		return true;
		
	}


	public static function get_code($length){
	
		$code = str_split("23456789bcdfghjkmnpqrstvwxyzBCDFGHJKMNPQRSTVWXYZ");
		
		$final_code = "";
		$count_code = count($code);
		
		for($i=0;$i<$length;$i++){
			$final_code.= $code[mt_rand(0,($count_code -1))];
		}
		
		return $final_code;
	}
	

	private function block_ip($options){
		
		if(!isset($options["ips"])){
						   
			$ips = array();
			
		}else{
			
			$ips = $options["ips"];	
			
		}
			
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$today = date("Y-m-d");
			
		$ips[] = array($ip, $today);
		
		$options["ips"] = $ips;
		
		unset($_SESSION[self::CLASS_NAME . "_total_error_code"]);
		
		return $options;
		
	}
	
	private function log_logins($status, $options){
		
		if(!isset($options["last_100_logins"])){
						   
			$last_100_logins = array();
			
		}else{
			
			$last_100_logins = $options["last_100_logins"];
			
		}
			
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$today = date("d/m/Y H:i:s");
			
		$last_100_logins[] = array($ip,$today,$status);
		
		if(count($last_100_logins)>1000) $last_100_logins = array_slice($last_100_logins,-1,1000);
		
		$options["last_100_logins"] = $last_100_logins;
		
		update_option(self::CLASS_NAME . "_options",$options);
		
	}
	
	public static function get_data_array($data,$part=''){

	   $data_ = array();
	   $data_["ano"] = substr($data,0,4);
	   $data_["mes"] = substr($data,5,2);
	   $data_["dia"] = substr($data,8,2);
	   
	   if(empty($part))return $data_;

	   return $data_[$part];

	}	
	
	

	public static function is_checked($vl1,$vl2){

		if($vl1==$vl2) return " checked=checked ";

		return "";
		
	}	
	
	

	public static function is_selected($vl1, $vl2){

		if($vl1==$vl2) return " selected=selected ";

		return "";

	}	
	
	
	public function cookie_bad_username($cookie_elements) {
		
		self::clear_auth_cookie();
		
		self::check_code(true);
	
	}

	public function cookie_bad_hash($cookie_elements) {
		
		self::clear_auth_cookie();
		
		self::check_code(true);
	
	}
	
	public function check_blocked_ips_befor_all(){
		
		global $anderson_makiyama;
		
		$options = get_option(self::CLASS_NAME . "_options");
		
		//Verifica se não está entre os IPs bloqueados do dia
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$today = date("Y-m-d");
		
		$bloqueado = false;

		if(!isset($options["ips"])){
						   
			$ips = array();
			
		}else{
			
			$ips = $options["ips"];	
			
		}
		
		for($i=0;$i<count($ips);$i++){
			
			if($ips[$i][1] == $today){
				
				if($ips[$i][0] == $ip) $bloqueado = true;
				
			}
			
		}
		
		//
		
		//Verifica se não está na lista permanente de ips bloqueados
		if(!isset($options["permanent_ips"])){
						   
			$permanent_ips = array();
			
		}else{
			
			$permanent_ips = $options["permanent_ips"];	
			if(in_array($ip,$permanent_ips)) $bloqueado = true;
		}
		//			
		
		if($bloqueado){
			
			if(is_admin()) $anderson_makiyama[self::PLUGIN_ID]->log_logins(__('Failed: IP already blocked',self::CLASS_NAME),$options);
			
			self::clear_auth_cookie();
			wp_logout();
			
		}
		
				
		
	}
		
	protected function clear_auth_cookie() { 
		
		wp_clear_auth_cookie();//Remove todos os cookies associados com autenticação
		
		//Para assegurar, Limpa manualmente os cookies
	
		setcookie( AUTH_COOKIE,        ' ', time() - YEAR_IN_SECONDS, ADMIN_COOKIE_PATH,   COOKIE_DOMAIN );
		setcookie( SECURE_AUTH_COOKIE, ' ', time() - YEAR_IN_SECONDS, ADMIN_COOKIE_PATH,   COOKIE_DOMAIN );
		setcookie( AUTH_COOKIE,        ' ', time() - YEAR_IN_SECONDS, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN );
		setcookie( SECURE_AUTH_COOKIE, ' ', time() - YEAR_IN_SECONDS, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN );
		setcookie( LOGGED_IN_COOKIE,   ' ', time() - YEAR_IN_SECONDS, COOKIEPATH,          COOKIE_DOMAIN );
		setcookie( LOGGED_IN_COOKIE,   ' ', time() - YEAR_IN_SECONDS, SITECOOKIEPATH,      COOKIE_DOMAIN );
	
		// Old cookies
		setcookie( AUTH_COOKIE,        ' ', time() - YEAR_IN_SECONDS, COOKIEPATH,     COOKIE_DOMAIN );
		setcookie( AUTH_COOKIE,        ' ', time() - YEAR_IN_SECONDS, SITECOOKIEPATH, COOKIE_DOMAIN );
		setcookie( SECURE_AUTH_COOKIE, ' ', time() - YEAR_IN_SECONDS, COOKIEPATH,     COOKIE_DOMAIN );
		setcookie( SECURE_AUTH_COOKIE, ' ', time() - YEAR_IN_SECONDS, SITECOOKIEPATH, COOKIE_DOMAIN );
	
		// Even older cookies
		setcookie( USER_COOKIE, ' ', time() - YEAR_IN_SECONDS, COOKIEPATH,     COOKIE_DOMAIN );
		setcookie( PASS_COOKIE, ' ', time() - YEAR_IN_SECONDS, COOKIEPATH,     COOKIE_DOMAIN );
		setcookie( USER_COOKIE, ' ', time() - YEAR_IN_SECONDS, SITECOOKIEPATH, COOKIE_DOMAIN );
		setcookie( PASS_COOKIE, ' ', time() - YEAR_IN_SECONDS, SITECOOKIEPATH, COOKIE_DOMAIN );

		
	}
	

}

if(!isset($anderson_makiyama)) $anderson_makiyama = array();

$anderson_makiyama_indice = Anderson_Makiyama_Captcha_On_Login::PLUGIN_ID;

$anderson_makiyama[$anderson_makiyama_indice] = new Anderson_Makiyama_Captcha_On_Login();

add_filter("plugin_action_links_". $anderson_makiyama[$anderson_makiyama_indice]->plugin_basename, array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'settings_link') );

add_filter("admin_menu", array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'options'),30);

add_action('login_form', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'add_to_login_form'));

add_action('wp_authenticate', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'check_code'));

add_filter('login_errors', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'login_failed'));

add_filter('wp_login', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'login_success'));


add_action('auth_cookie_bad_username', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'cookie_bad_username'));
add_action('auth_cookie_bad_hash', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'cookie_bad_hash'));

//add_filter('wp_authenticate_user', '');
//add_filter('shake_error_codes', '');
//add_action('login_head', '');
//add_action('auth_cookie_valid','');

register_activation_hook( __FILE__, array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'activation') );

add_action('plugins_loaded', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'check_blocked_ips_befor_all'),0);

?>