<?php
class ControllerExtensionModuleDVisualDesigner extends Controller {

    private $codename = 'd_visual_designer';

    private $route = 'extension/module/d_visual_designer';
    
    private $theme = 'default';

    private $error = array();

    private $store_url = '';
    
    public function __construct($registry)
    {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model($this->route);
        
        $this->theme = $this->config->get('config_template');
        
        if($this->request->server['HTTPS']){
            $this->store_url = HTTPS_SERVER;
        }
        else{
            $this->store_url = HTTP_SERVER;
        }
        
    }

    public function index($setting) {

        if(!empty($setting['config'])){
            $route_info = $this->{'model_extension_module_'.$this->codename}->getRoute($setting['config']);
        }
        else{
            $route_info = array();
        }
        
        //sharrre
        $this->document->addScript('catalog/view/javascript/d_visual_designer/library/sharrre/jquery.sharrre.min.js');
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/sharrre/style.css');
        //magnific-popup
        $this->document->addScript('catalog/view/javascript/d_visual_designer/library/magnific/jquery.magnific-popup.min.js');
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/magnific/magnific-popup.css');
        //chart
        $this->document->addScript('catalog/view/javascript/d_visual_designer/library/chart/Chart.min.js');
        $this->document->addScript('catalog/view/javascript/d_visual_designer/library/pie-chart.js');
        $this->document->addScript('https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.0/circle-progress.js');
        //Carousel
        $this->document->addScript('catalog/view/javascript/d_visual_designer/library/owl-carousel/owl.carousel.min.js');
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/owl-carousel/owl.carousel.css');
        //Fonts icon
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/ionicons-1.5.2/css/ionicons.min.css');   
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/font-awesome-4.2.0/css/font-awesome.min.css');   
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/map-icons-2.1.0/css/map-icons.min.css');   
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/material-design-1.1.1/css/material-design-iconic-font.css');   
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/typicons-2.0.6/css/typicons.min.css');   
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/elusive-icons-2.0.0/css/elusive-icons.min.css');   
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/octicons-2.1.2/css/octicons.min.css');   
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/icon-fonts/weather-icons-1.2.0/css/weather-icons.min.css');   
        
        $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/owl-carousel/owl.transitions.css');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/stylesheet/d_visual_designer/animate.css')) {
            $this->document->addStyle('catalog/view/theme/' . $this->theme . '/stylesheet/d_visual_designer/animate.css');
        } else {
            $this->document->addStyle('catalog/view/theme/default/stylesheet/d_visual_designer/animate.css');
        }
        
        if($this->{'model_extension_module_'.$this->codename}->validateEdit($setting['config'])){

            if (file_exists(DIR_TEMPLATE . $this->theme . '/stylesheet/d_visual_designer/d_visual_designer.css')) {
                $this->document->addStyle('catalog/view/theme/' . $this->theme . '/stylesheet/d_visual_designer/d_visual_designer.css');
            } else {
                $this->document->addStyle('catalog/view/theme/default/stylesheet/d_visual_designer/d_visual_designer.css');
            }

            if (file_exists(DIR_TEMPLATE . $this->theme . '/javascript/d_visual_designer.js')) {
                $this->document->addScript('catalog/view/theme/' . $this->theme . '/javascript/d_visual_designer.js');
            } else {
                $this->document->addScript('catalog/view/theme/default/javascript/d_visual_designer.js');
            }

            //bootstrap-switch
            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/bootstrap-switch/bootstrap-switch.js');
            $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/bootstrap-switch/bootstrap-switch.min.css');

            //Font Icon Picker
            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/fontIconPicker/iconset.js');
            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/fontIconPicker/jquery.fonticonpicker.min.js');
            $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/fontIconPicker/jquery.fonticonpicker.css');        
            $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/fontIconPicker/jquery.fonticonpicker.grey.min.css'); 

             //bootstrap-colorpicker
            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/bootstrap-colorpicker/bootstrap-colorpicker.min.js');
            $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/bootstrap-colorpicker/bootstrap-colorpicker.min.css');

            //summernote
            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/summernote/summernote.min.js');
            $this->document->addStyle('catalog/view/javascript/d_visual_designer/library/summernote/summernote.css');

            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/jquery-ui.js');
            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/handlebars-v4.0.5.js');
            $this->document->addScript('catalog/view/javascript/d_visual_designer/library/jquery.serializejson.js');

            //button
            $data['button_add'] = $this->language->get('button_add');
            $data['button_close'] = $this->language->get('button_close');
            $data['button_save'] = $this->language->get('button_save');
            $data['button_saved'] = $this->language->get('button_saved');
            //text
            $data['text_add_block'] = $this->language->get('text_add_block');
            $data['text_edit_block'] = $this->language->get('text_edit_block');
            $data['text_add_template'] = $this->language->get('text_add_template');
            $data['text_classic_mode'] = $this->language->get('text_classic_mode');
            $data['text_backend_editor'] = $this->language->get('text_backend_editor');
            $data['text_frontend_editor'] = $this->language->get('text_frontend_editor');
            $data['text_welcome_header'] = $this->language->get('text_welcome_header');
            $data['text_add_block'] = $this->language->get('text_add_block');
            $data['text_add_text_block'] = $this->language->get('text_add_text_block');
            $data['text_add_template'] = $this->language->get('text_add_template');
            $data['text_save_template'] = $this->language->get('text_save_template');
            $data['text_search'] = $this->language->get('text_search');
            $data['text_layout'] = $this->language->get('text_layout');
            $data['entry_size'] = $this->language->get('entry_size');
            $data['text_set_custom'] = $this->language->get('text_set_custom');

            $data['text_left'] = $this->language->get('text_left');
            $data['text_right'] = $this->language->get('text_right');
            $data['text_top'] = $this->language->get('text_top');
            $data['text_bottom'] = $this->language->get('text_bottom');

            $data['text_horizontal'] = $this->language->get('text_horizontal');
            $data['text_vertical'] = $this->language->get('text_vertical');

            $data['entry_border_color'] = $this->language->get('entry_border_color');
            $data['entry_border_style'] = $this->language->get('entry_border_style');
            $data['entry_border_radius'] = $this->language->get('entry_border_radius');
            $data['entry_background'] = $this->language->get('entry_background');
            $data['entry_image'] = $this->language->get('entry_image');
            $data['entry_additional_css_class'] = $this->language->get('entry_additional_css_class');
            $data['entry_additional_css_before'] = $this->language->get('entry_additional_css_before');
            $data['entry_additional_css_content'] = $this->language->get('entry_additional_css_content');
            $data['entry_additional_css_after'] = $this->language->get('entry_additional_css_after');
            $data['entry_margin'] = $this->language->get('entry_margin');
            $data['entry_padding'] = $this->language->get('entry_padding');
            $data['entry_border'] = $this->language->get('entry_border');
            $data['entry_name'] = $this->language->get('entry_name');
            $data['entry_image_style'] = $this->language->get('entry_image_style');
            $data['entry_image_position'] = $this->language->get('entry_image_position');
            $data['entry_category'] = $this->language->get('entry_category');
            $data['entry_image_template'] = $this->language->get('entry_image_template');
            $data['entry_sort_order'] = $this->language->get('entry_sort_order');

            $data['tab_general'] = $this->language->get('tab_general');
            $data['tab_design'] = $this->language->get('tab_design');
            $data['tab_css'] = $this->language->get('tab_css');
            $data['tab_save_block'] = $this->language->get('tab_save_block');
            $data['tab_templates'] = $this->language->get('tab_templates');
            $data['tab_all_blocks'] = $this->language->get('tab_all_blocks');
            $data['tab_content_blocks'] = $this->language->get('tab_content_blocks');
            $data['tab_social_blocks'] = $this->language->get('tab_social_blocks');
            $data['tab_structure_blocks'] = $this->language->get('tab_structure_blocks');
            //error
            $data['error_size'] = $this->language->get('error_size');
            $data['designer_id'] = $this->{'model_extension_module_'.$this->codename}->getRandomString();

            $data['description'] = $setting['description'];

            $data['frontend_route'] = '';

            $data['edit_url'] = $route_info['edit_url'];
            $data['field_name'] = $setting['field_name'];

            $data['id'] = $setting['id'];

            $this->load->model('localisation/language');

            $data['languages'] = $this->model_localisation_language->getLanguages();
            foreach ($data['languages'] as $key =>  $language){
                $data['languages'][$key]['flag'] = 'catalog/language/'.$language['code'].'/'.$language['code'].'.png';
            }

            $setting_module = $this->config->get($this->codename.'_setting');
            if(!empty($setting_module)){
                $data['save_change'] = $setting_module['save_change'];
            }
            else{
                $data['save_change'] = 0;
            }
            
            $data['content'] = $setting['content'];

            $data['settings'] = $setting['setting'];

            $data['base'] = $this->store_url.'catalog/view/theme/default/';

            $data['filemanager_url'] = $this->store_url.'index.php?route=common/filemanager&token='.$this->session->data['token'].'';

            $this->load->model('tool/image');

            $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

            $data['image_horizontal_positions'] = array(
                'left' => $this->language->get('text_position_left'),
                'center' => $this->language->get('text_position_center'),
                'right' => $this->language->get('text_position_right')
                );

            $data['image_vertical_positions'] = array(
                'top' => $this->language->get('text_position_top'),
                'center' => $this->language->get('text_position_center'),
                'bottom' => $this->language->get('text_position_bottom')
                );

            $data['styles'] = array(
                'dotted' => $this->language->get('text_dotted'),
                'dashed' => $this->language->get('text_dashed'),
                'solid'  => $this->language->get('text_solid'),
                'double' => $this->language->get('text_double'),
                'groove' => $this->language->get('text_groove'),
                'ridge'  => $this->language->get('text_ridge'),
                'inset'  => $this->language->get('text_inset'),
                'outset' => $this->language->get('text_outset')
                );

            $data['image_styles'] = array(
                'cover' => $this->language->get('text_cover'),
                'contain' => $this->language->get('text_contain'),
                'no-repeat'  => $this->language->get('text_no_repeat'),
                'repeat' => $this->language->get('text_repeat')
                );

            return $this->load->view('d_visual_designer/designer', $data);
        }
        elseif($this->{'model_extension_module_'.$this->codename}->validateEdit($setting['config'], false)&&!empty($setting['id'])){

            if (file_exists(DIR_TEMPLATE . $this->theme . '/stylesheet/d_visual_designer/frontend.css')) {
                $this->document->addStyle('catalog/view/theme/' . $this->theme . '/stylesheet/d_visual_designer/frontend.css');
            } else {
                $this->document->addStyle('catalog/view/theme/default/stylesheet/d_visual_designer/frontend.css');
            }

            $frontend_url = htmlentities(urlencode($this->store_url.'index.php?route='.$route_info['frontend_route'].'&'.$route_info['frontend_param'].'='.$setting['id']));
            $edit_url = $this->store_url.'admin/index.php?route=d_visual_designer/designer/frontend&token='.$this->session->data['token'].'&url='.$frontend_url.'&route_config='.$setting['config'].'&id='.$setting['id'];

            $setting['content'] = '<div class="btn-group-xs btn-edit" ><a class="btn btn-default " href="'.$edit_url.'" target="_blank"><i class="fa fa-pencil"></i> '.$this->language->get('text_edit').'</a><br/><br/></div>'.$setting['content'];
            return $setting['content'];
        }
        else{
            if (file_exists(DIR_TEMPLATE . $this->theme . '/stylesheet/d_visual_designer/frontend.css')) {
                $this->document->addStyle('catalog/view/theme/' . $this->theme . '/stylesheet/d_visual_designer/frontend.css');
            } else {
                $this->document->addStyle('catalog/view/theme/default/stylesheet/d_visual_designer/frontend.css');
            }
            return $setting['content'];
        }
    }
    public function getSettingModule(){
        if(isset($this->request->post['type'])){
            $type = $this->request->post['type'];
        }

        $json = array();

        if(isset($type)){

            $this->load->model('tool/image');

            if(!empty($this->request->post['design_background_image'])){
                $image = $this->request->post['design_background_image'];
                if(file_exists(DIR_IMAGE.$image)){
                    $thumb = $this->model_tool_image->resize($image, 100, 100);
                }
                else{
                    $thumb = $this->model_tool_image->resize('no_image.png', 100, 100);
                }
            }
            else{
                $thumb = $this->model_tool_image->resize('no_image.png', 100, 100);
            }

            $json['design_background_thumb'] = $thumb;


            $json['content'] = $this->load->controller($this->codename.'_module/'.$type.'/setting', $this->request->post);
            $json['success'] = 'success';
        }
        else {
            $json['error'] = 'error';
        }
        $this->response->setOutput(json_encode($json));
    }

    public function getBlocks(){

        if(isset($this->request->post['level'])){
            $level = $this->request->post['level'];
        }

        $json = array();

        if(isset($level)){

            $this->load->model('tool/image');

            $results = $this->{'model_extension_module_'.$this->codename}->getBlocks();
            $json['success'] = 'success';

            $json['blocks'] = array();
            $json['categories'] = array();

            foreach ($results as $block) {

                $this->load->language($this->codename.'_module/'.$block);

                $setting = $this->{'model_extension_module_'.$this->codename}->getSettingBlock($block);

                if (is_file(DIR_IMAGE .'data/d_visual_designer/'.$block.'.svg')) {
                    $image = $this->store_url.'image/data/d_visual_designer/'.$block.'.svg';
                } else {
                    $image = $this->model_tool_image->resize('no_image.png', 40, 40);
                }
                if($setting['display']){
                    if(($level >= $setting['level_min']) && ($level <= $setting['level_max']) || ($level == '0' && $setting['level_min'] == '2')){
                        if(!empty($setting['category'])&&!in_array(ucfirst($setting['category']), $json['categories'])){
                            $json['categories'][] = ucfirst($setting['category']);
                        }
                        $json['blocks'][] = array(
                            'sort_order' => $setting['sort_order'],
                            'title' => $this->language->get('text_title'),
                            'type'	=> $block,
                            'category' => ucfirst($setting['category']),
                            'description' => $this->language->get('text_description'),
                            'image' => $image
                            );
                    }
                }

                usort($json['blocks'], 'ControllerExtensionModuleDVisualDesigner::sort_block');

            }
        }
        else{
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function sort_block($a, $b){
        if ($a['sort_order'] == $b['sort_order']) {
            return 0;
        }
        return ($a['sort_order'] < $b['sort_order']) ? -1 : 1;
    }

    public function editLayout(){

        $json = array();

        if(isset($this->request->post['setting_layout'])){
            $setting_layout = $this->request->post['setting_layout'];
        }
        else{
            $json['error'] = 'error';
        }

        if(isset($this->request->post['items'])){
            $items = $this->request->post['items'];
        }
        else{
            $json['error'] = 'error';
        }

        if(isset($this->request->post['type'])){
            $type = $this->request->post['type'];
        }
        else{
            $json['error'] = 'error';
        }

        if(isset($this->request->post['parent'])){
            $parent = $this->request->post['parent'];
        }
        else{
            $json['error'] = 'error';
        }

        if(empty($json['error'])){

            $block_data = array(
                'setting' => $setting_layout,
                'items' => $items,
                'parent' => $parent
                );

            $json['items'] = $this->load->controller('d_visual_designer_module/'.$type.'/layout',$block_data);
            $json['success'] = 'success';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function getChildBlock(){
        if(isset($this->request->post['type'])){
            $type = $this->request->post['type'];
        }
        if(isset($this->request->post['parent'])){
            $parent = $this->request->post['parent'];
        }
        if(isset($this->request->post['level'])){
            $level = $this->request->post['level'];
        }

        $json = array();

        if(isset($type)&&isset($parent)&&isset($level)){

            $setting_block = $this->{'model_extension_module_'.$this->codename}->getSettingBlock($type);

            $setting_child_block = $this->{'model_extension_module_'.$this->codename}->getSettingBlock($setting_block['child']);

            $key = $setting_block['child'].'_'.$this->{'model_extension_module_'.$this->codename}->getRandomString();

            $content = $this->{'model_extension_module_'.$this->codename}->getContent($setting_block['child'], $setting_child_block, $key, $level, 1, 1);

            $setting = $this->{'model_extension_module_'.$this->codename}->getSetting(array(), $setting_block['child']);

            $setting = array($key => array('type'=> $setting_block['child'], 'parent' => $parent, 'setting' => $setting, 'child' => true));

            $content = str_replace('{{{inner-block}}}','',$content);
            $json['content'] = $content;
            $json['type'] = $setting_block['child'];
            $json['setting'] = json_encode($setting);
            $json['success'] = 'success';
        }
        else {
            $json['error'] = 'error';
        }
        $this->response->setOutput(json_encode($json));
    }

    public function getModule(){
        if(isset($this->request->post['type'])){
            $type = $this->request->post['type'];
        }

        if(isset($this->request->post['parent'])){
            $parent = $this->request->post['parent'];
        }

        if(isset($this->request->post['level'])){
            $level = $this->request->post['level'];
        }

        if(isset($this->request->post['block_id'])){
            $block_id = $this->request->post['block_id'];
        }
        else{
            $block_id =$type.'_'. $this->{'model_extension_module_'.$this->codename}->getRandomString();
        }

        $json = array();

        if(isset($type)&isset($parent)&isset($level)){

            $setting = $this->{'model_extension_module_'.$this->codename}->getSetting(array(), $type);

            $block_info = array(
                'type' => $type,
                'parent' => $parent,
                'setting' => $setting,
                'block_id' => $block_id,
                'sort_order' => 0
                );
            $result = $this->{'model_extension_module_'.$this->codename}->getFullContent($block_info, $level);

            $json['content'] = $result['content'];
            $json['target'] = $block_id;
            $json['setting'] = json_encode($result['setting']);
            $json['success'] = 'success';
        }
        else {
            $json['error'] = 'error';
        }
        $this->response->setOutput(json_encode($json));
    }

    public function getContent(){

        if(isset($this->request->post['blocks'])){
            $blocks = $this->request->post['blocks'];
        }
        else{
            $blocks = array();
        }

        if(isset($this->request->post['main_block_id'])){
            $block_id = $this->request->post['main_block_id'];
        }
        else{
            $block_id = array();
        }

        $json = array();

        if(!empty($blocks)){
            $result = $this->{'model_extension_module_'.$this->codename}->getContentBySetting($blocks, $block_id);
            $json['content'] = $result;
            $json['success'] = 'success';
        }
        else {
            $json['error'] = 'error';
        }
        $this->response->setOutput(json_encode($json));
    }

    public function getTemplates(){
        $json = array();

        $templates = $this->model_extension_module_d_visual_designer->getTemplates();
        
        $json['templates'] = array();
        $json['categories'] = array();

        foreach ($templates as $template) {
            $this->load->model('tool/image');

            if(file_exists(DIR_IMAGE.$template['image'])){
                $thumb = $this->model_tool_image->resize($template['image'], 160, 205);
            }
            else{
                $thumb = $this->model_tool_image->resize('no_image.png', 160, 205);
            }

            if(!empty($template['category']) && !in_array(ucfirst($template['category']), $json['categories'])){
                $json['categories'][] = ucfirst($template['category']);
            }

            $json['templates'][] = array(
                'template_id' => $template['template_id'],
                'config' => $template['config'],
                'image' => $thumb,
                'category' => ucfirst($template['category']),
                'name' => html_entity_decode($template['name'], ENT_QUOTES, "UTF-8")
                );
        }

        $json['success'] = 'success';

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function getTemplate(){
        $json = array();

        if(isset($this->request->post['template_id'])){
            $template_id = $this->request->post['template_id'];
        }
        if(isset($this->request->post['config'])){
            $config = $this->request->post['config'];
        }
        if(isset($template_id)&&isset($config)){
            if(!empty($config)){
                $template_info = $this->model_extension_module_d_visual_designer->getConfigTemplate($template_id, $config);
            }
            else{
                $template_info = $this->model_extension_module_d_visual_designer->getTemplate($template_id);
            }
            

            if(!empty($template_info)){

                $result = $this->model_extension_module_d_visual_designer->parseDescriptionWithoutDesigner($template_info['content']);
                $json['content'] = $result['content'];
                $json['setting'] = $result['setting'];
                $json['text'] = $template_info['content'];
                $json['success'] = 'success';
            }
            else{
                $json['errorr'] = 'error';
            }
        }
        else{
            $json['errorr'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function saveProduct(){
        $json = array();

        if(!empty($this->request->post['product_description'])){
            $product_description = $this->request->post['product_description'];
        }

        if(!empty($this->request->get['id'])){
            $product_id = $this->request->get['id'];
        }
        
        $this->user = new Cart\User($this->registry);
        
        if (!$this->user->hasPermission('modify', 'catalog/product')) {
            $permission = false;
        }
        else{
            $permission = true;
        }

        if(isset($product_description)&&isset($product_id)&&$permission){

            $this->{'model_extension_module_'.$this->codename}->editProduct($product_id, array('product_description' => $product_description));

            $json['success'] = 'success';
        }
        else{
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function saveCategory(){
        $json = array();

        if(!empty($this->request->post['category_description'])){
            $category_description = $this->request->post['category_description'];
        }

        if(!empty($this->request->get['id'])){
            $category_id = $this->request->get['id'];
        }

        $this->user = new Cart\User($this->registry);

        if (!$this->user->hasPermission('modify', 'catalog/category')) {
            $permission = false;
        }
        else{
            $permission = true;
        }

        if(isset($category_description)&&isset($category_id)&&$permission){

            $this->{'model_extension_module_'.$this->codename}->editCaregory($category_id, array('category_description' => $category_description));

            $json['success'] = 'success';
        }
        else{
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function saveInformation(){
        $json = array();

        if(!empty($this->request->post['information_description'])){
            $information_description = $this->request->post['information_description'];
        }

        if(!empty($this->request->get['id'])){
            $information_id = $this->request->get['id'];
        }

        $this->user = new Cart\User($this->registry);

        if (!$this->user->hasPermission('modify', 'catalog/information')) {
            $permission = false;
        }
        else{
            $permission = true;
        }

        if(isset($information_description)&&isset($information_id)&&$permission){

            $this->{'model_extension_module_'.$this->codename}->editInformation($information_id, array('information_description' => $information_description));

            $json['success'] = 'success';
        }
        else{
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function saveTemplate(){
        $this->load->model('setting/setting');

        $json = array();

        if(isset($this->request->post['content'])){
            $content = $this->request->post['content'];
        }

        if(isset($this->request->post['name'])){
            $name = $this->request->post['name'];
        } 

        if(isset($this->request->post['image'])){
            $image = $this->request->post['image'];
        } 

        if(isset($this->request->post['category'])){
            $category = $this->request->post['category'];
        }  

        if(isset($this->request->post['sort_order'])){
            $sort_order = $this->request->post['sort_order'];
        }

        if($this->validateTemplateForm()){

            $template_info = array(
                'name'=> $name,
                'image' => $image,
                'category' => $category,
                'content' => $content,
                'sort_order' => $sort_order
                );

            $this->{'model_extension_module_'.$this->codename}->addTemplate($template_info);
            $json['success'] = 'success';
        }
        else{
            $json['error'] = $this->error;
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    protected function validateTemplateForm() {

        if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
            $this->error['name'] = $this->language->get('error_template_name');
        }

        return !$this->error;
    }

}
