<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();
if (isset($_SESSION['adm'])) {
ini_set('display_errors', 0);
#
if ($_POST['method'] == "DELETE") {
    if ($_POST['usr'] && $_POST['ou']) {
        
        $uid = $_POST['usr'];
        $unorg = $_POST['ou'];
        $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
        
        $opcions = [
            'host' => 'zend-sabelo.fjeclot.net',
            'username' => 'cn=admin,dc=fjeclot,dc=net',
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        
        $ldap = new Ldap($opcions);
        $ldap->bind();
        $isEsborrat = false;
        try {
            if ($ldap->delete($dn)) echo "<b>Esborrat Correctament</b><br>";
        } catch (Exception $e) {
            echo "<b>No existeix</b><br>";
        }
    }
} 
}
?>
<html>
<style>.noMostrar{display:none;}</style>
    <body>
    <h1>ELIMINA USUARI</h1>
    	<form action="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/elimina.php" method="POST">
			<input type="text" name="method" value="DELETE" class="noMostrar"><br><br>
			Identificador <input type="text" name="usr"><br>
			Unitat Organitzativa <input type="text" name="ou"><br>
			<input type="submit" value="Envia" />
    	</form>
    	<a href="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/menu.php">Menú usuari</a><br>
    </body>
</html>