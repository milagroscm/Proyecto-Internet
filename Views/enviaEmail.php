<?php 
include("../Models/modelo_usuario.php"); 

function Conectarse()  
{  
   if (!($link=mysql_connect("localhost","usuario","password")))  
   {  
      echo "Error conectando a la base de datos.";  
      exit();  
   }  
   if (!mysql_select_db("mi_base",$link))  
   {  
      echo "Error seleccionando la base de datos.";  
      exit();  
   }  
   return $link;  
}  

?> 
<p> 
<table width="80%"  border="0" align="center"> 
    <tr> 
      <td colspan="2"> 
<? 
$email = @$HTTP_GET_VARS["email"]; 
$link=Conectarse();  

$result=mysql_query("select nombres, apellidos, correo, usuario, contrasena from personas WHERE correo = '$email'",$link); 

if (!$result) { 
      echo("<p>Error al seleccionar tabla: " . mysql_error() . "</p>"); 
      exit(); 
    } 

//Chekeamos si existe el email 
$sql_check_num = mysql_num_rows($result); 
if($sql_check_num == 0){ 
     
echo "<table width='467'><tr><td><font color=ff0000 face=verdana>El e-mail <b >$email</b> no fue encontrado en nuestra base de datos</font></br><center></table><p>"; 
?> 

<form action="lostpassword.php" method="get" name="datos" id="datos"> 
  <table width="50%"  border="0" align="center"> 
    <tr> 
      <td colspan="2" class="Texto">A continuaci&oacute;n escriba su direcci&oacute;n de correo electr&oacute;nico a la cual llegar&aacute; su login y password de nuevo. </td> 
    </tr> 
    <tr> 
      <td width="10%">&nbsp;</td> 
      <td width="90%">&nbsp;</td> 
    </tr> 
    <tr> 
      <td class="Texto">Email:</td> 
      <td><input name="email" type="text" id="email"></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td>&nbsp;</td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td><input type="submit" name="Submit" value="Enviar"></td> 
    </tr> 
  </table> 
</form> 
<? 
exit(); 
} 

// Si va todo bien sacamos todo de la base de datos 
    while ( $row = mysql_fetch_array($result) ) { 
      $correo = $row["correo"]; 
      $contrasena = $row ["contrasena"]; 
      $nombres = $row ["nombres"]; 
      $apellidos = $row ["apellidos"]; 
      $usuario = $row ["usuario"]; 
} 

// creamos el email  
$denombre="Administrador del Sistema"; 
$deemail="admin@sistema.com"; 
$sfrom="admin@sistema.com"; //cuenta que envia 
$sBCC="admin@sistema.com"; //me envio una copia oculta 
$sdestinatario="$correo"; //cuenta destino 
$ssubject="Datos de su cuenta en el Sistema"; //subject 
$shtml="Estimado $nombres $apellidos la presente es para comunicarle su Login y Password para ingresar al Sistema después de haber extraviado el método de acceso:<br><p>Ud esta registrado en nuestro sistema con los siguientes datos:<p>Nombres: $nombres<br>Apellidos: $apellidos<br>  Email: $correo</p><p>El login y password para entrar correctamente al sistema son los siguientes:<p>Login: $usuario<br>Password: $contrasena<br></p><p>Recuerde guardar este correo en un lugar seguro dentro de sus archivos personales.</p><p>Para ingresar al Sistema lo puede hacer por los momentos en:</p><p><a href='http://www.sistema.com'>[url]http://www.sistema.com[/url]</a></p>Atte:<br></p><p>Andinistas<br><a href='mailto:admin@sistema.com'>admin@sistema.com</a><br>Webmaster del Sistema</p>"; 
$encabezados  = "MIME-Version: 1.0\n"; 
$encabezados .= "Content-type: text/html; charset=iso-8859-1\n"; 
$encabezados .= "From: $denombre <$deemail>\n"; 
$encabezados .= "X-Sender: <$sfrom>\n"; 
$encabezados .= "BCC: <$sBCC>\n"; 
$encabezados .= "X-Mailer: PHP\n"; 
$encabezados .= "X-Priority: 1\n";  
$encabezados .= "Return-Path: <$sfrom>\n"; 
mail($sdestinatario,$ssubject,$shtml,$encabezados); 

//le decimos al usuario que fue enviado su password  
//y que vaya rapido a revisar su correo electronico 

echo  ("<table width='467'><tr><td class='texto'>El Login y password de tu cuenta ha sido enviado al siguiente correo: $email</a></td><tr></table>"); 

?> 
<p><br><p><br><p><br><p><center><a href='javascript:window.close();'><IMG SRC='images/cerrar.gif' BORDER='0' ALT='CERRAR'></a></center><p></table> 
<? 
include("include/pie.php"); 
?>