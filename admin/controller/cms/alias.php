<?php 
class ControllerCmsAlias extends Controller { 
	private $error = array();
 
	public function index() {
		$this->load->language('cms/alias');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cms/alias');
		 
		$this->getList();
	}

	public function insert() {
		$this->load->language('cms/alias');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cms/alias');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cms_alias->addAlias($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('cms/alias', 'token=' . $this->session->data['token'], 'SSL')); 
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('cms/alias');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cms/alias');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cms_alias->editAlias($this->request->get['url_alias_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('cms/alias', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('cms/alias');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cms/alias');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $url_alias_id) {
				$this->model_cms_alias->deleteAlias($url_alias_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('cms/alias', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}

	private function getList() {
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('cms/alias', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['insert'] = $this->url->link('cms/alias/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('cms/alias/delete', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['aliases'] = array();
		
		$results = $this->model_cms_alias->getAliases(0);

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('cms/alias/update', 'token=' . $this->session->data['token'] . '&url_alias_id=' . $result['url_alias_id'], 'SSL')
			);
					
			$this->data['aliases'][] = array(
				'url_alias_id' 		=> $result['url_alias_id'],
				'query'        	=> $result['query'],
				'keyword'  		=> $result['keyword'],
				'selected'    	=> isset($this->request->post['selected']) && in_array($result['url_alias_id'], $this->request->post['selected']),
				'action'      	=> $action
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_query'] = $this->language->get('column_query');
		$this->data['column_keyword'] = $this->language->get('column_keyword');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->template = 'cms/alias_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
	}

	private function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');
				
		$this->data['entry_query'] = $this->language->get('entry_query');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_query'] = $this->language->get('entry_query');
		$this->data['entry_top'] = $this->language->get('entry_top');
		$this->data['entry_column'] = $this->language->get('entry_column');		
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_design'] = $this->language->get('tab_design');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
 		if (isset($this->error['query'])) {
			$this->data['error_query'] = $this->error['query'];
		} else {
			$this->data['error_query'] = array();
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('cms/alias', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['url_alias_id'])) {
			$this->data['action'] = $this->url->link('cms/alias/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('cms/alias/update', 'token=' . $this->session->data['token'] . '&url_alias_id=' . $this->request->get['url_alias_id'], 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('cms/alias', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['url_alias_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$alias_info = $this->model_cms_alias->getAlias($this->request->get['url_alias_id']);
    	}
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$aliases = $this->model_cms_alias->getAliases(0);

		// Remove own id from list
		if (isset($alias_info)) {
			foreach ($aliases as $key => $alias) {
				if ($alias['url_alias_id'] == $alias_info['url_alias_id']) {
					unset($aliases[$key]);
				}
			}
		}

		$this->data['aliases'] = $aliases;

		if (isset($this->request->post['query'])) {
			$this->data['query'] = $this->request->post['query'];
		} elseif (isset($alias_info)) {
			$this->data['query'] = $alias_info['query'];
		} else {
			$this->data['query'] = '';
		}					
		
		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (isset($alias_info)) {
			$this->data['keyword'] = $alias_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}		
		
						
		$this->template = 'cms/alias_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'cms/alias')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		

		foreach ($this->request->post as $a=>$value) {
			if ((strlen(utf8_decode($value)) < 2) || (strlen(utf8_decode($value)) > 255)) {
				$this->error['query'] = $this->language->get('error_query');
			}
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
					
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'cms/alias')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
}
?>
