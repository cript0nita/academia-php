<HTML LANG="es">
	<HEAD>
		<TITLE>Insercion de profesor</TITLE>
		<!-- para que aparezcan caracteres especiales acentos y ñ-->
		<meta charset="UTF-8">
		
	</HEAD>
 	<BODY>
 
		<?php
		
		if (isset($_REQUEST['enviar']))
		{		
			//1º grupo - capturar los input de html y pasarlos a variables de php*/
			//print_r($_REQUEST); exit();

			$dni = $_REQUEST['dni'];
			$nombre = $_REQUEST['nombre'];
			$apellidos = $_REQUEST['apellidos'];
			$telefono = $_REQUEST['telefono'];
			
			if (isset($_REQUEST['idioma'])) {
				// Une elementos de un array en un string ["ingles", "frances"] => "ingles,frances"
				// https://www.php.net/manual/es/function.implode.php
				$idioma = implode(",", $_REQUEST['idioma']);
			} else {
				$idioma = "";
			}
			
			/*comprobar errores */
			
			$errores = "";
			
			if (trim($dni) == "")
				$errores = $errores .="<li>Se requiere dni</li>";
				
			if (trim($nombre) == "")
				$errores = $errores .="<li>Se requiere identificacion</li>";
				
			if (trim($apellidos) == "")
				$errores = $errores .="<li>Se requiere apellidos</li>";
			
			if (trim($telefono) == "")
				$errores = $errores .="<li>Se requiere telefono</li>";


			//mostrar errores encontrados
			
			if ($errores != "")
			{
				print("<p> No se ha podido realizar la insercion debido a los siguientes errores</p>");
				print($errores);
			} else {
				//mostrar en pantalla los datos que se van a grabar
				
				print("<li> dni: $dni </li>");
				print("<li> nombre: $nombre </li>");
				print("<li> apellidos: $apellidos </li>");
				print("<li> telefono: $telefono </li>");
				print("<li> idioma: $idioma </li>");
				//conexion base de datos
				
				$conexion = mysqli_connect("localhost", "root", "","academia") or die ("problema de conexion");
				mysqli_set_charset ($conexion, 'utf8');
			
				$insercion = "INSERT INTO profesor (dni, nombre, apellidos, telefono, idioma) VALUES ('$dni', '$nombre', '$apellidos', '$telefono', '$idioma')";
				$consulta = mysqli_query ($conexion, $insercion) or die ("fallo al insertar");
				print ("<p> Insercion correcta</P>\n"); 
				print ("<P> [ <A HREF='profesor.php'> Insertar profesor </A> ] </P>\n");
				
			}
		} else { ?>
	
			<H1>Introduzca los datos de profesor</H1> 
			
			<FORM class="borde" ACTION="profesor.php" METHOD="POST" ENCTYPE=multipart/form-data">
			
				
				dni <INPUT TYPE="text" NAME="dni" VALUE="" SIZE="20"> </br></br>
		
				nombre <INPUT TYPE="text" NAME="nombre" VALUE="" SIZE="20"> </br></br>
				
				apellidos <INPUT TYPE="text" NAME="apellidos" VALUE="" SIZE="20"> </br></br>
		
				telefono <INPUT TYPE="text" NAME="telefono" VALUE="" SIZE="20"> </br></br>
				<H3>idiomas</H3>
	
				<INPUT TYPE="checkbox" NAME="idioma[]" VALUE="ingles" CHECKED> ingles
				<INPUT TYPE="checkbox" NAME="idioma[]" VALUE="frances"> frances
				<INPUT TYPE="checkbox" NAME="idioma[]" VALUE="español"> español

				<H3><INPUT TYPE="submit" NAME="enviar" VALUE="insertar"></H3>
			
			</FORM>
		<?php } ?>

		<H4>
			<a href="index.html"> Menú principal </a> &nbsp
			<a href="profesor.php"> Insertar profesor </a> &nbsp
			<a href="alumno.php"> Insertar alumno </a> &nbsp
			<a href="curso.php"> Insertar curso </a> &nbsp
			<a href="matricula.php"> Matricula </a> &nbsp
		</H4>
		
	</BODY>

</HTML>