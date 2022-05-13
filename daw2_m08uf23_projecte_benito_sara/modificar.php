<?php
require 'vendor/autoload.php';

use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

session_start();
if (isset($_SESSION['adm'])) {

ini_set('display_errors', 0);
if ($_POST['method'] == "PUT") {
    if ($_POST['uid'] && $_POST['unorg'] && $_POST['radioValue'] && $_POST['nouContingut']) {
        
        $atribut = $_POST['radioValue'];
        $nou_contingut = $_POST['nouContingut'];
        
        $uid = $_POST['uid'];
        $ou = $_POST['unorg'];
        $dn = 'uid=' . $uid . ',ou=' . $ou . ',dc=fjeclot,dc=net';
        
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
        $entrada = $ldap->getEntry($dn);
        if ($entrada) {
            Attribute::setAttribute($entrada, $atribut, $nou_contingut);
            $isModificat = true;
            $ldap->update($dn, $entrada);
            echo "Atribut modificat correctament<br />";
        } else {
            echo "<b>Aquesta entrada no existeix</b><br />";
        }
    }
}
}

?>
<html>
<style>.amaga{display:none;}</style>
    <h1>MODIFICAR UN USUARI</h1>
    <form action="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/modificar.php" method="POST" autocomplete="off">
      <input type="text" name="method" value="PUT" class="amaga">
      <input type="text" name="uid" placeholder="Identificador" required /><br>
      <input type="text" name="unorg" placeholder="Unitat Organitzativa" required /><br><br>
      <input type="radio" name="radioValue" value="uidNumber" />uidNumber<br>
      <input type="radio" name="radioValue" value="gidNumber" />gidNumber<br>
      <input type="radio" name="radioValue" value="homeDirectory" />homeDirectory<br>
      <input type="radio" name="radioValue" value="loginShell" />loginShell<br>
      <input type="radio" name="radioValue" value="cn" />cn<br>
      <input type="radio" name="radioValue" value="sn" />sn<br>
      <input type="radio" name="radioValue" value="givenName" />givenName<br>
      <input type="radio" name="radioValue" value="postalAddress" />postalAddress<br>
      <input type="radio" name="radioValue" value="mobile" />mobile<br>
      <input type="radio" name="radioValue" value="telephoneNumber" />telephoneNumber<br>
      <input type="radio" name="radioValue" value="title" />title<br>
      <input type="radio" name="radioValue" value="description" />description<br><br>
       <input type="text" name="nouContingut" placeholder="Introduce el nuevo contenido" required /><br>
       <input type="submit" class="button" value="Modificar Usuari" /><br>
      </form>
      <a href="http://zend-sabelo.fjeclot.net/daw2_m08uf23_projecte_benito_sara/menu.php">Menu usuari</a><br>
</html>