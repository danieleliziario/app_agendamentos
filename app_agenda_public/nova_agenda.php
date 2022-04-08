<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Agendamentos</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Agendamentos
				</a>
			</div>
		</nav>
		<?php if(isset($_GET['inclusao']) && $_GET['inclusao']== 1){?>
			<div class="bg-success pt-2 text-white d-flex justify-content-center">
				<h5>Agendado com sucesso</h5>
			</div>
		<?php } ?>
		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Agendamentos pendentes</a></li>
						<li class="list-group-item active"><a href="#">Novo Agendamento</a></li>
						<li class="list-group-item"><a href="todas_agendas.php">Todos Agendamentos</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Novo Agendamento</h4>
								<hr />

								<form method="post" action="agenda_controller.php?acao=inserir">
									<div class="form-group">
										<label>Data Inicial:
											<input name="data_inicial" type="date" class="form-control" >
										</label>
										<label>Data Final:
											<input name="data_final" type="date" class="form-control" >
										</label>
										<label>Titulo:
											<input name="titulo" type="text" class="form-control" placeholder="Exemplo: Vendas">
										</label>
										<label>Cliente:
											<input name="cliente" type="text" class="form-control" placeholder="Exemplo: Daniel">
										</label>
										<label>Descrição:
											<textarea name="descricao" class="form-control" placeholder="Exemplo: Vendas dos produtos da empresa"></textarea>
										</label>
										
									</div>

									<button class="btn btn-success">Cadastrar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>