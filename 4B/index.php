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
					<a role="button" class="btn btn-sm btn-primary mr-2" href="./index.php" style="width:110px;">Add Book</a>
				</li>
				<li class="nav-item">
					<a role="button" class="btn btn-sm btn-primary mr-2" href="./writer.php" style="width:110px";>Add Writer</a>
				</li>
				<li class="nav-item">
					<a role="button" class="btn btn-sm btn-primary" href="./category.php" style="width:110px;">Add Category</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container" style="margin-top: 70px;">
		<div class="row ct-lib">
			

		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			book_get();
			function book_get() {
				var html = "";
				$.ajax({
					type 		: 'POST',
					url 		: 'svs.php',
					data 		: {function:'book_get'},
					dataType	: 'JSON',
					success 	: function(data){
						console.log(data);
						for (var i = 0; i < data.length; i++) {
							html 	+='<div class="col-md-3 mb-2">'
									+ '<div class="card shadow-sm">'
									+ '<img class="card-img-top" width="100%" height="225" src="data:image/png;base64, '+data[i].img+'" focusable="false">'
									+ '<div class="card-body">'
									+ '<p class="card-text mb-0 text-truncate"><strong>'+data[i].name+'</strong></p>'
									+ '<div class="d-flex justify-content-between align-items-center mb-2">'
									+ '<small>'+data[i].year+'</small>'
									+ '<small>'+data[i].writer+'</small>'
									+ '</div>'
									+ '<a role="button" class="btn btn-block btn-sm btn-primary" data-id="'+data[i].id+'" data-name="'+data[i].name+'" data-year="'+data[i].year+'" data-writer="'+data[i].writer+'" data-category="'+data[i].category+'">View Detail</a>'
									+ '</div>'
									+ '</div>'
									+ '</div>';
						}
						$('.ct-lib').html(html);
					}
				});
			}
		});
	</script>
</body>
</html>
