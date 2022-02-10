<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model  
{
    public function check_login($email, $password) {
        $clients = $this->back_m->get_all('clients');
        
		foreach($clients as $check) {
			if($email == $check->email && password_verify($password, $check->password) && $check->active == 1) {
				$session_data['id'] = $check->id;
				$session_data['first_name'] = $check->first_name;
				$session_data['last_name'] = $check->last_name;
				$session_data['email'] = $check->email;
                $session_data['discount'] = $check->discount;
				$session_data['type_client'] = $check->type_client;
				$session_data['client_login'] = TRUE;
				$this->session->set_userdata($session_data);
                $this->load->helper('cart');
                clearCart();
				$logged = true;
                break;
            } else {
				$logged = false;
            }
        }
            
		if($logged == false) {
            return false;
		} else {
            return true;
        }
    }

    public function register($post) {
        $post['password'] = hashPassword($post['password']);
        $post['secret_key'] = md5($post['email'].'|'.$post['password']);
        if ($this->back_m->insert('clients', $post)) {
            sendActive($post['first_name'], $post['email'], $post['secret_key']);
            return true;
        }
        return false;
    }

    public function reset_password($post) {
        $clients = $this->back_m->get_all('clients');
		foreach($clients as $check) {
			if($post['first_name'] == $check->first_name && $post['last_name'] == $check->last_name && $post['email'] == $check->email && $check->active == '1') {
				if(send_new_password($check->id, $check->first_name, $check->email)){
                    return true;
                } else {
                    return false;
                }
                $reset = true;
                break;
            } else {
                $reset = false;
            }
        } 
        if($reset == false) {
            $this->session->set_flashdata('login_false', 'Błędne dane lub Twoje konto nie zostało aktywowane');
            return false;
        } else {
            return true;
        }
    }

    public function active_account($table,  $data, $secret_key) {
        $data = $this->security->xss_clean($data);
        $this->db->where(['secret_key' => $secret_key]);
        $query = $this->db->update($table, $data);
        return $query;
    }
}
