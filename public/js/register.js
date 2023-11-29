//VALIDACIONES DE CAMPOS
$(document).ready(function(){
	
	$('#btn-register').click(function(){
		nombre 		= $('#nombre').val();
		apellido 	= $('#apellido').val();
		user 		= $('#user').val();
		servicio 	= $('select#servicio').val();
		type_users 	= $('select#type_users').val();
		$.ajax({
		      type:'POST',
		      url:'?view=usuarios&mode=registro',
		      dataType: "json",
		      data:{nombre: nombre, apellido: apellido, user: user, servicio: servicio, type_users:type_users},
		      success:function(datos){
		        if(datos.response == 'true'){
		          alert('REGISTRO EXITOSO');
		          $(location).attr('href','?view=usuarios&mode=index');
		        }
		        else{
		          alert('El usuario ya existe...');
		        }
		      }
		})
	});


	$('#update').click(function(){
		userid		=	$('#userid').val();
		nombre		=	$('#nombre').val();
		apellido	=	$('#apellido').val();
		rol			=	$('#rol').val();
		status		=	$('#status').val();
		servicio 	= 	$('#servicio').val();

		$.ajax({
		      type:'POST',
		      url:'?view=usuarios&mode=update',
		      dataType: "json",
		      data:{userid: userid, nombre: nombre, apellido: apellido, rol: rol, status: status, servicio: servicio},
		      success:function(datos){
		        if(datos.response == 'true'){
		          alert('USUARIO ACTUALIZADO');
		          $(location).attr('href','?view=usuarios&mode=index');
		        }
		        else{
		          alert('ERROR');
		        }
		      }
		})
	});

	$('#password').click(function(){
		userid	=  $('#userid').val();
		$.ajax({
		      type:'POST',
		      url:'?view=usuarios&mode=password',
		      dataType: "json",
		      data:{userid: userid},
		      success:function(datos){
		        if(datos.response == 'true'){
		          alert('PASSWORD ACTUALIZADO DEBE INGRESAR \nCON LA CLAVE 123456');
		          $(location).attr('href','?view=usuarios&mode=index');
		        }
		        else{
		          alert('ERROR');
		        }
		      }
		})
	});

	$('#btn-update').click(function(){
		userid	=  	$('#userid').val();
		passwd 	=	$('#password_').val();
		$.ajax({
		      type:'POST',
		      url:'?view=usuarios&mode=password_',
		      dataType: "json",
		      data:{userid: userid, password: passwd},
		      success:function(datos){
		        if(datos.response == 'true'){
		          alert('PASSWORD ACTUALIZADO');
		          $(location).attr('href','?view=usuarios&mode=index');
		        }
		        else{
		          alert('ERROR');
		        }
		      }
		})
	});

})
