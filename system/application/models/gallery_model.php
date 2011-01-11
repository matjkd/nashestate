<?php 
class Gallery_model extends Model {
	
	var $gallery_path;
	var $gallery_path_url;
	
	function Gallery_model() {
		
		parent::Model();
		
		$this->gallery_path = './images/properties';
		$this->gallery_path_url = base_url().'images/properties/';
		
	}
	
	function do_upload($id) {
		
		$config = array(
		'allowed_types' => 'jpg|jpeg|gif|png',
		'upload_path' => $this->gallery_path . '/'.$id.'',
		'max_size' => 2000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/'.$id.'/thumbs',
			'maintain_ratio' => true,
			'width' => 134,
			'height' => 100
		
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		
		
		$config2 = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/'.$id.'/medium',
			'maintain_ratio' => true,
			'width' => 400,
			'height' => 300
		);
		
		$this->image_lib->initialize($config2);
		$this->image_lib->resize();
		
		$upload_data = array($this->upload->data());
		
		foreach($upload_data as $row):
		
		// add this to database $row['file_name'];
		$new_image_data = array(
				'filename' => $row['file_name'],
				'property_id' => $id
		);
		
		$this->db->insert('property_images', $new_image_data);
		
		endforeach;
		
		
		
	}
	
	function get_images($id) {
		
		$files = scandir('./images/properties/'.$id.'');
		$files = array_diff($files, array('.', '..', 'thumbs', 'medium', 'large'));
		
		$images = array();
		
		foreach ($files as $file) {
			$images []= array (
				'url' => $this->gallery_path_url . ''.$id.'/'.$file.'',
				'thumb_url' => $this->gallery_path_url . ''.$id.'/thumbs/' . $file
			);
		}
		
		return $images;
	}
	
	function get_property_images($id)
	{
		$this->db->from('property_images');
		$this->db->where('property_id', $id);
		$query = $this->db->get();
		
		if($query->num_rows > 0);
			{
				return $query->result();
			}
			
		return FALSE;
	}
	
	function edit_images($id, $field, $value)
	{
		$update_data = array(
					$field => $value
					);
		$this->db->where('image_id', $id);
		$update2 = $this->db->update('property_images', $update_data);
		return $update2;
	}
	
	function delete_image($id)
	{
		$this->db->from('property_images');
		$this->db->where('image_id', $id);
		$query = $this->db->get();
		
		if($query->num_rows == 1);
			{
				
				foreach($query->result_array() as $row):
				
					$filename = $row['filename'];
					$property_id = $row['property_id'];
				
				endforeach; 
				
				
				//delete image from database
				$this->db->where('image_id', $id);
				$delete = $this->db->delete('property_images');
				
				//delete images from server
				$this->load->library('ftp');

				$config['hostname'] = $this->config_ftp_host;
				$config['username'] = $this->config_ftp_user;
				$config['password'] = $this->config_ftp_password;
				$config['port']     = 21;
				$config['passive']  = FALSE;
				$config['debug']    = TRUE;

				$this->ftp->connect($config);
				$this->ftp->delete_file('/public_html/images/properties/'.$property_id.'/'.$filename.'');
				$this->ftp->delete_file('/public_html/images/properties/'.$property_id.'/medium/'.$filename.'');
				$this->ftp->delete_file('/public_html/images/properties/'.$property_id.'/thumbs/'.$filename.'');
			}
		
		
		
		
	}
	
	
	
}