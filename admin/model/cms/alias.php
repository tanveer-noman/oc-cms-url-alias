<?php
class ModelCmsAlias extends Model {
	public function addAlias($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = '" . $this->db->escape($data['query']) . "', `keyword` = '" . $this->db->escape($data['keyword']) . "'");
		$this->cache->delete('alias');
	}
	
	public function editAlias($url_alias_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET query = '" . $this->db->escape($data['query']) . "', `keyword` = '" . $this->db->escape($data['keyword']) . "' WHERE url_alias_id = '" . (int)$url_alias_id . "'");
		$this->cache->delete('alias');
	}
	
	public function deleteAlias($url_alias_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE url_alias_id = '" . (int)$url_alias_id . "'");
		$this->cache->delete('alias');
	} 

	public function getAlias($url_alias_id) {
		$query = $this->db->query("SELECT DISTINCT " . DB_PREFIX . "url_alias.* FROM " . DB_PREFIX . "url_alias WHERE " . DB_PREFIX . "url_alias.url_alias_id = '" . (int)$url_alias_id . "'");
		
		return $query->row;
	} 
	
	public function getAliases() {
		$alias_data = $this->cache->get('alias.list');
	
		if (!$alias_data) {
			$alias_data = array();			
			$sql = "SELECT * FROM " . DB_PREFIX . "url_alias c ORDER BY c.keyword, c.query ASC";
			$query = $this->db->query($sql);			
			foreach ($query->rows as $result) {
				$alias_data[] = array(
					'url_alias_id' => $result['url_alias_id'],
					'query'        => $result['query'],
					'keyword'  	   => $result['keyword']
				);
			}	
			$this->cache->set('alias.' . $this->config->get('config_language_id') . '.' . 'list', $alias_data);
		}		
		return $alias_data;
	}		
	public function getTotalAliases() {
      	$query = $this->db->query("SELECT COUNT(alias.*) AS total FROM " . DB_PREFIX . "url_alias WHERE 0=0");
		
		return $query->row['total'];
	}
	
	// Alias info by query field start
	
	public function getAliasesInfo($category_id) {
		$alias_data = $this->cache->get('alias.list');
	
		if (!$alias_data) {
			$alias_data = array();			
			$sql = "SELECT * FROM " . DB_PREFIX . "url_alias c WHERE c.query = 'route=special/special&amp;category_id=".$category_id."' OR c.query = 'category_id=".$category_id."' ORDER BY c.keyword, c.query ASC";
			$query = $this->db->query($sql);			
			foreach ($query->rows as $result) {
				$alias_data[] = array(
					'url_alias_id' => $result['url_alias_id'],
					'query'        => $result['query'],
					'keyword'  	   => $result['keyword']
				);
			}	
			$this->cache->set('alias.' . $this->config->get('config_language_id') . '.' . 'list', $alias_data);
		}		
		return $alias_data;
	}
	
	// Alias info by query field end
	
	
	
}
?>