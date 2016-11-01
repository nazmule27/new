
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model("Login_model", "login");
    }
    public function index() {
        if($_POST) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->library('Radius');
            $ip_radius_server="172.16.101.11";
            $shared_secret="testing123*cse";
            //$radius = new Radius($ip_radius_server, $shared_secret);
            //$resultRadius = $radius->AccessRequest($username, $password);

            //$result = $this->login->validate_user($_POST);
            //if(!empty($resultRadius)) {
                $result = $this->login->data_user($_POST);

                if(isset($result)){
                    $data = [
                        'role' => $result->role,
                        'username' => $result->username,
                        'full_name' => $result->full_name,
                    ];

                    $this->session->set_userdata($data);
                    if($result->role=='Faculty') {
                        redirect('home');
                    }

                    else if($result->role=='Admin') {
                        redirect('home');
                    }
                    else {
                        redirect('home');
                    }
                }
                else{
                    $this->session->set_flashdata('login_fail', 'This username is not registered in this system,<br> Please contact to admin!');
                    redirect('login');
                }
            /*} else {
                $this->session->set_flashdata('login_fail', 'Username or password is wrong!');
                redirect('login');
            }*/
        }

        $this->load->view("login_view");
    }
    public function logout() {
        $data = ['role', 'username', 'full_name', 'semester_id'];
        $this->session->unset_userdata($data);
        redirect('login');
    }

}
