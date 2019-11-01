<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?= $this->_titlepage ?></title>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYVxdF4VwIPfmB65X2kMt342GbUXApwQ" async defer></script>
	<link rel="stylesheet" type="text/css" href="/scripts/carousel/carousel.css">
	<link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/skins/page/css/global.css">
	<link rel="shortcut icon" href="/favicon.ico">
	<script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
	<script src="https://www.youtube.com/player_api"></script>
	<script src="/components/jquery/dist/jquery.min.js"></script>
	<script src="/scripts/popper.min.js"></script>
	<script src="/components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/scripts/carousel/carousel.js"></script>
	<script src="/skins/page/js/main.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
	<header>
		<?= $this->_data['header']; ?>
	</header>
	<div><?= $this->_content ?></div>
	<footer>
		<?= $this->_data['footer']; ?>
	</footer>
	
</body>
</html>