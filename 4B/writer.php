<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>

	<title>Dumb Library</title>
</head>
<body>
	<nav class="navbar fixed-top navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Dumb Library</a>
			<ul class="nav">
				<li class="nav-item">
					<a role="button" class="btn btn-sm btn-primary mr-2" style="width:110px;">Add Book</a>
				</li>
				<li class="nav-item">
					<a role="button" class="btn btn-sm btn-primary mr-2" style="width:110px";>Add Writer</a>
				</li>
				<li class="nav-item">
					<a role="button" class="btn btn-sm btn-primary" style="width:110px;">Add Category</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container" style="margin-top: 70px;">
		<div class="row ct-lib">
			<table>
				<thead>
					<th style="width: 40px">id</th>
					<th style="width: 160px">name</th>
					<th>action</th>
				</thead>
				<tbody id="table_content">
					
				</tbody>
			</table>
		</div>
	</div>

	<div class="modal" tabindex="-1" id="md_cud">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><strong><span id="md_func"></span></strong> Writer</h5>
				</div>
				<div class="modal-body">
					<label>writer name</label>&nbsp;
					<input type="text" id="md_name">
				</div>
				<div class="modal-footer">
					<a role="button" class="btn btn-primary btn-submitt" style="width: 100px;"></a>
					<a role="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px;">Cancel</a>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			var html = '<tr><td colspan="3"><a role="button" class="btn btn-outline-success btn-add mt-2">Add Writer</a></td></tr>'
			$('#table_content').html(html);
			writer_get();
			function writer_get() {
				var html = "";
				$.ajax({
					type 		: 'POST',
					url 		: 'svs.php',
					data 		: {function:'writer_get'},
					dataType	: 'JSON',
					success 	: function(data){
						for (var i = 0; i < data.length; i++) {
							html 	+='<tr>'
									+ '<td>'+data[i].id+'</td>'
									+ '<td>'+data[i].name+'</td>'
									+ '<td>'
									+ '<a role="button" class="btn btn-outline-primary btn-sm btn-upd mr-1" style="width: 100px;" data-id="'+data[i].id+'" data-name="'+data[i].name+'">Update</a>'
									+ '<a role="button" class="btn btn-outline-danger btn-sm btn-del" style="width: 100px;" data-id="'+data[i].id+'" data-name="'+data[i].name+'">Delete</a>'
									+ '</td>'
									+ '</tr>';
						}
						html += '<tr><td colspan="3"><a role="button" class="btn btn-outline-success btn-add mt-2">Add Writer</a></td></tr>'
						$('#table_content').html(html);
					}
				});
			}

			$(document).on('click', '.btn-add', function() {
				var funcname	= "Add";
				md_init(funcname);
			});

			$(document).on('click', '.btn-upd', function() {
				var funcname	= "Update";
				var id 			= $(this).data('id');
				var name 		= $(this).data('name');
				md_init(funcname, id, name);
			});

			$(document).on('click', '.btn-del', function() {
				var funcname	= "Delete";
				var id 			= $(this).data('id');
				var name 		= $(this).data('name');
				md_init(funcname, id, name, true);
			});

			function md_init(funcname, id=null, name=null, readonly=false) {
				$('#md_func').text(funcname);
				$('.btn-submitt').data('funcname', funcname);
				$('.btn-submitt').data('id', id);
				$('#md_name').val(name);
				$('.btn-submitt').text(funcname);
				$('#md_name').prop('readonly', readonly);
				$('#md_cud').modal('show');
			}

			$('.btn-submitt').click(function() {
				// var html = '<tr><td colspan="3"><a role="button" class="btn btn-outline-success btn-add mt-2">Add Writer</a></td></tr>'
				// $('#table_content').html(html);
				var funcname	= $(this).data('funcname');
				var name 		= $('#md_name').val();
				var id;
				switch(funcname) {
					case "Add":
						data 	= {function:'writer_insert', name:name};
						break;
					case "Update":
						id 		= $(this).data('id');
						data 	= {function:'writer_update', id:id, name:name};
						break;
					case "Delete":
						id 		= $(this).data('id');
						data 	= {function:'writer_delete', id:id};
						break;
				}
				$.ajax({
					type 		: 'POST',
					url 		: 'svs.php',
					data 		: data,
					dataType	: 'JSON',
					success 	: function(data){
						$('#md_cud').modal('hide');
					}
				});
				setTimeout(writer_get(), 1000);
			});
		});
	</script>
</body>
</html>
