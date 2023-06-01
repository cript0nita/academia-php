<HTML LANG="es">
	<HEAD>
		<TITLE>Insercion de matricula</TITLE>
		<!-- para que aparezcan caracteres especiales acentos y ñ-->
		<meta charset="UTF-8">
		
	</HEAD>
 	<BODY>
 
		<?php
		
		if (isset($_REQUEST['enviar']))
		{		
			//1º grupo - capturar los input de html y pasarlos a variables de php*/
			//print_r($_REQUEST); exit();

			$alumno_id = $_REQUEST['alumno_id'];
			$curso_id = $_REQUEST['curso_id'];
			$observaciones = $_REQUEST['observaciones'];
			
			
			/*comprobar errores */
			
			$errores = "";
			
			if (trim($alumno_id) == "")
				$errores = $errores .="<li>Se requiere identificacion</li>";
				
			if (trim($curso_id) == "")
				$errores = $errores .="<li>Se requiere identificacion</li>";
				
			if (trim($observaciones) == "")
				$errores = $errores .="<li>Se requiere rellenar campo</li>";
			


			//mostrar errores encontrados
			
			if ($errores != "")
			{
				print("<p> No se ha podido realizar la insercion debido a los siguientes errores</p>");
				print($errores);
			} else {
				//mostrar en pantalla los datos que se van a grabar
				
				print("<li> alumno_id: $alumno_id </li>");
				print("<li> curso_id: $curso_id </li>");
				print("<li> observaciones: $observaciones </li>");
				
				//conexion base de datos
				
				$conexion = mysqli_connect("localhost", "root", "","academia") or die ("problema de conexion");
				mysqli_set_charset ($conexion, 'utf8');
			
				$insercion = "INSERT INTO matricula (alumno_id, curso_id, observaciones) VALUES ('$alumno_id', '$curso_id', '$observaciones')";
				print ("<p> Insercion correcta</P>\n"); 
				print ("<P> [ <A HREF='matricula.php'> Insertar matricula </A> ] </P>\n");
				
			}
		} else { ?>
	
			<H1>Introduzca los datos de matricula</H1> 
			
			<FORM class="borde" ACTION="matricula.php" METHOD="POST" ENCTYPE=multipart/form-data">
			
				
				alumno_id <INPUT TYPE="text" NAME="alumno_id" VALUE="" SIZE="20"> </br></br>
		
				curso_id <INPUT TYPE="text" NAME="curso_id" VALUE="" SIZE="20"> </br></br>
				
				observaciones <INPUT TYPE="text" NAME="observaciones" VALUE="" SIZE="20"> </br></br>
		
				

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