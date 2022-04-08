<?php 

//CRUD
class AgendaService{
	private $conexao;
	private $agenda;

	public function __construct(Conexao $conexao, Agenda $agenda){
		$this->conexao = $conexao->conectar();
		$this->agenda = $agenda;
	}
	public function inserir(){//create
		$query = 'insert into tb_agendamentos(data_inicial, data_final, titulo, descricao, cliente)values(:data_inicial,:data_final, :titulo, :descricao, :cliente)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicial', $this->agenda->__get('data_inicial'));
		$stmt->bindValue(':data_final', $this->agenda->__get('data_final'));
		$stmt->bindValue(':titulo', $this->agenda->__get('titulo'));
		$stmt->bindValue(':descricao', $this->agenda->__get('descricao'));
		$stmt->bindValue(':cliente', $this->agenda->__get('cliente'));
		$stmt->execute();
	}
	public function recuperar(){//read
		$query = '
				select 
					a.id, s.status, a.data_inicial, a.data_inicial, a.data_final, a.titulo, a.descricao, a.cliente
				from 
					tb_agendamentos as a
					left join tb_status as s on (a.id_status = s.id);
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar(){//update
		
		$query = "update tb_agendamentos set data_inicial = ?, data_final = ?, titulo = ? , cliente = ?, descricao = ?  where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->agenda->__get('data_inicial'));
		$stmt->bindValue(2, $this->agenda->__get('data_final'));
		$stmt->bindValue(3, $this->agenda->__get('titulo'));
		$stmt->bindValue(4, $this->agenda->__get('cliente'));
		$stmt->bindValue(5, $this->agenda->__get('descricao'));
		$stmt->bindValue(6, $this->agenda->__get('id'));
		$this->agenda->__set('id_status', 1);
		return $stmt->execute();
	}

	public function remover(){//delete

		$query = 'delete from tb_agendamentos where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->agenda->__get('id'));
		$stmt->execute();
	}

	public function marcarRealizada(){//marcar Realizada
		
		$query = "update tb_agendamentos set id_status = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->agenda->__get('id_status'));
		$stmt->bindValue(2, $this->agenda->__get('id'));
		return $stmt->execute();
	}
}

?>