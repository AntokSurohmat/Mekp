<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){

		if($this->session->userdata('email')){
			redirect('member');
		}

		$data['forbi'] = $this->db->get('mekp_forbi',['is_active' == 1])->row_array();

		$this->form_validation->set_rules('a','Username','trim|required');
		$this->form_validation->set_rules('b','Password','trim|required');
		if($this->form_validation->run() == false){

			$data['title'] = "Login";
			$this->template->load('layout/templateauth','layout/login',$data);
		}else{
			//validasinya succes
			$this->_login();
		}
		
	}

	private function _login(){

		$email = $this->input->post('a');
		$password = $this->input->post('b');

		$user = $this->db->get_where('mekp_user',['email' => $email])->row_array();

		//Jika usernya Ada
		if($user){

			//jika usernya aktif
			if($user['is_active'] == 1){

				//cek password
				if(password_verify($password, $user['password'])){
					$data = [

						'email' => $user['email'],
						'role_id' => $user['role_id']

					];
					$this->session->set_userdata($data);
					if($user['role_id'] == 1){
						redirect('admin');
					}else{
						redirect('member');
					}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect('auth');

				}
			}else{

				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This Email is not been activated!</div>');
				redirect('auth');
			}
		}else{

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered!</div>');
			redirect('auth');
		}
	}

	public function register(){

		if($this->session->userdata('email')){
			redirect('member');
		}

		$userAcces = $this->db->get_where('mekp_forbi',['is_active' == 1 ])->row_array() ;

		if($userAcces['is_active'] == 1 ){
			redirect('auth/blocked');
		}
		
		$this->form_validation->set_rules('a','Username','required|trim|is_unique[mekp_user.username]', [
			'is_unique' => 'This Username has alredy taken!'
		]);
		$this->form_validation->set_rules('bb','Email','required|trim|valid_email|is_unique[mekp_user.email]', [
			'is_unique' => 'This email has alredy registered!'
		]);
		$this->form_validation->set_rules('c','Password','required|trim|min_length[6]|matches[d]', [
			'matches' => 'Password dont macth!',
			'min_length' => 'Password to short!'
		]);
		$this->form_validation->set_rules('d','Password','required|trim|matches[c]');

		if($this->form_validation->run() == false){

			$data['title'] = "User Registraton";
			$this->template->load('layout/templateauth','layout/register',$data);
		}else{
			
			$email = $this->input->post('bb',true);
			$data = [
				'username' => htmlspecialchars($this->input->post('a',true)),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('c'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

						//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [

				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('mekp_user', $data);
			$this->db->insert('mekp_token', $user_token);

			$this->_sendEmail($token,'verify');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please active your account</div>');
			redirect('auth');	
		}
		
	}

	private function _sendEmail($token, $type){

		$config = [ 
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com', //gmail
			'smtp_user' => 'kanggolatian@gmail.com', //email yang buat ngirim
			'smtp_pass' => 'CunekpanteK12', //pass email yang buat ngirim
			'smtp_port' =>  465, //google port
			'mailtype'  => 'html', //email typenya
			'charset'   => 'utf-8', //charakternya ditulis carakternya apa
			'newline'   => "\r\n"

		];

		$this->email->initialize($config);
		$this->load->library('email',$config);


		$this->email->from('kanggolatian@gmail.com', 'Antok Surohmat');
		$this->email->to($this->input->post('bb'));


		if($type == 'verify'){

			$subject    =	'Account Verification';
			$message	=	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html style="width:100%;font-family:lato,  helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
						 <head> 
						  <meta charset="UTF-8"> 
						  <meta content="width=device-width, initial-scale=1" name="viewport"> 
						  <meta name="x-apple-disable-message-reformatting"> 
						  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
						  <meta content="telephone=no" name="format-detection"> 
						  <title>New email template 2020-01-03</title> 
						  <!--[if (mso 16)]>
						    <style type="text/css">
						    a {text-decoration: none;}
						    </style>
						    <![endif]--> 
						  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
						  <!--[if !mso]><!-- --> 
						  <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet"> 
						  <!--<![endif]--> 
						  <style type="text/css">
						@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
						#outlook a {
							padding:0;
						}
						.ExternalClass {
							width:100%;
						}
						.ExternalClass,
						.ExternalClass p,
						.ExternalClass span,
						.ExternalClass font,
						.ExternalClass td,
						.ExternalClass div {
							line-height:100%;
						}
						.es-button {
							mso-style-priority:100!important;
							text-decoration:none!important;
						}
						a[x-apple-data-detectors] {
							color:inherit!important;
							text-decoration:none!important;
							font-size:inherit!important;
							font-family:inherit!important;
							font-weight:inherit!important;
							line-height:inherit!important;
						}
						.es-desk-hidden {
							display:none;
							float:left;
							overflow:hidden;
							width:0;
							max-height:0;
							line-height:0;
							mso-hide:all;
						}
						</style> 
						 </head> 
						 <body style="width:100%;font-family:lato,  helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;"> 
						  <div class="es-wrapper-color" style="background-color:#F4F4F4;"> 
						   <!--[if gte mso 9]>
									<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
										<v:fill type="tile" color="#f4f4f4"></v:fill>
									</v:background>
								<![endif]--> 
						   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;"> 
						     <tr class="gmail-fix" height="0" style="border-collapse:collapse;"> 
						      <td style="padding:0;Margin:0;"> 
						       <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td cellpadding="0" cellspacing="0" border="0" style="padding:0;Margin:0;line-height:1px;min-width:600px;" height="0"><img src="https://esputnik.com/repository/applications/images/blank.gif" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px;min-height:0px;min-width:600px;width:600px;" alt width="600" height="1"></td> 
						         </tr> 
						       </table></td> 
						     </tr> 
						     <tr style="border-collapse:collapse;"> 
						      <td valign="top" style="padding:0;Margin:0;"> 
						       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td align="center" style="padding:0;Margin:0;"> 
						           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;"> 
						               <!--[if mso]><table width="580" cellpadding="0" cellspacing="0"><tr><td width="282" valign="top"><![endif]--> 
						               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="282" align="left" style="padding:0;Margin:0;"> 
						                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table> 
						               <!--[if mso]></td><td width="20"></td><td width="278" valign="top"><![endif]--> 
						               <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="278" align="left" style="padding:0;Margin:0;"> 
						                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table> 
						               <!--[if mso]></td></tr></table><![endif]--></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table> 
						       <table class="es-header" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#FFA73B;background-repeat:repeat;background-position:center top;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td align="center" style="padding:0;Margin:0;"> 
						           <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px;"> 
						               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="580" valign="top" align="center" style="padding:0;Margin:0;"> 
						                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table> 
						       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td style="padding:0;Margin:0;background-color:#FFA73B;" bgcolor="#ffa73b" align="center"> 
						           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="padding:0;Margin:0;"> 
						               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
						                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="Margin:0;padding-bottom:5px;padding-left:30px;padding-right:30px;padding-top:35px;"><h1 style="Margin:0;line-height:58px;mso-line-height-rule:exactly;font-family:lato,  helvetica, arial, sans-serif;font-size:48px;font-style:normal;font-weight:normal;color:#111111;">Welcome!</h1></td> 
						                     </tr> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td bgcolor="#ffffff" align="center" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;"> 
						                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                         <tr style="border-collapse:collapse;"> 
						                          <td style="padding:0;Margin:0px;border-bottom:1px solid #FFFFFF;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td> 
						                         </tr> 
						                       </table></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table> 
						       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td align="center" style="padding:0;Margin:0;"> 
						           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="padding:0;Margin:0;"> 
						               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
						                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#FFFFFF;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td class="es-m-txt-l" bgcolor="#ffffff" align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:30px;padding-right:30px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato,  helvetica, arial, sans-serif;line-height:27px;color:#666666;">We are excited to have you get started. First, you need to confirm your account. Just press the button below.</p></td> 
						                     </tr> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:35px;padding-bottom:35px;"><span class="es-button-border" style="border-style:solid;border-color:#FFA73B;background:1px;border-width:1px;display:inline-block;border-radius:2px;width:auto;"><a href="'. base_url() . 'auth/verify?email=' . $this->input->post(bb). '&token=' . urlencode($token) . '" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica,  arial, verdana, sans-serif;font-size:20px;color:#FFFFFF;border-style:solid;border-color:#FFA73B;border-width:15px 30px;display:inline-block;background:#FFA73B;border-radius:2px;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;"> Confirm Account</a></span></td> 
						                     </tr> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td class="es-m-txt-l" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato,  helvetica, arial, sans-serif;line-height:27px;color:#666666;">If you have any questions, just reply to this email—we are always happy to help out.</p></td> 
						                     </tr> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td class="es-m-txt-l" align="left" style="Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;padding-bottom:40px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato,  helvetica, arial, sans-serif;line-height:27px;color:#666666;">Cheers,</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato,  helvetica, arial, sans-serif;line-height:27px;color:#666666;">Antok Surohmat</p></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table> 
						       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td align="center" style="padding:0;Margin:0;"> 
						           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="padding:0;Margin:0;"> 
						               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
						                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="Margin:0;padding-top:10px;padding-bottom:20px;padding-left:20px;padding-right:20px;"> 
						                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                         <tr style="border-collapse:collapse;"> 
						                          <td style="padding:0;Margin:0px;border-bottom:1px solid #F4F4F4;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td> 
						                         </tr> 
						                       </table></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table> 
						       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td align="center" style="padding:0;Margin:0;"> 
						           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="padding:0;Margin:0;"> 
						               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
						                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFECD1;border-radius:4px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffecd1"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="padding:0;Margin:0;padding-top:30px;padding-left:30px;padding-right:30px;"><h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:lato,  helvetica, arial, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#111111;">Need more help?</h3></td> 
						                     </tr> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td esdev-links-color="#ffa73b" align="center" style="padding:0;Margin:0;padding-bottom:30px;padding-left:30px;padding-right:30px;"><a target="_blank" href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato,  helvetica, arial, sans-serif;font-size:18px;text-decoration:underline;color:#111111;">We’re here, ready to talk</a></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table> 
						       <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td align="center" style="padding:0;Margin:0;"> 
						           <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="Margin:0;padding-top:30px;padding-bottom:30px;padding-left:30px;padding-right:30px;"> 
						               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="540" valign="top" align="center" style="padding:0;Margin:0;"> 
						                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="left" style="padding:0;Margin:0;padding-top:25px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:lato,  helvetica, arial, sans-serif;line-height:21px;color:#666666;">You received this email because you just signed up for a new account.</p></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table> 
						       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
						         <tr style="border-collapse:collapse;"> 
						          <td align="center" style="padding:0;Margin:0;"> 
						           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
						             <tr style="border-collapse:collapse;"> 
						              <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;"> 
						               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                 <tr style="border-collapse:collapse;"> 
						                  <td width="560" valign="top" align="center" style="padding:0;Margin:0;"> 
						                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
						                     <tr style="border-collapse:collapse;"> 
						                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
						                     </tr> 
						                   </table></td> 
						                 </tr> 
						               </table></td> 
						             </tr> 
						           </table></td> 
						         </tr> 
						       </table></td> 
						     </tr> 
						   </table> 
						  </div>  
						 </body>
						</html>'; 

				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");

		}else if($type == 'forgot'){

			$subject    =	'Forgot Password';
			$message	=	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html style="width:100%;font-family:lato, helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
			 <head> 
			  <meta charset="UTF-8"> 
			  <meta content="width=device-width, initial-scale=1" name="viewport"> 
			  <meta name="x-apple-disable-message-reformatting"> 
			  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
			  <meta content="telephone=no" name="format-detection"> 
			  <title>New email template 2020-01-03</title> 
			  <!--[if (mso 16)]>
			    <style type="text/css">
			    a {text-decoration: none;}
			    </style>
			    <![endif]--> 
			  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
			  <!--[if !mso]><!-- --> 
			  <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet"> 
			  <!--<![endif]--> 
			  <style type="text/css">
			@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
			#outlook a {
				padding:0;
			}
			.ExternalClass {
				width:100%;
			}
			.ExternalClass,
			.ExternalClass p,
			.ExternalClass span,
			.ExternalClass font,
			.ExternalClass td,
			.ExternalClass div {
				line-height:100%;
			}
			.es-button {
				mso-style-priority:100!important;
				text-decoration:none!important;
			}
			a[x-apple-data-detectors] {
				color:inherit!important;
				text-decoration:none!important;
				font-size:inherit!important;
				font-family:inherit!important;
				font-weight:inherit!important;
				line-height:inherit!important;
			}
			.es-desk-hidden {
				display:none;
				float:left;
				overflow:hidden;
				width:0;
				max-height:0;
				line-height:0;
				mso-hide:all;
			}
			</style> 
			 </head> 
			 <body style="width:100%;font-family:lato, helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;"> 
			  <div class="es-wrapper-color" style="background-color:#F4F4F4;"> 
			   <!--[if gte mso 9]>
						<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
							<v:fill type="tile" color="#f4f4f4"></v:fill>
						</v:background>
					<![endif]--> 
			   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;"> 
			     <tr class="gmail-fix" height="0" style="border-collapse:collapse;"> 
			      <td style="padding:0;Margin:0;"> 
			       <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td cellpadding="0" cellspacing="0" border="0" style="padding:0;Margin:0;line-height:1px;min-width:600px;" height="0"><img src="https://esputnik.com/repository/applications/images/blank.gif" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px;min-height:0px;min-width:600px;width:600px;" alt width="600" height="1"></td> 
			         </tr> 
			       </table></td> 
			     </tr> 
			     <tr style="border-collapse:collapse;"> 
			      <td valign="top" style="padding:0;Margin:0;"> 
			       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td align="center" style="padding:0;Margin:0;"> 
			           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;"> 
			               <!--[if mso]><table width="580" cellpadding="0" cellspacing="0"><tr><td width="282" valign="top"><![endif]--> 
			               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="282" align="left" style="padding:0;Margin:0;"> 
			                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table> 
			               <!--[if mso]></td><td width="20"></td><td width="278" valign="top"><![endif]--> 
			               <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="278" align="left" style="padding:0;Margin:0;"> 
			                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table> 
			               <!--[if mso]></td></tr></table><![endif]--></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table> 
			       <table class="es-header" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#FFA73B;background-repeat:repeat;background-position:center top;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td align="center" style="padding:0;Margin:0;"> 
			           <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px;"> 
			               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="580" valign="top" align="center" style="padding:0;Margin:0;"> 
			                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table> 
			       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td style="padding:0;Margin:0;background-color:#FFA73B;" bgcolor="#ffa73b" align="center"> 
			           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="padding:0;Margin:0;"> 
			               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
			                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="Margin:0;padding-bottom:5px;padding-left:30px;padding-right:30px;padding-top:35px;"><h1 style="Margin:0;line-height:58px;mso-line-height-rule:exactly;font-family:lato, helvetica, arial, sans-serif;font-size:48px;font-style:normal;font-weight:normal;color:#111111;">Hi!</h1></td> 
			                     </tr> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td bgcolor="#ffffff" align="center" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;"> 
			                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                         <tr style="border-collapse:collapse;"> 
			                          <td style="padding:0;Margin:0px;border-bottom:1px solid #FFFFFF;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td> 
			                         </tr> 
			                       </table></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table> 
			       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td align="center" style="padding:0;Margin:0;"> 
			           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="padding:0;Margin:0;"> 
			               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
			                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#FFFFFF;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td class="es-m-txt-l" bgcolor="#ffffff" align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:30px;padding-right:30px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">You recently requested to reset your password for your account. Use the button below to reset it. This password reset is only valid for the next 24 hours.</p></td> 
			                     </tr> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:35px;padding-bottom:35px;"><span class="es-button-border" style="border-style:solid;border-color:#008000;background:1px;border-width:1px;display:inline-block;border-radius:2px;width:auto;"><a href="'. base_url() . 'auth/resetpassword?email=' . $this->input->post(bb). '&token=' . urlencode($token) . '" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, arial, verdana, sans-serif;font-size:20px;color:#FFFFFF;border-style:solid;border-color:#008000;border-width:15px 30px;display:inline-block;background:#008000;border-radius:2px;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;">Reset Your Password</a></span></td> 
			                     </tr> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td class="es-m-txt-l" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">For security, this request was received from a '. $os .' device using '. $browser .'. If you did not request a password reset, please ignore this email or contact support if you have questions.</p></td> 
			                     </tr> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td class="es-m-txt-l" align="left" style="Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;padding-bottom:40px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">Cheers,</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">Antok Surohmat</p></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table> 
			       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td align="center" style="padding:0;Margin:0;"> 
			           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="padding:0;Margin:0;"> 
			               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
			                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="Margin:0;padding-top:10px;padding-bottom:20px;padding-left:20px;padding-right:20px;"> 
			                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                         <tr style="border-collapse:collapse;"> 
			                          <td style="padding:0;Margin:0px;border-bottom:1px solid #F4F4F4;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td> 
			                         </tr> 
			                       </table></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table> 
			       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td align="center" style="padding:0;Margin:0;"> 
			           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="padding:0;Margin:0;"> 
			               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="600" valign="top" align="center" style="padding:0;Margin:0;"> 
			                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFECD1;border-radius:4px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffecd1"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="padding:0;Margin:0;padding-top:30px;padding-left:30px;padding-right:30px;"><h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:lato, helvetica, arial, sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#111111;">Need more help?</h3></td> 
			                     </tr> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td esdev-links-color="#ffa73b" align="center" style="padding:0;Margin:0;padding-bottom:30px;padding-left:30px;padding-right:30px;"><a target="_blank" href="#" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, helvetica, arial, sans-serif;font-size:18px;text-decoration:underline;color:#111111;">We’re here, ready to talk</a></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table> 
			       <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td align="center" style="padding:0;Margin:0;"> 
			           <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="Margin:0;padding-top:30px;padding-bottom:30px;padding-left:30px;padding-right:30px;"> 
			               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="540" valign="top" align="center" style="padding:0;Margin:0;"> 
			                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="left" style="padding:0;Margin:0;padding-top:25px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:lato, helvetica, arial, sans-serif;line-height:21px;color:#666666;">You received this email because you just requested to reset your password for your account.</p></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table> 
			       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
			         <tr style="border-collapse:collapse;"> 
			          <td align="center" style="padding:0;Margin:0;"> 
			           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center"> 
			             <tr style="border-collapse:collapse;"> 
			              <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;"> 
			               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                 <tr style="border-collapse:collapse;"> 
			                  <td width="560" valign="top" align="center" style="padding:0;Margin:0;"> 
			                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
			                     <tr style="border-collapse:collapse;"> 
			                      <td align="center" style="padding:0;Margin:0;display:none;"></td> 
			                     </tr> 
			                   </table></td> 
			                 </tr> 
			               </table></td> 
			             </tr> 
			           </table></td> 
			         </tr> 
			       </table></td> 
			     </tr> 
			   </table> 
			  </div>  
			 </body>
			</html>';

			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_mailtype("html");
		}
		
		if($this->email->send()){
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify(){

		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('mekp_user',['email' => $email])->row_array();

		if($user){
			$user_token = $this->db->get_where('mekp_token',['token' => $token])->row_array();

			if($user_token){

				//waktu validation
				if(time() - $user_token['date_created'] < (60*60*24)){
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('mekp_user',['email' => $email]);


					$this->db->delete('mekp_token',['email' => $email]);

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'. $email .' has been activated! Please Login.</div>');
					redirect('auth');
				}else{

					$this->db->delete('mekp_user',['email' => $email]);
					$this->db->delete('mekp_token',['email' => $email]);

					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
					redirect('auth');

				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
				redirect('auth');

			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
			redirect('auth');

		}
	}

	public function logout(){

		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role.id');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('auth');	
	}

	public function blocked(){

		$data['user'] = $this->db->get_where('mekp_user',['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "	Acces Forbidden";
		$this->template->load('layout/templateblock','layout/403',$data);
	}

	public function forgotPassword(){

		$data['forbi'] = $this->db->get('mekp_forbi',['is_active' == 1])->row_array();

		$this->form_validation->set_rules('bb','Email','trim|required|valid_email');

		if($this->form_validation->run() == false ){
			$data['title'] = "Forgot Password";
			$this->template->load('layout/templateauth','layout/forgot_password',$data);

		}else{ 
			$email = $this->input->post('bb');
			$user = $this->db->get_where('mekp_user',['email' => $email, 'is_active' => 1])->row_array();

			if($user){
				$token = base64_encode(random_bytes(32)); //untuk php 7++ version
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
				redirect('auth/forgotpassword');

			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
				redirect('auth/forgotpassword');

			}

		}
	}

	public function resetPassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('mekp_user',['email' => $email])->row_array();

		if($user){

			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
			
			if($user_token){
				$this->session->set_userdata('reset_email',$email);
				$this->changePassword();
				
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset Password failed Wrong Token!</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset Password failed Wrong Email!</div>');
			redirect('auth');
		}
	}

	public function changePassword(){

		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}

		$this->form_validation->set_rules('a','Password','required|trim|min_length[6]|matches[b]');
		$this->form_validation->set_rules('b','Repeat Password','required|trim|min_length[6]|matches[a]');
		if($this->form_validation->run() ==  false){

			$data['title'] = "Change Password";
			$this->template->load('layout/templateauth','layout/change_password',$data);
		}else{

			$password = password_hash($this->input->post('a'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password',$password);
			$this->db->where('email', $email);
			$this->db->update('mekp_user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password has been change. Please login!</div>');
			redirect('auth');
		}
		
	}

}