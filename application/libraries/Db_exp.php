<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

//$this->output .= '<script src="'.base_url().'assets/public/ckeditor/ckeditor.js"></script>';

class Db_exp
{
    public $table;
    public $default_action;
    public $pri_id;
    public $fields = array();
    public $actions = array();
    public $search_condition;
    public $form_action;
    public $form_attributes;
    public $form_id;
    public $posted_data;
    public $output = '';
    public $format;
    public $ci;
    public $html_count  = 0;
    var $insert_id;
    public $form_hidden = array();
    public $arg_link;
    public $process = true;

    public function __construct()
    {

        //$this->load->library('form_validation');
        $this->pri_id = 0;
        $this->form_action = uri_string().'?'.$_SERVER['QUERY_STRING'];;
        $this->default_action = 'edit';
        $this->search_condition = false;
        $this->actions['link'] = array();
        $this->fields = array();

        $this->form_hidden['db_exp_submit_engaged'] = 1;
        $this->show_form_after_submit = true ;
        $this->show_submit_button = true;
        $this->show_insert_button = true;
        $this->show_delete_button = true;
        $this->show_edit_button = true;
        $this->is_posted    = false;
        $this->output = '';
        $this->arg_link = array();

        $this->ci   = &get_instance();
        $this->ci->load->library('upload');
        $this->ci->load->library('EvalMath');
        $this->ci->load->library('form_validation');

        $this->EvalMath = new EvalMath();

        //echo '<pre>'; print_r($this->ci->input->get());echo '</pre>';

        $form_id    = array_key_exists('form_id', $_REQUEST) ? $this->ci->input->post_get('form_id') : '';
        $this->form_target = $form_id;
        if(empty($form_id)) $form_id = uniqid();

        $this->form_id = 'form_'.$form_id;
        $this->form_attributes = array('id' => $this->form_id, 'target' => $this->form_target);
        //echo $this->form_action;

    }

    public function render($action = "default")
    {
        //$CI = &get_instance();

        // $this->output .= 'render ' . $action . ' ' . $this->table;
        // check if it is a ajax submit
        $post = $this->ci->input->post() + $this->ci->input->get();

        if (array_key_exists('action', $post)) {
            $action = $post['action'];
        }
        if ($action == "default") {
            $action = $this->default_action;
        }


        $ret = 2;
        if (array_key_exists('db_exp_submit_engaged', $post)) {
            // Execute submit
            $this->is_posted = true;
            
            //$ret = $this->_process_submit($CI->input->post());
            $this->posted_data = $this->_process_submit($this->ci->input->post());


            // what to do after submit
            if ($this->show_form_after_submit) {
                return $this->posted_data;
            }
        }


        switch (strtolower($action)) {

            case 'edit':
            case 'insert':
                $this->_render_edit();
                break;
            case 'delete':
                $ret = $this->_render_delete();
                break;
            case 'view':
                $this->_set_readonly();
                $this->_render_edit();
                break;
            case 'col_list':
                $this->_render_list_col();
                break;
            case 'row_list':
                $this->_render_listo();
                break;
        }

        return $ret;

    }

    public function set_table($table)
    {
        $this->table    = $table;
    }

    public function set_process($bool){
        $this->process  = $bool;
    }

    public function format($array){

        $this->format   = $array;
    }

    public function set_form_action($uri)
    {
        $this->form_action = $uri;
    }

    public function set_arg_link($action, $target, $title, $icon = 'icon-grid'){
        $tmp    = array(
            'action'    => $action,
            'target'    => $target,
            'title'     => $title,
            'icon'      => $icon
        );

        array_push($this->arg_link, $tmp);
    }

    public function set_form_attribute($option, $value = '')
    {

        if (is_array($option)) {
            foreach ($option as $key => $val) {
                $this->form_attributes[$key] = $val;
            }
        } else {
            $this->form_attributes[$option] = $value;
        }
    }

    public function set_form_hidden_values($option, $value = 0)
    {
        if (is_array($option)) {
            foreach ($option as $key => $val) {
                $this->form_hidden[$key] = $val;
            }

            return;
        }
        if ($value) {
            $this->form_hidden[$option] = $value;
        }


    }

    public function set_upload($index, $config = array()){

        $default['upload_path']     = FCPATH.'assets/uploads/';
        $default['allowed_types']   = 'gif|jpg|jpeg|png|pdf|xlsx|avi|mp4';
        $default['max_size']        = 50000;
        $default['max_width']       = 102400;
        $default['max_height']      = 76800;

        $config = array_merge($default,$config);
        $this->fields[$index]['upload'] = $config;
    }

    public function set_pri_id($id)
    {
        $this->pri_id = $id;
    }

    public function set_search_condition($where)
    {

        $this->search_condition = $where;
    }

    public function set_hidden($index, $value = false)
    {

        if (is_array($index)) {
            foreach ($index as $key => $val) {

                if (is_int($key)) {
                    // value not set
                    $this->fields[$val]['hidden'] = false;
                } else {
                    $this->fields[$key]['hidden'] = $val;
                }
            }
        } else {
            $this->fields[$index]['hidden'] = $value;
        }
    }

    public function set_button($icon,$controller){
        $this->fields['button'][$icon] = $controller;
    }

    public function set_validation($index,$options){
        $this->fields[$index]['validation'] = $options;
    }

    public function set_json_field($index, $options)
    {
        $this->fields[$index]['json'] = $options;

    }

    public function set_readonly($index)
    {
        $this->fields[$index]['view'] = true;
    }

    public function set_wrp_class($index,$class){
        $this->fields[$index]['wrp_class']  = $class;
    }

    public function set_edit_in_place($index, $value = false){
        if (is_array($index)) {
            foreach ($index as $key => $val) {

                if (is_int($key)) {
                    // value not set
                    $this->fields[$val]['eip'] = false;
                } else {
                    $this->fields[$key]['eip'] = $val;
                }
            }
        } else {
            $this->fields[$index]['eip'] = $value;
        }
    }

    public function set_db_select($index, $table, $val, $label, $condition = false)
    {
        if ($condition) $this->ci->db->where($condition);
        $this->ci->db->select($val . ',' . $label);
        $query = $this->ci->db->get($table);
        $arr = array();
        foreach ($query->result_array() as $row) {
            $key = $row[$val];
            $lab = $row[$label];
            $arr[$key] = $lab;
        }

        $this->fields[$index]['db_select'] = $arr;
    }

    public function set_db_list($index, $table, $val, $label, $condition = false){
        if ($condition) $this->ci->db->where($condition);
        $this->ci->db->select($val . ',' . $label);
        $query = $this->ci->db->get($table);
        $arr = array();

        foreach ($query->result_array() as $row) {
            $key = $row[$val];
            $lab = $row[$label];
            $arr[$key] = $lab;
        }
        $this->fields[$index]['list'] = $arr;
    }

    public function set_list($index, $options, $values_as_keys = false){
        if ($values_as_keys) {
            $opt = array();
            foreach ($options as $val) {
                $opt[$val] = $val;
            }
            $options = $opt;
        }
        $this->fields[$index]['list'] = $options;
    }

    public function set_multiselect($index, $options, $values_as_keys = false){
        if ($values_as_keys) {
            $opt = array();
            foreach ($options as $val) {
                $opt[$val] = $val;
            }
            $options = $opt;
        }
        $this->fields[$index]['multiselect'] = $options;
    }
    
    public function set_db_multiselect($index, $table, $val, $label, $condition = false){
        if ($condition) $this->ci->db->where($condition);
        $this->ci->db->select($val . ',' . $label);
        $query = $this->ci->db->get($table);
        $arr = array();

        foreach ($query->result_array() as $row) {
            $key = $row[$val];
            $lab = $row[$label];
            $arr[$key] = $lab;
        }
        $this->fields[$index]['multiselect'] = $arr;
    }


    public function set_select($index, $options, $values_as_keys = false)
    {


        if ($values_as_keys) {
            $opt = array();
            foreach ($options as $val) {
                $opt[$val] = $val;
            }
            $options = $opt;
        }
        $this->fields[$index]['select'] = $options;
    }

    public function set_date($index)
    {
        $this->fields[$index]['date'] = 1;
    }

    public function set_time($index)
    {
        $this->fields[$index]['time'] = 1;
    }

    public function set_input($index, $options = '')
    {
        $this->fields[$index]['input'] = $options;
    }

    public function set_password($index, $validation = 'md5')
    {
        $this->fields[$index]['password'] = 1;
    }

    public function set_password_dblcheck($index, $validation = 'md5')
    {
        $this->fields[$index]['password_dblcheck'] = 1;
    }

    public function set_textarea($index, $options = '')
    {
        $this->fields[$index]['textarea'] = $options;
    }

    public function set_html($html){
        $this->fields['html_'.$this->html_count++] = $html;
    }



    public function set_label($index, $options)
    {
        $this->fields[$index]['label'] = $options;
    }

    public function set_row_link($link)
    {
        array_push($this->actions['link'], $link);
    }

    public function set_default_action($act)
    {
        $this->default_action = $act;
    }

    public function set_view($index)
    {
        $this->fields[$index]['view'] = true;
    }

    public function set_formula($index,$formula){
        $this->fields[$index]['formula']    = $formula;
    }

    public function set_service($index,$service){
        $this->fields[$index]['service']    = $service;
    }


    public function get_field($field, $id)
    {

        $this->ci->db->where('id', $id);
        $query = $this->db->get($this->table);
        $row = $query->result_array();
        return $row[$field];
    }

    private function _process_submit($posts)
    {
        //$this->output .= '<pre>';print_r($this->fields);$this->output .= '</pre>';
        $post_to_db = array();
        log_message('DEBUG',json_encode($posts));
        // loop through table fields
        $q = 'describe ' . $this->table;
        $query = $this->ci->db->query($q);
        $upload_err = false;
        $validation = false;


        foreach ($query->result_array() as $row) {

            $key = $row['Field'];
            if (array_key_exists($key, $posts)) {
                $val = $posts[$key];
            } else {
                $val = 'CONTINUE_ON';
            }

            if ($key == 'db_exp_submit_engaged') {
                continue;
            }
            
            
            if ($key != 'id' && array_key_exists($key, $this->fields) && array_key_exists('hidden', $this->fields[$key])){
                // check if it has a value;
                if($this->fields[$key]['hidden'] == false) {
                    continue;
                };
            }

            if(array_key_exists($key,$this->fields) && array_key_exists('upload',$this->fields[$key]) ){
                $this->ci->upload->initialize($this->fields[$key]['upload']);
               
                if( ! $this->ci->upload->do_upload($key)){

                    //  check if value was previously set
                    if(array_key_exists($key.'_orig',$posts) && !empty($posts[$key.'_orig'])){
                        $post_to_db[$key]   = $posts[$key.'_orig'];

                    }else{
                        $upload_err = $this->ci->upload->display_errors();
                    }
                }else{
                    // success
                    $post_to_db[$key]   = $this->ci->upload->data('file_name');
                }
            }

            if(array_key_exists($key,$this->fields) && array_key_exists('date',$this->fields[$key]) ){

                 $val = date('Y-m-d H:i:s',strtotime($val));

            }


            if (array_key_exists($key, $this->fields) && array_key_exists('json', $this->fields[$key])) {
                // json variable
                $catch = $this->fields[$key]['json'];
                $tmp = array();

                foreach ($catch as $check) {

                    // check if check is upload value
                    if(array_key_exists($check,$this->fields) && array_key_exists('upload',$this->fields[$check]) ){

                        $this->ci->upload->initialize($this->fields[$check]['upload']);

                        if( ! $this->ci->upload->do_upload($check)){
                            //  check if value was previously set
                            if(array_key_exists($check.'_orig',$posts) && !empty($posts[$check.'_orig'])){
                                $tmp[$check]    = $posts[$check.'_orig'];
                            }else{
                                $upload_err = $this->ci->upload->display_errors();
                            }
                        }else{
                            // success
                            $tmp[$check]= $this->ci->upload->data('file_name');
                        }
                    }else{

                        $tmp[$check] = $posts[$check];
                    }
                }

                //$this->output .= 'tuliingia <pre>'; print_r($tmp);
                $json = json_encode($tmp);
                $post_to_db[$key] = $json;

                $val = 'CONTINUE_ON';
            }

            //print_r($post_to_db);
            // check service
            if (array_key_exists($key, $this->fields) && array_key_exists('service', $this->fields[$key])){

                parse_str ( $this->fields[$key]['service'], $service );
                $get_args   = array();

                

                foreach($service as $k2 => $v2){

                    if($k2 == 'url'){
                        $url    = $v2;
                        continue;
                    }

                    if($v2[0] == '$'){
                        $get_args[$k2]  = $posts[substr($v2,1)];
                    }else{
                        $get_args[$k2]  = $v2;
                    }
                }

                $web_service_url    = $url.'?'.http_build_query($get_args);
                $result     = file_get_contents($web_service_url);
                log_message('DEBUG','WEB SERVICE BEING result '.$result);
                $m       = json_decode(utf8_encode($result));
         
                $result     = $m->result;
                $post_to_db[$key]   = $result;
                continue;
            }

            // check password
            if (array_key_exists($key, $this->fields) && array_key_exists('password_dblcheck', $this->fields[$key])){

                $this->output .= 'we have a password';
                $result = md5($val);
                $post_to_db[$key]   = $result;

                $val = 'CONTINUE_ON';
            }

            // check formulas
            if (array_key_exists($key, $this->fields) && array_key_exists('formula', $this->fields[$key])){

                $formula    = ' ';
                $tmp        = explode(" ",$this->fields[$key]['formula']);
                //print_r($tmp);
                foreach($tmp as $ee){
                    if($ee[0] == '$'){
                        $formula .= $posts[substr($ee,1)];
                    }else{
                        $formula .= ' '.$ee;
                    }
                }

                //$this->output .= "hii ni formula ".$formula;

                $res = $this->EvalMath->evaluate($formula);
                $_POST[$key]        = $res;
                $post_to_db[$key]   = $res;

                $val = 'CONTINUE_ON';
            }


            // check validation
            if (array_key_exists($key, $this->fields) && array_key_exists('validation', $this->fields[$key])){
                //$this->output .= $key.' to validate <br>';
                $validation = true;
                $this->ci->form_validation->set_rules($key, $key, $this->fields[$key]['validation']);
            }

            if($val == 'CONTINUE_ON'){
                continue;
            }
            if (is_array($val)) {
                $post_to_db[$key] = implode(",", $val);
            } else {
                $post_to_db[$key] = $val;
            }


        }

        //print_r($_POST);

        // check validation
       if ($validation AND $this->ci->form_validation->run() === FALSE) {
            $this->output .= validation_errors();
            $this->show_form_after_submit = true;
            //$this->render();
            return 0;
        }

        if (array_key_exists('id', $post_to_db)) {
            $upd = array();
            foreach($post_to_db as $k => $v){
                array_push($upd,"`$k` = '$v'");
            }
            $str = $this->ci->db->insert_string($this->table, $post_to_db)." ON DUPLICATE KEY UPDATE ".implode(',',$upd);
            $post_to_db['_action'] = 'edit';
        } else {
            $str = $this->ci->db->insert_string($this->table, $post_to_db);
            $post_to_db['_action'] = 'insert';
        }
        //$this->output .= $str;
        log_message('DEBUG','Post string '.$str);

        if($this->process){
         
            if (!$upload_err && $this->ci->db->simple_query($str)) {
                $this->output .= '<div class="alert alert-success alert-dismissible col-md-6 col-sm-12"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Success !</span></div>';
                $this->insert_id = $this->ci->db->insert_id();
                return $post_to_db;
            } else {
                echo $str;
                $this->output .= '<div class="alert alert-danger alert-dismissible  col-md-6 col-sm-12"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Oh snap!</span> Failed, Please try again later</div>';

                    log_message("DEBUG","Query failed! " . $str . " " . $upload_err);
                return 0;
            }
            
        }else{
            return $post_to_db;
        }


    }

    private function _render_delete(){


        $CI     = $this->ci;
        $id = ( $CI->input->post('id') ? $CI->input->post('id') : $CI->input->get('id') );
        
       // $res    = $CI->db->where('id',$id)->get($this->table)->result_array()[0];
        $CI->model->set_table($this->table);
        $res = $CI->model->as_array()->get($id);
        $sql = "Delete from $this->table where id = '".$id."'";
             
        if ($CI->db->simple_query ( $sql )) {
            $this->output .= "Delete Success!";
            $res['_action'] = 'delete';
            return $res;
        } else {
            $this->output .= "Delete failed!";
            return 0;
        }
    }
    private function _render_edit()
    {

        $CI = $this->ci;

        $hidden = array();


        $id = ( $CI->input->post('id') ? $CI->input->post('id') : $CI->input->get('id') );
        
        if (!empty($id)) {
            $this->set_pri_id($id);
            $hidden['id'] = $id;
        }

        $vals = '';
        if ($this->pri_id) {

            // get values
            $hidden['id'] = $this->pri_id;
            $query = $CI->db->get_where($this->table, array(
                'id' => $this->pri_id
            ));
            $vals = $query->row_array();
        }

        $q = 'describe ' . $this->table;


        //echo '<pre>'; print_r($this->fields); exit();
        $query = $CI->db->query($q);
        $t_array = array(); $form_array = array();
        foreach($query->result_array() as $key => $val1){
            $fn = $val1['Field'];
            $t_array[$fn]['array']  = (array) $val1;
            $t_array[$fn]['index']  = $key;
            array_push($form_array,(array)$val1);
        }

        //echo '<pre>'; print_r($form_array); exit();

        $uri = $this->form_action;
        $attributes = $this->form_attributes;
        if (empty($attributes)) $attributes = '';

        $hidden += $this->form_hidden;

        $this->output .= form_open_multipart($uri, $attributes, $hidden);
        $this->output .= '<div class="db_exp_table col-md-8 col-12">';

        foreach($this->fields as $name => $val){

            if(substr($name,0,5) == 'html_'){
                $this->output   .= $val;
            }elseif(!array_key_exists($name,$t_array)){
                continue; // maybe json variable
            }else{
                $val    = $this->_get_val($vals,$name);

                $row    = $t_array[$name]['array'];
                $index  = $t_array[$name]['index'];
                $this->_edit_field($row,$val,$this->output);

                // remove item from form array
                unset($form_array[$index]);
            }
        }

        foreach ($form_array as $row) {

            $fn = $row ['Field'];

            //$this->output .= '<pre>';print_r($this->fields);
            //print_r($vals);
            $val    = $this->_get_val($vals,$fn);

            //$this->output .= $fn; print_r($val); $this->output .= "\n";

            $this->_edit_field($row, $val,$this->output);

        }

        if ($this->show_submit_button) {

            $submit = array('name' => 'submit', 'type' => 'submit', 'class' => "dbx_submit btn btn-primary legitRipple mb-2");
            $this->output .= '<div>' . form_button($submit,'Insert<i class="icon-paperplane ml-2"></i>') . '</div>';

        }

        $this->output .= '</div>';
        $this->output .= form_close();
    }

    private function _get_val($vals, $fn){

        if (is_array($vals) && array_key_exists($fn, $vals)) {

            // check if its a multiselct field
            if (array_key_exists($fn, $this->fields) && array_key_exists('list', $this->fields[$fn])) {
                if (trim($vals[$fn]) != '') {
                    $val = explode(",", $vals [$fn]);
                } else {
                    $val = array();
                }
            } else {
                $val = $vals [$fn];
            }


        } else {
            $val = '';
        }

        return $val;
    }

    private function _edit_field($field, $value, &$obj)
    {
        

        $type   = array_key_exists('Type',$field) ? $field['Type'] : $field['type'];
        $name   = array_key_exists('Field',$field) ? $field ['Field'] : $field['name'];
        $key    = array_key_exists('Key',$field) ? $field ['Key'] : $field['primary_key'];
        $label  = array_key_exists('label',$field) ? $field ['label'] : ucfirst(str_replace("_", " ", str_ireplace("_id", "", $name)));

        //$label = ucfirst(str_replace("_", " ", str_ireplace("_id", "", $name)));

        // check if its primary key
        //if ($field ['Key'] === 'PRI' && $value == '') {
        if ($key === 'PRI') {
            $this->set_validation('id','required');
            
            return;
        }

        $data = array();
        $data['name'] = $name;
        $data['id'] = $name;
        $data['class'] = 'validate form-control ';
        // set maxlength attribute
        if($maxlength = $this->_get_maxlength($type)) $data['maxlength'] = $maxlength;

        // check validation
        if(array_key_exists($name,$this->fields) && array_key_exists('validation',$this->fields[$name])){
            // explode validation
            //echo $this->fields[$name]['validation'];
            $tmp    = explode('|',$this->fields[$name]['validation']);
            foreach($tmp as $v1){
                $v1 = trim($v1);
                if(substr($v1,0,10) == 'max_length'){
                    $datalength = substr($v1,11,-1);
                    $data['data-length']    = $datalength;
                    $data['class']  .= ' data-length ';
                }
            }
        };

        // check css class
        $wrp_class  = '';
        if(array_key_exists($name,$this->fields) && array_key_exists('wrp_class',$this->fields[$name])){

            $wrp_class  = $this->fields[$name]['wrp_class'];
        }

        $options = false;

        if (array_key_exists($name, $this->fields)) {

            foreach ($this->fields[$name] as $key => $val) {

                switch ($key) {
                    case 'label':
                        //$type	= 'label';
                        $label = $val;
                        break;
                    case 'db_select':
                        $type = 'db_select';
                        $options = $val;
                        break;
                    case 'select':
                        $type = 'select';
                        $options = $val;
                        break;
                    case 'upload':
                        $type = 'upload';
                        $options = $val;
                        break;
                    case 'json':
                        //$this->output .= $value;
                        $type = 'json';
                        $json_data = json_decode($value, true);
                        $json_keys = $this->fields[$name]['json'];
                        //print_r($json_keys);
                        foreach ($json_keys as $fk) {

                            $fn = array('Field' => $fk, 'Type' => '', 'Key' => '');
                            $fv = '';
                            if (is_array($json_data) && array_key_exists($fk, $json_data)) $fv = $json_data[$fk];
                            $this->_edit_field($fn, $fv,$obj);
                        }
                        break;
                    case 'multiselect':
                        $type = 'multiselect';
                        $options = $val;
                        break;
                    case 'list':
                        $type = 'list';
                        $options = $val;
                        break;
                    case 'textarea':
                        $type = 'textarea';
                        break;
                    case 'password':
                        $type = 'password';
                        break;
                    case 'password_dblcheck':
                        $type = 'password_dblcheck';
                        break;
                    case 'hidden':
                        $type = 'hidden';
                        if ($val != '') $value = $val;
                        break;
                    case 'date':
                        $type = 'date';
                        //$data['data-inputmask'] = "'mask': '99/99/9999'";
                        break;
                    case 'time':
                        $type = 'time';
                        break;
                    case 'view';
                        $type = 'view';
                        break;
                    case 'formula':
                        $type = 'formula';
                        break;
                    case 'service':
                        $type = 'service';
                        break;
                }

                //$data['class'] = ' db_exp_' . $type;
            }
        }
        // print_r ( $field );

        $label_class    = '';
        if(!is_array($value)){
            if($value != '') $label_class = 'active';
        }
        $pre = '<div class="form-group '.$wrp_class.' col"><label>'.$label.'</label>';
        $end =  '</div>';

        switch ($type) {


            case 'int' :
                $obj .= $pre . form_input($data, $value) . $end;
                break;
            case 'upload':
                //print_r($data);$this->output .= 'upload';
                if(!empty($value)){
                    $replace = '<span class="db_exp_replace_upload_str"> Replace '.$value.'</span>';
                }else{
                    $replace = '';
                }
                $obj .= $pre . form_upload($data,$value) .$replace. $end;
                $obj .= form_hidden($name.'_orig', $value);
                break;
            case 'password' :
                $obj .= $pre . form_password($data, $value) . $end;
                break;
            case 'password_dblcheck' :
                $obj .= $pre . form_password($data, $value) . $end;
                $data['name'] = $data['name'] . '_repeat';
                $pre = '<div class="element">Repeat ' . $label . '</div>';
                $obj .= $pre . form_password($data, $value) . $end;
                break;
            case 'textarea':
                $data['cols'] = 80;
                $data['rows'] = 4;
                $data['class'] .= " materialize-textarea ";
                $obj .= $pre . form_textarea($data, $value) . $end;
                //$this->output .= '<script> CKEDITOR.replace('.$data['id'].')</script>';
                break;
            case 'date':
                $data['type']   = 'text';
                $data['class']  .= ' pickadate ';
                $obj .= $pre. form_input($data,$value) . $end;
                break;
            case 'time':
                $data['type']   = 'text';
                $data['class']  .= ' pickatime ';
                $obj .= $pre. form_input($data,$value) . $end;
                break;
            case 'db_select':
            case 'select':
                $obj .= $pre.'<div class="multiselect-native-select"><select class="form-control multiselect" ';
                foreach($data as $k1 => $v1){
                    $obj .= $k1.'="'.$v1.'"';
                }
                $obj .= '>';
                foreach($options as $k1 => $v1){
                    $selected   = (($k1 == $value) ? 'selected' : '');
                    $obj .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $obj .= '</select></div>'.$end;
                break;
            case 'list':
                $data['name'] = $name . '[]';
                $obj .= $pre.'<select class="form-control duallistbox" multiple="multiple" ';
                //foreach($data as $k1 => $v1){
                //    $this->output .= $k1.'="'.$v1.'" ';
                //}
                
                $obj .= ' data-fouc>';
                $saved_value    = is_array($value) ? implode(",",$value) : '';
                foreach($options as $k1 => $v1){
                    $selected   = ((is_array($saved_value) && in_array($k1,$saved_value)) ? 'selected' : '');
                    $obj .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $obj .= '</select>'.$end;
                break;
            case 'multiselect':
                $data['name'] = $name . '[]';
                $obj .= $pre.'<div class="multiselect-native-select"><select class="form-control multiselect" multiple="multiple" ';
                foreach($data as $k1 => $v1){
                    $obj .= $k1.'="'.$v1.'" ';
                }
                
                $obj .= '>';
                $saved_value    = is_array($value) ? implode(",",$value) : '';
                foreach($options as $k1 => $v1){
                    $selected   = ((is_array($saved_value) && in_array($k1,$saved_value)) ? 'selected' : '');
                    $obj .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $obj .= '</select></div>'.$end;
                break;
            case 'json':
            case 'hidden':
                $obj .= form_hidden($name, $value);
                break;
            case 'view':
                if (array_key_exists('hidden', $this->fields[$name])) {
                    $obj .= form_hidden($name, $value);
                } else {
                    $s = '';

                    if (is_array($options)) {
                        if (is_array($value)) {
                            $v = $value;
                        } else {
                            $v = explode(',', $value);
                        }

                        foreach ($v as $kk) {
                            if($kk == '') $s .= '';
                            else $s .= $options[trim($kk)] . ',';
                        }
                    } else {
                        $s = $value;
                    }
                    //$this->output .= $pre_view . $s . $end;
                    $obj .= $pre.'<input disabled value="'.$s.'" id="'.$name.'" type="text" class="form-control validate">'.$end;
                }
                break;
            case 'formula':
                $obj .= $pre . $value . $end;
                break;
            case 'service':
                //$this->output .= $pre . $value . $end;
                $obj .= $pre.'<input disabled value="'.$value.'" id="'.$name.'" type="text" class="form-control validate">'.$end;
                break;
            default :
                $data['placeholder']    = $value;
                $obj .= $pre . form_input($data,$value) . $end;
                break;
        }
    }

    private function _edit_field2($field, $value)
    {
        

        $type = $field ['Type'];
        $name = $field ['Field'];

        $label = ucfirst(str_replace("_", " ", str_ireplace("_id", "", $name)));

        // check if its primary key
        //if ($field ['Key'] === 'PRI' && $value == '') {
        if ($field ['Key'] === 'PRI') {
            $this->set_validation('id','required');
            
            return;
        }

        $data = array();
        $data['name'] = $name;
        $data['id'] = $name;
        $data['class'] = 'validate form-control ';
        // set maxlength attribute
        if($maxlength = $this->_get_maxlength($type)) $data['maxlength'] = $maxlength;

        // check validation
        if(array_key_exists($name,$this->fields) && array_key_exists('validation',$this->fields[$name])){
            // explode validation
            //echo $this->fields[$name]['validation'];
            $tmp    = explode('|',$this->fields[$name]['validation']);
            foreach($tmp as $v1){
                $v1 = trim($v1);
                if(substr($v1,0,10) == 'max_length'){
                    $datalength = substr($v1,11,-1);
                    $data['data-length']    = $datalength;
                    $data['class']  .= ' data-length ';
                }
            }
        };

        // check css class
        $wrp_class  = '';
        if(array_key_exists($name,$this->fields) && array_key_exists('wrp_class',$this->fields[$name])){

            $wrp_class  = $this->fields[$name]['wrp_class'];
        }

        $options = false;

        if (array_key_exists($name, $this->fields)) {

            foreach ($this->fields[$name] as $key => $val) {

                switch ($key) {
                    case 'label':
                        //$type	= 'label';
                        $label = $val;
                        break;
                    case 'db_select':
                        $type = 'db_select';
                        $options = $val;
                        break;
                    case 'select':
                        $type = 'select';
                        $options = $val;
                        break;
                    case 'upload':
                        $type = 'upload';
                        $options = $val;
                        break;
                    case 'json':
                        //$this->output .= $value;
                        $type = 'json';
                        $json_data = json_decode($value, true);
                        $json_keys = $this->fields[$name]['json'];
                        //print_r($json_keys);
                        foreach ($json_keys as $fk) {

                            $fn = array('Field' => $fk, 'Type' => '', 'Key' => '');
                            $fv = '';
                            if (is_array($json_data) && array_key_exists($fk, $json_data)) $fv = $json_data[$fk];
                            $this->_edit_field($fn, $fv);
                        }
                        break;
                    case 'multiselect':
                        $type = 'multiselect';
                        $options = $val;
                        break;
                    case 'list':
                        $type = 'list';
                        $options = $val;
                        break;
                    case 'textarea':
                        $type = 'textarea';
                        break;
                    case 'password':
                        $type = 'password';
                        break;
                    case 'password_dblcheck':
                        $type = 'password_dblcheck';
                        break;
                    case 'hidden':
                        $type = 'hidden';
                        if ($val != '') $value = $val;
                        break;
                    case 'date':
                        $type = 'date';
                        //$data['data-inputmask'] = "'mask': '99/99/9999'";
                        break;
                    case 'time':
                        $type = 'time';
                        break;
                    case 'view';
                        $type = 'view';
                        break;
                    case 'formula':
                        $type = 'formula';
                        break;
                    case 'service':
                        $type = 'service';
                        break;
                }

                //$data['class'] = ' db_exp_' . $type;
            }
        }
        // print_r ( $field );

        $label_class    = '';
        if(!is_array($value)){
            if($value != '') $label_class = 'active';
        }
        $pre = '<div class="form-group '.$wrp_class.' col"><label>'.$label.'</label>';
        $end =  '</div>';

        switch ($type) {


            case 'int' :
                $this->output .= $pre . form_input($data, $value) . $end;
                break;
            case 'upload':
                //print_r($data);$this->output .= 'upload';
                if(!empty($value)){
                    $replace = '<span class="db_exp_replace_upload_str"> Replace '.$value.'</span>';
                }else{
                    $replace = '';
                }
                $this->output .= $pre . form_upload($data,$value) .$replace. $end;
                $this->output .= form_hidden($name.'_orig', $value);
                break;
            case 'password' :
                $this->output .= $pre . form_password($data, $value) . $end;
                break;
            case 'password_dblcheck' :
                $this->output .= $pre . form_password($data, $value) . $end;
                $data['name'] = $data['name'] . '_repeat';
                $pre = '<div class="element">Repeat ' . $label . '</div>';
                $this->output .= $pre . form_password($data, $value) . $end;
                break;
            case 'textarea':
                $data['cols'] = 80;
                $data['rows'] = 4;
                $data['class'] .= " materialize-textarea ";
                $this->output .= $pre . form_textarea($data, $value) . $end;
                //$this->output .= '<script> CKEDITOR.replace('.$data['id'].')</script>';
                break;
            case 'date':
                $data['type']   = 'text';
                $data['class']  .= ' pickadate ';
                $this->output .= $pre. form_input($data,$value) . $end;
                break;
            case 'time':
                $data['type']   = 'text';
                $data['class']  .= ' pickatime ';
                $this->output .= $pre. form_input($data,$value) . $end;
                break;
            case 'db_select':
            case 'select':
                $this->output .= $pre.'<div class="multiselect-native-select"><select class="form-control multiselect" ';
                foreach($data as $k1 => $v1){
                    $this->output .= $k1.'="'.$v1.'"';
                }
                $this->output .= '>';
                foreach($options as $k1 => $v1){
                    $selected   = (($k1 == $value) ? 'selected' : '');
                    $this->output .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $this->output .= '</select></div>'.$end;
                break;
            case 'list':
                $data['name'] = $name . '[]';
                $this->output .= $pre.'<select class="form-control duallistbox" multiple="multiple" ';
                //foreach($data as $k1 => $v1){
                //    $this->output .= $k1.'="'.$v1.'" ';
                //}
                
                $this->output .= ' data-fouc>';
                $saved_value    = is_array($value) ? implode(",",$value) : '';
                foreach($options as $k1 => $v1){
                    $selected   = ((is_array($saved_value) && in_array($k1,$saved_value)) ? 'selected' : '');
                    $this->output .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $this->output .= '</select>'.$end;
                break;
            case 'multiselect':
                $data['name'] = $name . '[]';
                $this->output .= $pre.'<div class="multiselect-native-select"><select class="form-control multiselect" multiple="multiple" ';
                foreach($data as $k1 => $v1){
                    $this->output .= $k1.'="'.$v1.'" ';
                }
                
                $this->output .= '>';
                $saved_value    = is_array($value) ? implode(",",$value) : '';
                foreach($options as $k1 => $v1){
                    $selected   = ((is_array($saved_value) && in_array($k1,$saved_value)) ? 'selected' : '');
                    $this->output .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $this->output .= '</select></div>'.$end;
                break;
            case 'json':
            case 'hidden':
                $this->output .= form_hidden($name, $value);
                break;
            case 'view':
                if (array_key_exists('hidden', $this->fields[$name])) {
                    $this->output .= form_hidden($name, $value);
                } else {
                    $s = '';

                    if (is_array($options)) {
                        if (is_array($value)) {
                            $v = $value;
                        } else {
                            $v = explode(',', $value);
                        }

                        foreach ($v as $kk) {
                            if($kk == '') $s .= '';
                            else $s .= $options[trim($kk)] . ',';
                        }
                    } else {
                        $s = $value;
                    }
                    //$this->output .= $pre_view . $s . $end;
                    $this->output .= $pre.'<input disabled value="'.$s.'" id="'.$name.'" type="text" class="form-control validate">'.$end;
                }
                break;
            case 'formula':
                $this->output .= $pre . $value . $end;
                break;
            case 'service':
                //$this->output .= $pre . $value . $end;
                $this->output .= $pre.'<input disabled value="'.$value.'" id="'.$name.'" type="text" class="form-control validate">'.$end;
                break;
            default :
                $data['placeholder']    = $value;
                $this->output .= $pre . form_input($data,$value) . $end;
                break;
        }
    }

    private function _listo_header(){

        $list =  '<div class="d-flex flex-row-reverse bd-highlight mb-3">';
        $list .= '<div class="border mx-1 clearfix px-3 py-2">
                    <div class="material-icons mr-1 float-left" style="padding-top: 1px">format_align_justify</div> 
                    <div class="float-left">List</div>
                </div>';
        $list .= '<div class="border mx-1 clearfix px-3 py-2">
                    <div class="material-icons mr-1 float-left" style="padding-top: 1px">post_add</div> 
                    <div class="float-left">Insert</div>
                </div>';
        $list .= '<div class="border mx-1 clearfix px-3 py-2">
                    <div class="material-icons mr-1 float-left" style="padding-top: 1px">check_box_outline_blank</div> 
                    <div class="float-left">Toggle</div>
                </div>';
        $list .= '<div class="border mx-1 clearfix px-3 py-2">
                    <div class="material-icons mr-1 float-left style="padding-top: 2px"">search</div> 
                    <div class="float-left">Adv Search</div>
                </div>';
        $list .= '<div class="border mx-1 clearfix px-2 py-2">
                    <div class="material-icons mr-1 float-left style="padding-top: 2px"">filter_list</div> 
                    <input type="text" class="border-0 bg-light float-left" />
                </div>';
        $list .= '</div/>';

        $modal = '<!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group  col">
                    <label>Hotel</label>
                    <input value="Holiday Inn" id="hotel" type="text" class="form-control validate">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>';

        return $modal;

        //return $list;

    }

    private function _listo_eip($meta_data){

        $adv_search     = '';
        $edit_in_place  = '';

        //print_r($meta_data);
        foreach($meta_data as $field){

            $name   = $field['name'];
            if(array_key_exists($name,$this->fields) && array_key_exists('eip',$this->fields[$name])){
                $this->_edit_field($field,'',$edit_in_place);
            }
            $this->_edit_field($field,'',$adv_search);
        }


        $adv_s = '<!-- Modal -->
        <div class="modal fade" id="adv_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="adv_search_title">Advanced Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                '.form_open_multipart($this->form_action).'
                '.$adv_search.'
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Search</button>
              </div>
            </div>
          </div>
        </div>';

        $eip = '<!-- Modal -->
        <div class="modal fade" id="eip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <form name="eip_form" id="eip_form">
              <div class="modal-header">
                <h5 class="modal-title" id="eip_title">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                '.$edit_in_place.'
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_eip">Save changes</button>
                <input type="hidden"  name="i" id="ele_id" value="">
                <input type="hidden"  name="t" value="'.base64_encode($this->table).'">
              </div>
              </form>
            </div>
          </div>
        </div>';

        return $eip.$adv_s;

    }

    private function _render_listo(){

        $CI             = &get_instance();
        //$uri = uri_string().'?'.$_SERVER['QUERY_STRING'];


        $fields         = $CI->db->list_fields($this->table);
        $show           = array();
        $edit_in_place  = array();
        
        //print_r($this->fields);

        foreach ($fields as $field) {
            if (array_key_exists($field, $this->fields) && is_array($this->fields[$field]) && array_key_exists('hidden', $this->fields[$field])) {

            } else {
                array_push($show, $field);
            }
        }

        log_message('DEBUG',json_encode($edit_in_place));
        if (sizeof($show) != 0) {
            $CI->db->select(implode(",", $show));
        }

        if ($this->search_condition) {
            // get values
            $query = $CI->db->get_where($this->table, $this->search_condition);
        } else {
            $query = $CI->db->get($this->table);
        }
        
        $this->output   = '<div class="table-responsive"><table class="table table-bordered1 table-striped dbx_table compact stripe" action="'.$this->form_action.'" t="'.base64_encode($this->table).'">';

        // set the header
        
        $meta_data      = array(); // storing modal data
        $this->output   .= '<thead><tr class="">';
        $this->output   .= '<th>#</th><th><span class="material-icons">settings_applications</span></th>';
        foreach ($query->field_data() as $d_field){

            $field      = $d_field->name;

            if(array_key_exists($field,$this->fields) && array_key_exists('label',$this->fields[$field])){
                $field = $this->fields[$field]['label'];
            }

            if ($field === 'id') continue;

            $label = ucfirst(str_replace("_", " ", str_ireplace("_id", "", $field)));

            $d_field            =(array) $d_field;
            $d_field['label']   = $label;
            array_push($meta_data, $d_field);

            $this->output   .= '<th>'.$label.'</th>';
        }
        $this->output   .= '</tr></thead>';


        //echo '<pre>'; print_r($meta_data); echo '</pre>';

        $this->output   .= '<tbody>';


        // set the body
        foreach ($query->result_array() as $row) {

            $this->output   .=  '<tr row_id="'.$row['id'].'"><td>'.$row['id'].'</td>';
         
            $this->output   .= '<td><li class="dropdown">
            <span href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label material-icons">dehaze</span> <span class="caret"></span></span>
                <ul class="dropdown-menu">';
               
            foreach($this->arg_link as $link){
                
                $this->output   .= '<li><span class="dbx_arg_link"  target="'.$link['target'].'" action="'.$link['action'].'" arg="'.http_build_query($row).'" ><i class="'.$link['icon'].'"> '.$link['title'].'</i></span></li>';
            }

            $this->output   .= '<li><span class="dbx_act_link"  act="view" id="'.$row['id'].'"><i class="icon-file-eye"> View</i></span></li>';

            if($this->show_edit_button){
                $this->output   .= '<li><span class="dbx_act_link"  act="edit" id="'.$row['id'].'"><i class="icon-file-text"> Edit</i></span></li>';
            }
            if($this->show_delete_button){
                $this->output   .= '<li><span class="dbx_act_link" act="delete" id="'.$row['id'].'"><i class="icon-trash"> Delete</i></span></li>';
            }
            $this->output   .=  '</ul></li></td>';

            foreach ($row as $key => $val) {

                if ($key === 'id') continue;
                
                $wrp_class  = ''; $eip = '';
                if(array_key_exists($key,$this->fields) && array_key_exists('wrp_class',$this->fields[$key])){
                    $wrp_class  = $this->fields[$key]['wrp_class'];
                }
                if(array_key_exists($key,$this->fields) && array_key_exists('eip',$this->fields[$key])){
                    $eip        =  ' data-toggle="modal" data-target="#eip" ';
                    $wrp_class  .= " eip ";
                }

                
                $this->output   .= '<td id="'.$key.'_'.$row['id'].'" fld="'.$key.'" class="'.$wrp_class.'"  '.$eip.'>'.$this->display_field($key, $val).'</td>';

            }
            $this->output   .= '</tr>';

        }
        $this->output   .= '</tbody></table></div>';

        
        $this->output   .= $this->_listo_eip($meta_data);

        if($this->show_insert_button){

            //$this->output   .= '<span class="dbx_insert" action="'.site_url($uri).'&action=insert"><i class="material-icons right">send</i> Insert</span>';
            $this->output   .= '<button type="submit" class="dbx_insert mt-2 btn btn-primary legitRipple" action="'.site_url($this->form_action).'&action=insert">Insert <i class="material-icons ml-2">keyboard_arrow_right</i></button>';


        }

    }

    private function table_field_checkbox_dropdown(){
/*
        <div class="btn-group ">
        <div class="border dropdown-toggle py-2 px-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Fields
        </div>
        <div class="dropdown-menu" style="width:500px;">
            <div class="row p-2">
                <?php for($i = 0; $i < 20; $i++){?>
                    <div class="col-md-4 py-1">
                        <label> Check <input type="checkbox" class="ml-2" value="" id="defaultCheck<?php echo $i; ?>"></label>
                    </div>
                <?php } ?>
            </div>
        </div>
*/
    }

    private function _render_list_col()
    {
        $CI = &get_instance();

        $fields = $CI->db->list_fields($this->table);
        $show = array();
        foreach ($fields as $field) {
            if (array_key_exists($field, $this->fields) && is_array($this->fields[$field]) && array_key_exists('hidden', $this->fields[$field])) {

            } else {
                array_push($show, $field);
            }
        }
        if (sizeof($show) != 0) {
            $CI->db->select(implode(",", $show));
        }

        if ($this->search_condition) {
            // get values
            $query = $CI->db->get_where($this->table, $this->search_condition);
        } else {
            $query = $CI->db->get($this->table);
        }


        $this->output .= '<table width="100%" cellpadding="2" cellspacing="2">';
        foreach ($query->result_array() as $row) {
            //print_r($row);
            $this->output .= '<tr class="perm_list">';

            foreach ($this->actions['link'] as $v1) {

                $opts = '';
                $link_label = false;
                foreach ($v1 as $opt_key => $opt_val) {

                    switch ($opt_key) {

                        case 'args':
                            $arguments = explode(",", $opt_val);
                            $tmp = array();
                            foreach ($arguments as $v2) {
                                if (array_key_exists($v2, $row)) {
                                    array_push($tmp, $v2 . "=" . $row[$v2]);
                                }
                            }
                            $opts .= ' args="' . implode("&", $tmp) . '"';
                            break;
                        case 'target':
                            $opts .= ' target="' . $opt_val . '"';
                            break;
                        case 'action':
                            $opts .= ' action ="' . site_url($opt_val) . '"';
                            break;
                        case 'label':
                            $link_label = $opt_val;
                            break;

                    }

                }

                if ($link_label) {
                    $this->output .= '<td class="perm_list_link" ' . $opts . '>' . $link_label . '</td>';
                }
            }


            $this->output .= '<td class="perm_list_link" action="' . site_url('perm/delete_row') . '" args="table=' . $this->table . '&id=' . $row['id'] . '">Delete</td>';

            foreach ($row as $key => $val) {

                $label = ucfirst(str_replace("_", " ", str_ireplace("_id", "", $key)));

                if ($key === 'id') continue;
                //$this->output .= '<td>' . $label . '</td>';
                $this->output .= '<td> | </td>';
                $this->output .= '<td>' . $val . '</td>';

            }


            $this->output .= '</tr>';
        }
        $this->output .= '</table>';
    }

    private function _get_maxlength($type){

        $ln     = false;
        if($st  = strpos($type,"(")){
            $st++;
            $en = strpos($type,")") - $st;
            $ln = substr($type,$st,$en);
        }

        return $ln;
    }


    private function display_field($key, $val)
    {

        if (array_key_exists($key, $this->fields)) {

            $tmp = $this->fields[$key];
            //print_r($tmp);
            //print_r($val);
            foreach ($tmp as $k => $v) {
                //print_r($tmp); echo 'done';
                if ($k == 'db_select' || $k == 'db_multiselect' || $k == 'select' || $k == 'multiselect') {
                    $options = $this->fields[$key][$k];
                    $tt      = array_flip(explode(',',$val));
                    $val     = implode(",",array_intersect_key($options,$tt));
                    //print_r($val);
                    //$val = $options[$val];
                    break;
                }

                if ($k == 'password') {
                    $val = '*************';
                    break;
                }
            }

        }

        return $val;
    }

    public function _set_readonly()
    {

        $this->show_submit_button = false;
        $this->show_insert_button = false;
        $this->show_delete_button = false;
        $this->show_edit_button   = false;

        $CI = &get_instance();

        $q = 'describe ' . $this->table;
        $query = $CI->db->query($q);

        foreach ($query->result_array() as $row) {

            $fn = $row ['Field'];
            if (array_key_exists($fn, $this->fields)) {
                $this->fields[$fn]['view'] = true;
            } else {
                $this->fields[$fn] = array('view' => true);
            }
        }
    }


    public function explode_table($fields) {

        if (! sizeof($fields)) {
            log_message ( 'debug', 'in db_table_render: table has no configs' );
            return;
        }

        foreach ( $fields as $field ) {

            parse_str ( $field ['field_value'], $args );

            $validation = $field['validation'];
            if($validation != ''){
                $this->set_validation($field['field_name'],$validation);
            }

            switch ($field ['field_property']) {

                case 'date' :
                    $this->set_date ( $field ['field_name'] );
                    break;
                case 'time' :
                    $this->set_time ( $field ['field_name'] );
                    break;
                case 'CI db_func' :
                    $func_name = $args ['name'];
                    if ($func_name == 'list_tables') {
                        $options = $this->db->list_tables ();
                        $this->set_multiselect ( $field ['field_name'], $options,TRUE );
                    }
                    if ($func_name == 'select_tables') {
                        $options = $this->db->list_tables ();
                        $this->set_select ( $field ['field_name'], $options, TRUE );
                    }

                    break;
                case 'password' :
                    $this->set_password ( $field ['field_name'] );
                    break;
                case 'password_dblcheck' :
                    $this->set_password_dblcheck ( $field ['field_name'] );
                    break;
                case 'label' :
                    $this->set_label( $field ['field_name'], $field ['field_value']);
                    break;
                case 'view' :
                    $this->set_readonly( $field ['field_name']);
                    break;
                case 'upload' :
                    $this->set_upload( $field ['field_name']);
                    break;
                case 'dropdown' :
                    $options = explode ( ",", $field ['field_value'] );
                    $this->set_select ( $field ['field_name'], $options, true );
                    break;
                case 'db_dropdown' :
                    $options = explode ( ":", $field ['field_value'] );
                    $cond = false;
                    if (array_key_exists ( 3, $options ))
                        $cond = $options [3];
                    $this->set_db_select ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                    break;
                case 'q_dropdown' :
                    $q      = $field ['field_value'];
                    $s      = $this->db->query($q);
                    $o      = array();
                    foreach ($s->result_array() as $row){
                        $k7 = $row[0];
                        $v7 = $row[1];
                        $o[$k7]    = $v7;
                    }
                    $this->set_select ( $field ['field_name'], $o );
                    break;
                case 'multiselect':
                    $options = explode ( ",", $field ['field_value'] );
                    $this->set_multiselect ( $field ['field_name'], $options, true );
                    break;
                case 'db_multiselect':
                    $options = explode ( ":", $field ['field_value'] );
                    $cond = array_key_exists ( 3, $options ) ? $options [3] : false;
                    $this->set_db_multiselect ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                    break;
                case 'list':
                    $options = explode ( ",", $field ['field_value'] );
                    $this->set_list ( $field ['field_name'], $options, true );
                    break;
                case 'db_list':
                    $options = explode ( ":", $field ['field_value'] );
                    $cond = array_key_exists ( 3, $options ) ? $options [3] : false;
                    $this->set_db_list ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                    break;
                case 'textarea' :
                    $this->set_textarea ( $field ['field_name'], $field ['field_value'] );
                    break;

                case 'hidden' :
                    log_message('debug', 'in hidden '.$field ['field_property']);
                    $value = $field ['field_value'];
                    if(substr($value,0,2) == "##"){
                        // session value
                        $value			= $this->ci->session->userdata(substr($value,2));
                    }
                    if(substr($value,0,2) == "__"){
                        // class variable
                        $value			= $this->{substr($value,2)};
                    }
                    $this->set_hidden ( $field ['field_name'], $value );
                    break;
                case 'formula' :
                    $this->set_formula ( $field ['field_name'], $field ['field_value'] );
                    break;
                case 'service' :
                    $this->set_service ( $field ['field_name'], $field ['field_value'] );
                    break;
                case 'Perm':
                    $available_perms = $this->ci->Perm_model->get_all_perms ();
                    $this->set_list ( $field ['field_name'], $available_perms );
                    break;
            }
        }
    }
}
