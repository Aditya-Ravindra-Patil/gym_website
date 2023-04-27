<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function home()
	{
		$this->load->view('includes/header');
        $this->load->view('home');
        $this->load->view('includes/footer');
	}

    // public function aboutus()
    // {
    //     $this->load->view('includes/header');
    //     $this->load->view('about');
    //     $this->load->view('includes/footer');
    // }

    public function timetable()
    {
        $this->load->view('includes/header');
        $this->load->view('timetable');
        $this->load->view('includes/footer');
    }

    public function contact()
    {
        $this->load->view('includes/header');
        $this->load->view('contact');
        $this->load->view('includes/footer');
    }

    public function services()
    {
        $this->load->view('includes/header');
        $this->load->view('services');
        $this->load->view('includes/footer');
    }


    public function contact_enquiry($value='')
	{
		$name=$this->input->post('username');
		$email=$this->input->post('email');
		// $phone=$this->input->post('phone');
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');

		$this->load->library('email');
		
		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = $email;
        $config['smtp_pass']    = 'password';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not                      
        $this->email->initialize($config);
		$this->email->from($email, $name);
		$this->email->to("dummymydata@gmail.com");

		$this->email->subject("GYM ENQUIRY");
		$this->email->message($message);

		if($this->email->send())
        {
            $submit = "mail send successfully";
            // $this->session->set_flashdata('message_success', 'We have received your email. ');
            redirect('HomeController/contact',$submit,'refresh');
        }
        else
        {
            $submit = "unable to send mail";
            redirect('HomeController/contact',$nsubmit,'refresh');

        }
	}
}
