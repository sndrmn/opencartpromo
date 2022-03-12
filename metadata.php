<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>METADATA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<!-- Scripts -->
		<script src="assets/js/main2.js"></script>

		<!-- Header -->
			<header id="header">
				<h1>WEBSITE METADATA</h1>
				<button onClick="window.location.reload();">Refresh Page</button><br><br>
				<?php
				    $url = "169.254.169.254";
						$curlresult = exec("curl -m 3 http://$url", $outcome, $status);
						if (0 == $status) {
							$location = exec("curl -H Metadata:true \"http://$url/metadata/instance/compute/location?api-version=2019-03-11&format=text\"");
							if ($location == 'australiaeast' Or $location == 'southeastasia'){
								$name = exec("curl -H Metadata:true \"http://$url/metadata/instance/compute/name?api-version=2017-08-01&format=text\"");
								$public_ip = exec("curl -H Metadata:true \"http://$url/metadata/instance/network/interface/0/ipv4/ipAddress/0/publicIpAddress?api-version=2017-08-01&format=text\"");
								$private_ip = exec("curl -H Metadata:true \"http://$url/metadata/instance/network/interface/0/ipv4/ipAddress/0/privateIpAddress?api-version=2017-08-01&format=text\"");
								$rgname = exec("curl -H Metadata:true \"http://$url/metadata/instance/compute/resourceGroupName?api-version=2017-08-01&format=text\"");
								$local_hostname = gethostname();
								$OS = php_uname();
								$WebServer = $_SERVER['SERVER_SOFTWARE'];
								echo nl2br("<strong>This VM is running in Azure</strong> \n\n <strong>VM Name:</strong> \n$name \n\n<strong>PRIVATE IP:</strong> \n$private_ip \n\n<strong>HOSTNAME:</strong> \n$local_hostname \n\n<strong>OS VERSION:</strong> \n$OS \n\n<strong>WEB SOFTWARE:</strong> \n$WebServer \n\n <strong>Location:</strong> \n$location \n\n <strong>Public IP:</strong> \n$public_ip \n\n <strong>RESOURCE GROUP:</strong> \n $rgname");
							} else {
								$instance_id = exec("curl http://$url/latest/meta-data/instance-id");
								$reg_az = exec("curl http://$url/latest/meta-data/placement/availability-zone/");
								$public_ipv4 = exec("curl http://$url/latest/meta-data/public-ipv4/");
								$local_hostname = gethostname();
								$OS = php_uname();
								$WebServer = $_SERVER['SERVER_SOFTWARE'];
								$local_ipv4 = exec("curl http://$url/latest/meta-data/local-ipv4/");
								echo nl2br("<strong>This VM is running in AWS</strong> \n\n <strong> INSTANCE ID:</strong> \n$instance_id \n\n<strong>PRIVATE IP:</strong> \n$local_ipv4 \n\n<strong>HOSTNAME:</strong> \n$local_hostname \n\n<strong>OS VERSION:</strong> \n$OS \n\n<strong>WEB SOFTWARE:</strong> \n$WebServer \n\n<strong>AVAILABILITY ZONE:</strong> \n$reg_az \n\n<strong>PUBLIC IP:</strong> \n$public_ipv4 ");
								return $reg_az;
							}
						} else {
							$local_hostname = gethostname();
							$vmtools = exec("vmware-toolbox-cmd -v");
							#$serverip = $_SERVER['SERVER_ADDR'];
							echo nl2br("<strong>This VM is running On-Prem </strong> \n\n <strong> HOSTNAME: </strong> \n $local_hostname \n\n <strong>VMTOOLS: </strong> \n $vmtools");
							$onprem = "VMware";
							return $onprem;
					}
				?>
			</header>

		

	</body>
</html>