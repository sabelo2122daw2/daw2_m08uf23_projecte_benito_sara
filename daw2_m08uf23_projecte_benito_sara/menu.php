<?php 
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();
if (isset($_SESSION['adm'])) {
ini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-sabelo.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn"){
            echo $atribut.": ".$dada[0].'<br>';
    }
    }
}
}
?>
<html>
	<head>
		<title>
			Visualització de totes les dades d'un usuari
		</title>
	</head>
	<body>
		<h1>Visualització de totes les dades d'un usuari</h1>
		<form action="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/menu.php" method="GET">
		Identificador: <input type="text" name="usr"><br>
		Unitat organitzativa: <input type="text" name="ou"><br>
		<input type="submit" value="Envia" />
		</form>

		<a href="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/afegeix.php">Afegir usuari</a><br>
		<a href="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/elimina.php">Esborrar usuari</a><br>
		<a href="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/modificar.php">Modificar usuari</a>
	</body>
</html>