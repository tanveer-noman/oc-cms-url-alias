CMSPACK :: URL ALIAS
=====================


Description
===========
This extension is under CMS PACK for opencart store. User can create any desired SEO friendly url alias with this. Very easy to use. What you need just go to the "Url Alias" from Extension and then insert, edit or delete any alias.


Installation
============
Copy cms folder to it's desired folder in the admin section. You need to change some files also (as vqmod is not currently available). But I can assure you it will provide soon. 

Step 1: Backup all your data and source code. 

Step 2: Login to admin panel. Go to System > Settings. Click "Edit" of your store. Select "Server" tab. Select "Use SEO URL's" -> Yes and save. 

Step 3: Go to your root folder and rename the file .htaccess_text to .htaccess. These lines of this file should be uncommented. 

	RewriteBase /
	RewriteRule ^sitemap.xml$ index.php?route=feed/google_sitemap [L]
	RewriteRule ^googlebase.xml$ index.php?route=feed/google_base [L]
	RewriteRule ^download/(.*) /index.php?route=error/not_found [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteCond %{REQUEST_URI} !.*\.(ico|gif|jpg|jpeg|png|js|css)
	RewriteRule ^([^?]*) index.php?_route_=$1 [L,QSA]


Step 4: unzip CMSPACK.zip file. Copy cms folder as per belonging folders like controller, language, model, view. 

Step 5: Upload 'vqmod/xml/admin_menu_modification.xml' file to vQmod xml directory.

Or, 

Step 5: If you don't have vQmod right now, you need to edit these following files 

	1. admin/controller/common/header.php 
	
	search this line 
		$this->data['text_product'] = $this->language->get('text_product'); 
	add after that line
		$this->data['text_url_alias'] = $this->language->get('text_url_alias');

	search this line 
		$this->data['product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'], 'SSL');
	add after that line
		$this->data['url_alias'] = $this->url->link('cms/alias', 'token=' . $this->session->data['token'], 'SSL');
	
	2. admin/language/english/common.php 
	
	search this line 
		$_['text_product']                     = 'Products';
	add after that line
		$_['text_url_alias']				   = 'Url Alias';
	
	3. admin/view/template/common/header.tpl
	search this line 
		<li><a href="<?php echo $feed; ?>"><?php echo $text_feed; ?></a></li>
    add after that line
		<li><a href="<?php echo $url_alias; ?>"><?php echo $text_url_alias; ?></a></li> 
	


Upcoming Modules
================

* Form Manager: Create and add any form you want to any page in your store.
* Menu Manager: Manage your admin menu right away. 
* gFeed Manager: Google Spreadsheet synchronization with opencart. It can load categories, manufactures, products from google spreadsheet.
* Report Manager: Manage your sells, quick view and generate report
* Ad Manager: Advertise products via SMS, Email and ad server

Changelog
=========
1.0.1: resolving "text_url_alias" shows when user in the dashboard 
1.0.2: vqmod xml file has been added to show ‘Url Alias’ menu item under Extentions admin menu 

Download From OpenCart.Com
==========================
http://www.opencart.com/index.php?route=extension/extension/info&extension_id=15375&filter_search=cms%20url%20alias
