<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
	
	function _d ($er, $off=false)
	{
		echo "<pre>";
		print_r($er);
		echo "</pre>";
		if ($off) exit;
	}
	
	function _encrypt($text)
	{
		$secret_key = _config("encryption_key");
	    $secret_iv = _config("encryption_iv");
	 
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

		$encrypted = base64_encode( openssl_encrypt( $text, $encrypt_method, $key, 0, $iv ) );
		
		return $encrypted;
	}

	function _userData($key, $extra_key='')
	{
		$CI =& get_instance();

		$session = $CI->session->userdata();

		if(array_key_exists($key, $session)) {
			$data = $CI->session->userdata($key);

			if(is_array($data) && $extra_key != '') $return = $data[$extra_key];
			else $return = $data;
		} else $return = "";

		return $return;
	}

	function _loadView($view_name)
	{
		$CI =& get_instance();

		return ($view_name != "") ? $CI->load->view($view_name, NULL, TRUE) : "";
	}
	
	function _execute($query)
	{
		$data = '';
		try
		{
			$CI =& get_instance();
			
			$CI->db = $CI->load->database('default',TRUE);
			
			$res = $CI->db->query($query);
		}
		catch(Exception $e)
		{
			_d($query);
		}

		return $data;
	}
	
	function _query($query)
	{
		$CI =& get_instance();
		
		$CI->db = $CI->load->database('default',TRUE);
		
		$res = $CI->db->query($query);
		$data = $res->result_array();
		
		return $data;
	}
	
	function _link($key)
	{
		return site_url($key);
	}

	function _config($key)
	{
		$CI =& get_instance();
		
		return $CI->config->item($key);
	}

	function _config_multi($key, $item)
	{
		$CI =& get_instance();
		
		return $CI->config->item($item, $key);
	}
	
	function _table($key)
	{
		return _config_multi('table', $key);
	}
	
	function _view($key)
	{
		return _config_multi('view', $key);
	}
	
	function _post($key = '')
	{
		$CI =& get_instance();

		$post = $CI->input->post(NULL, TRUE);
		if($key == '') return $post;
		else {
			$check_key = (isset($_POST[$key]))?$_POST[$key]:'';
			
			return (!is_array($check_key)) ? sanitize($check_key) : $check_key;
		}
	}
	
	function _get($key)
	{
		$check_key = (isset($_GET[$key]))?$_GET[$key]:'';
		
		return $check_key;
	}
	
	function _resx($args){
		switch ($args) {
			case 'font':
				return base_url()._config('font');
				break;
			case 'css':
				return base_url()._config('css');
				break;
			case 'image':
				return base_url()._config('image');
				break;
			case 'js':
				return base_url()._config('js');
				break;
			case 'data':
				return base_url()._config('data');
				break;
		}	
	}
	
	function sanitize( $string, $html = true ){
		$CI =& get_instance();
		$new_string = trim($string);
		$new_string = strip_tags($new_string);
		// $new_string = htmlentities($new_string, ENT_QUOTES);
		return $CI->security->xss_clean($new_string);
	}

	function _tplInit($menu, $load_map, $load_search, $load_datatable, $custom_css_path = '', $custom_js_path = '')
	{
		$data['load_map'] = $load_map;
		$data['load_search'] = $load_search;
		$data['load_datatable'] = $load_datatable;
		$data['custom_css'] = $custom_css_path;
		$data['custom_js'] = $custom_js_path;
		$data['active_menu'] = $menu;

		return $data;
	}

	function _generateOptions($section, $selected_value = '')
	{
		$options = '';

		$query = str_replace("%t", _table($section), _view('get_options'));
        $data = _query($query);

        if(count($data) > 0) {
        	foreach ($data as $item) {
        		$selected = ($selected_value != "" && $item['option_id'] == $selected_value) ? ' selected="selected"' : "";

        		$options .= '<option value="'.$item['option_id'].'"'.$selected.'>'.$item['option_name'].'</option>';
        	}

        	return $options;
        }
	}

	function _generateOptionsNested($section, $field_name, $field_value, $selected_value = '')
	{
		$options = '';

		if($field_name == '') return $options;
		$field_value_test = json_decode($field_value);

		$query = str_replace("%t", _table($section), _view('get_options_nested'));

		if(is_array($field_value_test)) {
			$field_value = $field_value_test;
			$opt_multi = "(";

			foreach ($field_value as $item) {
				$opt_multi .= "(".$field_name." = '".$item."') OR ";
			}

			$opt_multi = substr($opt_multi, 0, strlen($opt_multi) - 4);
			$opt_multi .= ")";

			$query = str_replace("%f = '%v'", $opt_multi, $query);
		} else {
			$query = str_replace("%f", $field_name, $query);
			$query = str_replace("%v", $field_value, $query);
		}

        $data = _query($query);

        if(count($data) > 0) {
        	foreach ($data as $item) {
        		$selected = ($selected_value != "" && $item['option_id'] == $selected_value) ? ' selected="selected"' : "";

        		$options .= '<option value="'.$item['option_id'].'"'.$selected.'>'.$item['option_name'].'</option>';
        	}

        	return $options;
        }
	}

	function _menu($active, $current)
	{
		return ($current == $active['active_menu']) ? ' active' : '';
	}

	function _checkSession()
	{
		if(!_groupAccess(["Administrator","Super Admin"])) { redirect('akun/unauthorized'); }
	}

	function _isAuthorized()
	{
		return _groupAccess(["Administrator","Super Admin"]);
	}

	function _isLogin() {
        $ci =& get_instance();
        $user = $ci->session->userdata("userinfo");
        return ($user);		
	}

	function _groupAccess($role)   
    {
        $ci =& get_instance();
        $authorized = false;
        $user = $ci->session->userdata("userinfo");

        if($user) $authorized = (in_array($user["type"], $role));

        return $authorized;
    }

	function process_file($key_name, $filename)
	{
		$CI =& get_instance();
		
		$upload_config['upload_path'] = _config("upload_path").'/images';
		$upload_config['allowed_types'] = 'gif|jpg|png';
		$upload_config['file_name'] = $filename;
		$upload_config['overwrite'] = TRUE;

		$CI->upload->initialize($upload_config);

		$CI->upload->do_upload($key_name);
	}
?>