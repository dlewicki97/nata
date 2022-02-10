<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			$data = loadDefaultData();
			echo loadViewsBack('index', $data);
		} else {
			redirect('panel');
		}
	}

	public function export_database()
	{
		$NAME = $this->db->database;
		$this->load->dbutil();
		$prefs = array(
			'format' => 'sql',
			'filename' => 'my_db_backup.sql'
		);
		@$backup = &$this->dbutil->backup($prefs);
		$db_name = $NAME . '.sql';
		$save = 'sql/' . $db_name;
		$this->load->helper('file');
		write_file($save, $backup);
	}

	public function import_database($import_file_name)
	{
		$temp_line = '';
		$lines = file('sql/' . $import_file_name);
		foreach ($lines as $line) {
			if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 1) == '#')
				continue;
			$temp_line .= $line;
			if (substr(trim($line), -1, 1) == ';') {
				$this->db->query($temp_line);
				$temp_line = '';
			}
		}
	}
}
