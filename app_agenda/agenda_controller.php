<?php
	require "../../app_agenda/agenda.model.php";
	require "../../app_agenda/agenda.service.php";
	require "../../app_agenda/conexao.php";
	
	// echo '<pre>';
	// print_r($_POST);
	// echo '</pre>';
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;


	if($acao == 'inserir'){
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		$agenda = new Agenda();
		$agenda->__set('data_inicial', $_POST['data_inicial']);
		$agenda->__set('data_final', $_POST['data_final']);
		$agenda->__set('titulo', $_POST['titulo']);
		$agenda->__set('descricao', $_POST['descricao']);
		$agenda->__set('cliente', $_POST['cliente']);

		$conexao = new Conexao();

		$agendaService = new AgendaService($conexao, $agenda);
		$agendaService->inserir();

		header('Location: nova_agenda.php?inclusao=1');
	}
	else if($acao == 'recuperar'){
		$agenda = new Agenda();
		$conexao = new Conexao();

		$agendaService = new AgendaService($conexao, $agenda);
		$agendas = $agendaService->recuperar();
		
	}
	else if($acao == 'atualizar'){
		$agenda = new Agenda();
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		$agenda->__set('id', $_POST['id']);
		$agenda->__set('data_inicial', $_POST['data_inicial']);
		$agenda->__set('data_final', $_POST['data_final']);
		$agenda->__set('descricao', $_POST['descricao']);
		$agenda->__set('titulo', $_POST['titulo']);
		$agenda->__set('cliente', $_POST['cliente']);

		$conexao = new Conexao();

		$agendaService = new AgendaService($conexao, $agenda);
		// echo $agendaService->atualizar();
		if($agendaService->atualizar()){
			if(isset($_GET['pag']) && $_GET['pag'] == 'pen'){
				header('Location: index.php');
			}else{
				header('Location: todas_agendas.php');
			}
		}


	}
	else if($acao == 'remover'){
		$agenda = new Agenda();
		$agenda->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$agendaService = new AgendaService($conexao, $agenda);
		$agendaService->remover();
		if(isset($_GET['pag']) && $_GET['pag'] == 'pen'){
			header('Location: index.php');
		}else{
			header('Location: todas_agendas.php');
		}
	}
	else if($acao == 'marcarRealizada'){
		$agenda =  new Agenda();
		$agenda->__set('id', $_GET['id']);
		$agenda->__set('id_status', 2);
		$conexao = new Conexao();
		$agendaService = new AgendaService($conexao, $agenda);
		$agendaService->marcarRealizada();
		if(isset($_GET['pag']) && $_GET['pag'] == 'pen'){
			header('Location: index.php');
		}else{
			header('Location: todas_agendas.php');
		}
	}

	
	// echo '<pre>';
	// print_r($tarefaService);
	// echo '</pre>';
?>