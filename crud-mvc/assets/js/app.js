
class UserApp {
	//show all details
	show(btn) {

		const id		= btn.id;
		const data	= {"id" : id}

		$.ajax({
			url: '/crud-mvc/users/show',
			type: 'POST',
			dataType: 'JSON',
			data: data,
			success:function(response){
				$('#first_name').val(response.first_name);
				$('#last_name').val(response.last_name);
				$('#email').val(response.email);
				$('#id').val(id);
				$('#edit_mode').val('1');
				$('#modalUserForm').modal('show');
			},error: function(error) {
				console.warn('error ' + error);
				$('#modalUserForm .alert-danger p').text('Error trying load');
				$('#modalUserForm .alert-danger').show();
			}
		});
	}

	confirm(btn) {

		const id = btn.id;

		$('#modalDelUser').modal('show');
		$('#id_del').val(id);
	}

	reloadGrid() {

		$.ajax({
			url: '/crud-mvc/users/load',
			type: 'POST',
			dataType: 'html',
			data: {},
			success:function(response){
				if (response !== '') {
					$("#grid_container").html(response);
					$('#users_grid').DataTable();
				}
			},error: function(error){
				console.warn('error loading data');
			}
		});
	}

	save(btn) {
		//save form
		const form = $("#userForm").serializeArray();

		if ($.trim($('#first_name').val()) === ''
			|| $.trim($('#last_name').val()) === ''
			|| $.trim($('#email').val()) === ''
		) {
			$('#modalUserForm .alert-danger p').text('All fields required');
			$('#modalUserForm .alert-danger').show();
		} else {

			const action = $('#edit_mode').val() === '1' ? '/edit' : '/add';

			$.ajax({
				url: '/crud-mvc/users' + action,		// url to save
				type: 'POST',
				dataType: 'JSON',
				data: form,
				success:function(response){
					if (response.success) {
						$('#id').val('');
						$('#edit_mode').val('0');
						$("#modalUserForm").modal('hide');
						User.reloadGrid();
					}
				}
			});
		}
	}

	delete(btn) {
	//delete user
		const data	= {'id' : $('#id_del').val()};

		$.ajax({
			url: '/crud-mvc/users/delete', 				// url to delete
			type: 'POST',
			dataType: 'JSON',
			data: data,
			success:function(response){
				if (response.success) {
					User.reloadGrid();
					$("#modalDelUser").modal('hide');
				}
			}
		});
	}

}

const User = new UserApp();		// create instance of current class as user

$('.modal').on('hidden.bs.modal', function(e){
	$(this).find('form').trigger('reset');
	$(this).find('.alert').hide();
}) ;

$('#users-page').ready(function() {
  $('#users_grid').DataTable();
} );
