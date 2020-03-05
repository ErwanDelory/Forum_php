<?php 

require_once './frontend/layout.php';

require_once 'backend/auth.php';

login();

head(); 

?>

 <div class="container">
    <form action="" method="post">
      <br/>
      <h2>Veuillez vous authentifier :</h2>
      <table>
      <tr>
        <td><label>Entrez votre nom : </label></td>
        <td><input type="text" name="username" required /></td>
      </tr>
      <tr>
        <td><label>Entrez votre mot de passe : </label></td>
        <td><input type="password" name="password" required /></td>
      </tr>
      <tr><td> </td></tr>
      <tr><td colspan="2"><input type="submit" value="Se connecter"></td></tr>
      </table>
    </form>
</div>



<?php
foot();
?>