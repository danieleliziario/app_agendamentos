<?php
	$acao = 'recuperar';
	require 'agenda_controller.php';
	// echo '<pre>';
	// print_r($agendas);
	// echo '</pre>';
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Agendamentos</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<!-- Bootstrap início -->
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> -->

	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	    <!-- Bootstrap fim -->

		<style>
			span.negrito{
				font-weight: bold;
			}
			.marginAgendamento{
				margin-bottom: 10px;
			}
		</style>
		<script>
			function editar(id, data_inicial, data_final, descricao, titulo, cliente){
				// console.log(txt_tarefa);
				let teste = `<form method="post" action="agenda_controller.php?acao=atualizar">
									<div class="form-group">
										<label>Data Inicial:
											<input name="data_inicial" type="date" class="form-control" value=${data_inicial}>
										</label>
										<label>Data Final:
											<input name="data_final" type="date" class="form-control" value=${data_final}>
										</label>
										<label>Titulo:
											<input name="titulo" type="text" class="form-control" value=${titulo}>
										</label>
										<label>Cliente:
											<input name="cliente" type="text" class="form-control" value=${cliente}>
										</label>
										<label>Descricão:
											<textarea name="descricao" class="form-control" value=${descricao}></textarea>
										</label>
										<input type="hidden" name="id" value="${id}">
										<button type="submit" class="btn btn-info col-3">Atualizar</button>
										
									</div>

								`

				

				let agenda= document.getElementById('agenda_'+id);

				agenda.innerHTML = '';
				agenda.innerHTML += teste;
				// alert(txt_tarefa);
			}
			let testeid = null
			function avisoRemover(id){
				testeid = id;
				$('#modal').modal('show');
			}

			function remover(){
				location.href = 'todas_agendas.php?acao=remover&id='+testeid;
			}

			function marcarRealizada(id){
				location.href = 'todas_agendas.php?acao=marcarRealizada&id='+id;
			}
		</script>
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

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Agendamentos pendentes</a></li>
						<li class="list-group-item"><a href="nova_agenda.php">Novo Agendamento</a></li>
						<li class="list-group-item active"><a href="#">Todos Agendamentos</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todos Agendamentos</h4>
								<hr />

								<?php foreach($agendas as $ind => $agenda){ ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
										<div class="col-sm-9 row" id="agenda_<?=$agenda->id?>">
											<div class="col-5">
												<div class="marginAgendamento">
													<?php $data = explode('-', $agenda->data_inicial)?>
													<span class="negrito">Data Início:</span> <?=$data[2].'/'.$data[1].'/'.$data[0]?>
												</div>
											</div>
											<div class="col-5">
												<div class="marginAgendamento">
													<?php $data = explode('-', $agenda->data_final)?>
													<span class="negrito">Data Final: </span><?=$data[2].'/'.$data[1].'/'.$data[0]?>
												</div>
											</div>
											<div class="col-2">
												<span class="negrito">(<?=$agenda->status?>)</span>
											</div>
											<div class="col-6">
												<div class="marginAgendamento">
													<span class="negrito">Cliente:</span> <?=$agenda->cliente?> 
												</div>
											</div>
											<div class="col-6">
												<div class="marginAgendamento">
													<span class="negrito">Titulo:</span> <?=$agenda->titulo?>
												</div>
											</div>
											<div class="col-12">
												<div class="marginAgendamento">
													<span class="negrito">Descricão:</span> <?=$agenda->descricao?>
												</div>
											</div>
											
											
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="avisoRemover(<?=$agenda->id?>)"></i>
											<?php if($agenda->status == 'pendente'){ ?>
											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?=$agenda->id?>,'<?=$agenda->data_inicial?>','<?=$agenda->data_final?>','<?=$agenda->descricao?>','<?=$agenda->titulo?>', '<?=$agenda->cliente?>' )"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?=$agenda->id?>)"></i>
											<?php } ?>
										</div>
									</div>
									<hr>
								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal" tabindex="-1" role="dialog" id="modal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header text-danger">
		        <h5 class="modal-title">Exclusão de Agendamento</h5>
		      </div>
		      <div class="modal-body">
		        <p>O Agendamento Será Excluído Permanente </p>
		      </div>
		      <div class="modal-footer">
		      	 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-danger" onclick="remover()">Excluir</button>
		      </div>
		    </div>
		  </div>
		</div>
	</body>
</html>