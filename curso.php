<HTML LANG="es">
	<HEAD>
		<TITLE>Insercion de curso</TITLE>
		<!-- para que aparezcan caracteres especiales acentos y ñ-->
		<meta charset="UTF-8">
		
	</HEAD>
 	<BODY>
 
		<?php
		
		if (isset($_REQUEST['enviar']))
		{		
			//1º grupo - capturar los input de html y pasarlos a variables de php*/
			//print_r($_REQUEST); exit();

			$nombre = $_REQUEST['nombre'];
			$descripcion = $_REQUEST['descripcion'];
			$duracion = $_REQUEST['duracion'];
			$profesor_id = $_REQUEST['profesor_id'];
			
				
			/*comprobar errores */
			
			$errores = "";
			
			if (trim($nombre) == "")
				$errores = $errores .="<li>Se requiere denominacion curso</li>";
				
			if (trim($descripcion) == "")
				$errores = $errores .="<li>Se requiere descripcion</li>";
				
			if (trim($duracion) == "")
				$errores = $errores .="<li>Se requiere seleccion duracion</li>";
			
			if (trim($profesor_id) == "")
				$errores = $errores .="<li>introduzca docente</li>";

			//mostrar errores encontrados
			
			if ($errores != "")
			{
				print("<p> No se ha podido realizar la insercion debido a los siguientes errores</p>");
				print($errores);
			} else {
				//mostrar en pantalla los datos que se van a grabar
				
				print("<li> nombre: $nombre </li>");
				print("<li> descripcion: $descripcion </li>");
				print("<li> duracion: $duracion </li>");
				print("<li> profesor_id: $profesor_id </li>");
				//conexion base de datos
				
				$conexion = mysqli_connect("localhost", "root", "","academia") or die ("problema de conexion");
				mysqli_set_charset ($conexion, 'utf8');
			
				$insercion = "INSERT INTO curso (nombre, descripcion, duracion, profesor_id) VALUES ('$nombre', '$descripcion', '$duracion', '$profesor_id')";
				$consulta = mysqli_query ($conexion, $insercion) or die ("fallo al insertar");
				print ("<p> Insercion correcta</P>\n"); 
				print ("<P> [ <A HREF='curso.php'> Insertar curso </A> ] </P>\n");
				
			}
		} else { ?>
	
			<H1>Introduzca los datos del curso</H1> 
			
			<FORM class="borde" ACTION="curso.php" METHOD="POST" ENCTYPE=multipart/form-data">
			
				
				nombre <INPUT TYPE="text" NAME="nombre" VALUE="" SIZE="20"> </br></br>
				
				descripcion <INPUT TYPE="text" NAME="descripcion" VALUE="" SIZE="20"> </br></br>
		
				profesor <INPUT TYPE="text" NAME="profesor_id" VALUE="" SIZE="20"> </br></br>
		
				<INPUT TYPE="radio" NAME="duracion" VALUE="anual"> anual
				<INPUT TYPE="radio" NAME="duracion" VALUE="semestral"> semestral
				<INPUT TYPE="radio" NAME="duracion" VALUE="intensivo"> intensivo
				
				
		
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