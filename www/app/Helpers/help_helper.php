<?php
function convertTanggal($tanggal)
{
	$explodeTanggal = explode("-", $tanggal);
	// print_r($tanggal);
	$bulan = bulan($explodeTanggal[1]);
	// print_r($bulan);
	return $bulan . " " . $explodeTanggal[0];
}
function convertBulan($tanggal)
{
	$explodeTanggal = explode("-", $tanggal);
	return bulan($explodeTanggal[1]);
}
function convertTahun($tanggal)
{
	$explodeTanggal = explode("-", $tanggal);
	return $explodeTanggal[0];
}
function convertFullTanggalJam($tanggal)
{
	$explodeTanggal = explode(" ", $tanggal);
	$explodeTanggal_ = explode("-", $explodeTanggal[0]);
	// print_r($tanggal);
	$bulan = bulan($explodeTanggal_[1]);
	// print_r($bulan);
	return $explodeTanggal_[2] . " " . $bulan . " " . $explodeTanggal_[0] . " " . $explodeTanggal[1];
}
function convertFullTanggal($tanggal)
{
	$explodeTanggal = explode("-", $tanggal);
	// print_r($tanggal);
	$bulan = bulan($explodeTanggal[1]);
	// print_r($bulan);
	return $explodeTanggal[2] . " " . $bulan . " " . $explodeTanggal[0];
}
function convertBulanTahun($tanggal)
{
	$explodeTanggal = explode("-", $tanggal);
	// print_r($tanggal);
	$bulan = bulan($explodeTanggal[1]);
	// print_r($bulan);
	return $bulan . " " . $explodeTanggal[0];
}
function bulan($bulan)
{
	if ($bulan == "01") {
		$resultBulan = "Jan";
	} else if ($bulan == "02") {
		$resultBulan = "Feb";
	} else if ($bulan == "03") {
		$resultBulan = "Mar";
	} else if ($bulan == "04") {
		$resultBulan = "Apr";
	} else if ($bulan == "05") {
		$resultBulan = "Mei";
	} else if ($bulan == "06") {
		$resultBulan = "Jun";
	} else if ($bulan == "07") {
		$resultBulan = "Jul";
	} else if ($bulan == "08") {
		$resultBulan = "Ags";
	} else if ($bulan == "09") {
		$resultBulan = "Sept";
	} else if ($bulan == "10") {
		$resultBulan = "Okt";
	} else if ($bulan == "11") {
		$resultBulan = "Nov";
	} else if ($bulan == "12") {
		$resultBulan = "Des";
	} else {
		$resultBulan = "Wrong";
	}
	return $resultBulan;
}
function fullBulan($bulan)
{
	if ($bulan == "01") {
		$resultBulan = "Januari";
	} else if ($bulan == "02") {
		$resultBulan = "Februari";
	} else if ($bulan == "03") {
		$resultBulan = "Maret";
	} else if ($bulan == "04") {
		$resultBulan = "April";
	} else if ($bulan == "05") {
		$resultBulan = "Mei";
	} else if ($bulan == "06") {
		$resultBulan = "Juni";
	} else if ($bulan == "07") {
		$resultBulan = "Juli";
	} else if ($bulan == "08") {
		$resultBulan = "Agustus";
	} else if ($bulan == "09") {
		$resultBulan = "September";
	} else if ($bulan == "10") {
		$resultBulan = "Oktober";
	} else if ($bulan == "11") {
		$resultBulan = "November";
	} else if ($bulan == "12") {
		$resultBulan = "Desember";
	} else {
		$resultBulan = "Wrong";
	}
	return $resultBulan;
}
function ifnull($value)
{
	return isset($value) ? $value : "-";
}
function getDataUrl($uri)
{
	$request = \Config\Services::request();
	$segments = $request->uri->getSegments();
	return $segments[$uri];
}
function convertWilayah($wil)
{
	if ($wil == 3) {
		return $wilayah = 'Hilir';
	} elseif ($wil == 2) {
		return $wilayah = 'Madiun';
	} elseif ($wil == 1) {
		return $wilayah = 'Hulu';
	}
}
function convertTipePos($pos)
{
	if ($pos == 4) {
		return $pos_type = 'Klimatologi';
	} elseif ($pos == 3) {
		return $pos_type = 'Kualitas Air';
	} elseif ($pos == 2) {
		return $pos_type = 'TMA';
	} elseif ($pos == 1) {
		return $pos_type = 'Curah Hujan';
	}
}
function force_download($filename = '', $data = '', $set_mime = FALSE)
{
	if ($filename === '' or $data === '') {
		return;
	} elseif ($data === NULL) {
		if (!@is_file($filename) or ($filesize = @filesize($filename)) === FALSE) {
			return;
		}

		$filepath = $filename;
		$filename = explode('/', str_replace(DIRECTORY_SEPARATOR, '/', $filename));
		$filename = end($filename);
	} else {
		$filesize = strlen($data);
	}

	// Set the default MIME type to send
	$mime = 'application/octet-stream';

	$x = explode('.', $filename);
	$extension = end($x);

	if ($set_mime === TRUE) {
		if (count($x) === 1 or $extension === '') {
			/* If we're going to detect the MIME type,
			 * we'll need a file extension.
			 */
			return;
		}

		// Load the mime types
		$mimes = &get_mimes();

		// Only change the default MIME if we can find one
		if (isset($mimes[$extension])) {
			$mime = is_array($mimes[$extension]) ? $mimes[$extension][0] : $mimes[$extension];
		}
	}

	/* It was reported that browsers on Android 2.1 (and possibly older as well)
	 * need to have the filename extension upper-cased in order to be able to
	 * download it.
	 *
	 * Reference: http://digiblog.de/2011/04/19/android-and-the-download-file-headers/
	 */
	if (count($x) !== 1 && isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/Android\s(1|2\.[01])/', $_SERVER['HTTP_USER_AGENT'])) {
		$x[count($x) - 1] = strtoupper($extension);
		$filename = implode('.', $x);
	}

	if ($data === NULL && ($fp = @fopen($filepath, 'rb')) === FALSE) {
		return;
	}

	// Clean output buffer
	if (ob_get_level() !== 0 && @ob_end_clean() === FALSE) {
		@ob_clean();
	}

	// Generate the server headers
	header('Content-Type: ' . $mime);
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	header('Expires: 0');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . $filesize);
	header('Cache-Control: private, no-transform, no-store, must-revalidate');

	// If we have raw data - just dump it
	if ($data !== NULL) {
		exit($data);
	}

	// Flush 1MB chunks of data
	while (!feof($fp) && ($data = fread($fp, 1048576)) !== FALSE) {
		echo $data;
	}

	fclose($fp);
	exit;
}
function classActiveUrl($url, $getSegments)
{
	$request = \Config\Services::request();
	$segments = $request->uri->getSegments($getSegments);
	// print_r($url);
	// print_r($segments[0]);
	// print_r(count($segments));
	// exit;

	if (count($segments) == 0) {
		$segments = "home";
	} else {
		$segments = $segments[0];
	}

	if ($url == $segments) {
		return "active";
	} else {
		return "";
	}
}
//Dynamically add Javascript files to header page
if (!function_exists('add_js')) {
	function add_js($file = '', $atts = array())
	{
		if (empty($file)) {
			return;
		}
		if (!empty($file)) {
			foreach ($file as $e) {
				$element = '<script type="text/javascript" src="' . base_url() . '/' . $e . '"';
				foreach ($atts as $key => $val)
					$element .= '' . $key . '="' . $val . '"';
				$element .= '></script>' . "\n";
				echo $element;
			}
		}
	}
}

//Dynamically add CSS files to header page
if (!function_exists('add_css')) {
	function add_css($file = '', $atts = array())
	{
		if (empty($file)) {
			return;
		}
		if (!empty($file)) {
			foreach ($file as $e) {
				$element = '<link rel="stylesheet" href="' . base_url() . '/' . $e . '"';
				foreach ($atts as $key => $val)
					$element .= ' ' . $key . '="' . $val . '"';
				$element .= '>' . "\n";
				echo $element;
			}
		}
	}
}
function genToken($len = 32, $md5 = true, $huruf = 0)
{
	mt_srand((float)microtime() * 1000000);
	/*$chars = array(
		'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',
		'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',
		'/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',
		'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',
		'?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',
		'=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',
		'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'
	);*/
	if ($huruf == 0) {
		$chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	} else {
		$chars = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	}
	$numChars = count($chars) - 1;
	$token = '';
	for ($i = 0; $i < $len; $i++)
		$token .= $chars[mt_rand(0, $numChars)];
	if ($md5) {
		$chunks = ceil(strlen($token) / 32);
		$md5token = '';
		for ($i = 1; $i <= $chunks; $i++)
			$md5token .= md5(substr($token, $i * 32 - 32, 32));
		$token = substr($md5token, 0, $len);
	}
	return $token;
}

function formatRupiah($nominal)
{
	return number_format($nominal, 0, ",", ".");
}
function provinsi()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 33c687d75972ca00253a4fd09d36ef14"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		$_data = [];
		for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
			$_data[] = array(
				"id" => $data['rajaongkir']['results'][$i]['province_id'],
				"provinsi" => $data['rajaongkir']['results'][$i]['province']
			);
		}
		return $_data;
	}
}
function _provinsi($id)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=" . $id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 33c687d75972ca00253a4fd09d36ef14"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		$_data = [];
		$_data[] = array(
			"id" => $data['rajaongkir']['results']['province_id'],
			"provinsi" => $data['rajaongkir']['results']['province']
		);
		return $_data;
	}
}
function _kota()
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 33c687d75972ca00253a4fd09d36ef14"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		$_data = [];
		for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
			$_data[] = array(
				"id" => $data['rajaongkir']['results'][$i]['city_id'],
				"kota" => $data['rajaongkir']['results'][$i]['city_name']
			);
		}
		return $_data;
	}
}
function city($id)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 33c687d75972ca00253a4fd09d36ef14"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		$_data = [];
		for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
			$_data[] = array(
				"id" => $data['rajaongkir']['results'][$i]['city_id'],
				"kota" => $data['rajaongkir']['results'][$i]['city_name']
			);
		}
		return $_data;
	}
}
function _city($city, $provinsi)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=" . $city . "&province=" . $provinsi,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 33c687d75972ca00253a4fd09d36ef14"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		$_data = [];
		$_data[] = array(
			"id" => $data['rajaongkir']['results']['city_id'],
			"kota" => $data['rajaongkir']['results']['city_name']
		);
		return $_data;
	}
}
function postal_code($id)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=" . $id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: 33c687d75972ca00253a4fd09d36ef14"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$data = json_decode($response, true);
		$_data = $data['rajaongkir']['results']['postal_code'];
		return $_data;
	}
}
function cost($origin, $destination, $weight)
{

	$courier = ['jne', 'pos', 'tiki'];
	// $courier = ['jne'];

	$_data = [];
	for ($x = 0; $x < count($courier); $x++) {
		$curl = curl_init();

		// $courier = "jne:pos:tiki";

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=" . $courier[$x],
			// CURLOPT_POSTFIELDS => "origin=501&destination=114&weight=1700&courier=jne",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: 33c687d75972ca00253a4fd09d36ef14"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);


		// echo $response;

		// print_r($response);
		// exit;


		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response, true);
			// print_r($data);
			// exit;
			// $_data = [];
			for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
				for ($l = 0; $l < count($data['rajaongkir']['results'][$i]['costs']); $l++) {
					$_data[$data['rajaongkir']['results'][$i]['code']][] = array(
						"code" => $data['rajaongkir']['results'][$i]['code'],
						"service" => $data['rajaongkir']['results'][$i]['costs'][$l]['service'],
						"etd" => $data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['etd'],
						"cost" => (int) $data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value']
					);
				}
			}
		}
	}
	return $_data;
}

function parsingdata($data, $jumlah)
{
	$piutang_usaha = [];
	$a = [];
	$aa = [];
	$merge_parameter = [];
	foreach ($data as $key => $value) {
		// print_r($key);
		foreach ($value as $k => $v) {
			$a[] = $v;
			$aa[$key][$v['id_emiten']][] = $v;
			$merge_parameter[] = $v['parameter'];
		}
	}

	// echo json_encode($aa);

	$abc = [];
	for ($i = 0; $i < count($data); $i++) {
		// print_r($jumlah);
		// $aa[$i][$data[$i]['id_emiten']][] = $v;
		$array = array(
			"id_emiten" => $jumlah[$i]
		);
		$_data = isset($data[$i][0]) ? $data[$i][0] : $array;
		$abc[$jumlah[$i]][] = $_data;
	}
	// echo json_encode($abc);
	// echo json_encode($data);
	// print_r($merge_parameter);
	$b = [];
	for ($i = 0; $i < count(array_unique($merge_parameter)); $i++) {
		foreach ($a as $key => $value) {
			for ($x = 0; $x < count($jumlah); $x++) {
				if (in_array($value['parameter'], $merge_parameter)) {
					$b[$value['parameter']][$value['id_emiten']]['id_emiten'] = $value['id_emiten'];
					$b[$value['parameter']][$value['id_emiten']]['parameter'] = $value['parameter'];
					$b[$value['parameter']][$value['id_emiten']]['value'] = $value['value'];
				}
				$b[$value['parameter']][$jumlah[$x]]['id_emiten'] = 0;
			}
		}
	}

	// echo json_encode($b);


	// $keys = [];
	// foreach ($abc as $entry) {
	// 	$keys = array_merge($keys, array_keys($entry));
	// }

	// // pad missing keys with an empty string
	// foreach ($b as &$entry) {
	// 	foreach ($keys as $key) {
	// 		if (!isset($entry[$key])) {
	// 			$entry[$key] = '';
	// 		}
	// 	}
	// }

	// echo json_encode($keys); 
	// echo json_encode($aa);
	// echo json_encode($b);
	// exit;

	return $b;
}

function minichart($kode)
{
	echo '<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                            {
                                "symbol": "IDX:' . $kode . '",
                                "width": "100%",
                                "height": 220,
                                "locale": "en",
                                "dateRange": "1D",
                                "colorTheme": "light",
                                "trendLineColor": "rgba(41, 98, 255, 1)",
                                "underLineColor": "rgba(41, 98, 255, 0.3)",
                                "underLineBottomColor": "rgba(41, 98, 255, 0)",
                                "isTransparent": false,
                                "autosize": false,
                                "largeChartUrl": ""
                            }
                        </script>';
}

function fullchart($kode)
{
	echo '<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
	  <div id="analytics-platform-chart-demo"></div>
	  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
	  <script type="text/javascript">
	  new TradingView.widget(
	  {
	  "container_id": "analytics-platform-chart-demo",
	  "width": "100%",
	  "height": "100%",
	  "autosize": true,
	  "symbol": "IDX:' . $kode . '",
	  "interval": "D",
	  "timezone": "exchange",
	  "theme": "light",
	  "style": "0",
	  "toolbar_bg": "#f1f3f6",
	  "withdateranges": true,
	  "allow_symbol_change": true,
	  "save_image": false,
	  "details": true,
	  "hotlist": true,
	  "calendar": true,
	  "locale": "id"
	}
	  );
	  </script>
	</div>
	<!-- TradingView Widget END -->';
}

function ikhtisarpasar()
{
	echo '<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
	  <div class="tradingview-widget-container__widget"></div>
	  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
	  {
	  "colorTheme": "light",
	  "dateRange": "12M",
	  "showChart": true,
	  "locale": "id",
	  "largeChartUrl": "",
	  "isTransparent": false,
	  "showSymbolLogo": true,
	  "showFloatingTooltip": false,
	  "width": "400",
	  "height": "660",
	  "plotLineColorGrowing": "rgba(41, 98, 255, 1)",
	  "plotLineColorFalling": "rgba(41, 98, 255, 1)",
	  "gridLineColor": "rgba(240, 243, 250, 0)",
	  "scaleFontColor": "rgba(120, 123, 134, 1)",
	  "belowLineFillColorGrowing": "rgba(41, 98, 255, 0.12)",
	  "belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
	  "belowLineFillColorGrowingBottom": "rgba(41, 98, 255, 0)",
	  "belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
	  "symbolActiveColor": "rgba(41, 98, 255, 0.12)",
	  "tabs": [
		{
		  "title": "Indeks",
		  "symbols": [
			{
			  "s": "IDX:ACES"
			},
			{
			  "s": "IDX:TLKM"
			}
		  ],
		  "originalTitle": "Indices"
		}
	  ]
	}
	  </script>
	</div>
	<!-- TradingView Widget END -->';
}

function datapasar()
{
	echo '<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
	  <div class="tradingview-widget-container__widget"></div>
	  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-quotes.js" async>
	  {
	  "width": "100%",
	  "height": 450,
	  "symbolsGroups": [
		{
		  "name": "Indeks",
		  "originalName": "Indices",
		  "symbols": [
			{
			  "name": "IDX:ACES"
			},
			{
			  "name": "IDX:TLKM"
			},
			{
			  "name": "IDX:AALI"
			},
			{
			  "name": "IDX:GOTO"
			}
		  ]
		}
	  ],
	  "showSymbolLogo": true,
	  "colorTheme": "light",
	  "isTransparent": false,
	  "locale": "id"
	}
	  </script>
	</div>
	<!-- TradingView Widget END -->';
}

function ihsg()
{
	echo '<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
	  <div id="tradingview_31946" style="height:480px;"></div>
	  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
	  <script type="text/javascript">
	  new TradingView.widget(
	  {
	  "autosize": true,
	  "symbol": "IDX:COMPOSITE",
	  "interval": "D",
	  "timezone": "Etc/UTC",
	  "theme": "light",
	  "style": "1",
	  "locale": "id",
	  "toolbar_bg": "#f1f3f6",
	  "enable_publishing": false,
	  "allow_symbol_change": true,
	  "container_id": "tradingview_31946"
	}
	  );
	  </script>
	</div>
	<!-- TradingView Widget END -->';
}

function widget_ihsg()
{
	echo '<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
	  <div class="tradingview-widget-container__widget"></div>
	  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
	  {
	  "symbol": "IDX:COMPOSITE",
	  "width": "100%",
	  "locale": "id",
	  "colorTheme": "light",
	  "isTransparent": false
	}
	  </script>
	</div>
	<!-- TradingView Widget END -->';
}
