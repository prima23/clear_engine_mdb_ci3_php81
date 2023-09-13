<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

/**
 * Description of my_controller class
 *
 * @author Yogi "solop" Kaputra
 */

class MY_Controller extends MX_Controller
{

	function __construct()
	{
		parent::__construct();

		// echo '  
		// <!DOCTYPE html>
		// <html>
		// 	<head>
		// 		<title>Aplikasi TPP maintenance</title>
		// 		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		// 		<meta name="viewport" content="width=device-width, initial-scale=1" />
		// 		<style type="text/css">
		// 			body { text-align: center; padding: 10%; font: 20px Helvetica, sans-serif; color: #333; }
		// 			h1 { font-size: 50px; margin: 0; }
		// 			article { display: block; text-align: left; max-width: 650px; margin: 0 auto; }
		// 			a { color: #2583ff; text-decoration: none; }
		// 			a:hover { color: #333; text-decoration: none; }
		// 			@media only screen and (max-width : 480px) {
		// 				h1 { font-size: 40px; }
		// 			}
		// 		</style>
		// 	</head>
		// 	<body>
		// 		<article>
		// 			<h2>Aplikasi TPP dalam Pemeliharaan dan Pembaharuan.</h1>
		// 			<p>Pemeliharaan dan pembaharuan dilakukan pada:</p>
		// 			<p style="margin-left:30px;">5 Oktober 2021, 16.00 Wib <br><span style="margin-left:70px;">sampai</span><br> 6 Oktober 2021, 08.00 Wib.</p>
		// 			<p>Kami mohon maaf atas ketidaknyamanan ini.</p>
		// 			<p id="signature">&mdash; <a href="https://diskominfo.sumbarprov.go.id/">[IT Team, Kominfotik Prov.Sumbar.]</a></p>
		// 		</article>
		// 	</body>
		// </html>';
		// die();

		if (version_compare(CI_VERSION, '2.1.0', '<')) {
			$this->load->library('security');
		}
	}
}
