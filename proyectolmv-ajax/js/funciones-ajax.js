$(document).ready(function(){

	Vista();

	function Vista(){

		let op = "Vista";

		$.ajax({

			url:'procesos.php',
			method: 'POST',
			data:{action: op},

			success:function(data){
				$('#resultado').html(data);

				$("#tbVista").DataTable();
			}

		});

	}

	$('#btnModal').click(function(){

		$('#formulario-modal').modal('show');
		$('.modal-title').text('Formulario Nuevo Registro');

		$('#txtDni').val('');
		$('#txtNom').val('');
		$('#txtApe').val('');
		$('#txtFnac').val('');
		$('#txtEdad').val('');
		$('#txtEmail').val('');

		$('#btnAction').text('Enviar');
		$('#btnAction').val('Insertar');

	});

	$('#btnAction').click(function(){

		let dni = $('#txtDni').val();
		let nom = $('#txtNom').val();
		let ape = $('#txtApe').val();
		let fnac = $('#txtFnac').val();
		let edad = $('#txtEdad').val();
		let email = $('#txtEmail').val();

		let op = $('#btnAction').val();

		$.ajax({

			url:"procesos.php",
			method:"POST",
			data:{action: op, Dni:dni, Nom:nom, Ape:ape, Fnac:fnac, Edad:edad, Email:email},

			success:function(data){
				$('#formulario-modal').modal('hide');
				alert(data);
				Vista();
			}
		});

	});


	$(document).on('click', '.update', function(){

		let dni = $(this).attr('id');
		let op = "Buscar";

		$.ajax({

			url:"procesos.php",
			method:"POST",
			data:{action: op, Dni:dni},
			dataType: "json",

			success:function(data){
				$('#formulario-modal').modal('show');
				$('.modal-title').text('Formulario Actualizar Registro');

				$('#txtDni').val(data.Dni);
				$('#txtNom').val(data.Nombre);
				$('#txtApe').val(data.Apellidos);
				$('#txtFnac').val(data.FechaNacimiento);
				$('#txtEdad').val(data.Edad);
				$('#txtEmail').val(data.Email);

				$('#btnAction').text('Actualizar');
				$('#btnAction').val('Actualizar');
			}

		})


	});


	$(document).on('click', '.delete', function(){

		let dni = $(this).attr('id');

		if (confirm('Esta seguro que desea eliminar el registro?')) {

			let op = "Eliminar";

			$.ajax({

				url:"procesos.php",
				method:"POST",
				data:{action: op, Dni:dni},

				success:function(data){
					Vista();
					alert(data)
				}

			})

		}

	});


});


