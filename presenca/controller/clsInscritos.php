<?php

class Inscritos{
	public
	$id,
  	$nome,
	$email,
	$matricula,
	$instrutor,
	$evento_id,
    $token,
    $cpf,
    $cidade,
    $estado,
    $nascimento,
    $sexo,
    $nota,
	$notaMax,
	$notaMin;

	public function __construct($eventoId) {
        $this->evento_id = $eventoId;
    }
	
	public function insert(){
		$sql = "INSERT INTO inscritos_fadergs (nome, email, instrutor, evento_id) 
			VALUES ( 
			'".$this->nome."' ,
			'".$this->email."' ,
             ".$this->instrutor." ,
			".$this->evento_id." ); ";
			 echo $sql;
		return Conexao::executarComRetornoId( $sql );
	}
	public function update(){
		$sql = "UPDATE SET ; ";
			 echo $sql;
		return Conexao::executarComRetornoId( $sql );
	}

	public static function getInscritosByEventoId( $eventoId ){
		$query  = " SELECT * 
					FROM inscritos_fadergs
					WHERE evento_id  = " .$eventoId ;
		$result = Conexao::consultar( $query );
		return $result;
	}

	public function consultarInscritos() {
        $query = "SELECT * FROM inscritos_fadergs WHERE evento_id = " . $this->evento_id;
        $result = Conexao::consultar($query);
        return $result;
    }

	public function contarInscritos() {
        $query = "SELECT COUNT(id) AS total FROM inscritos_fadergs WHERE evento_id = " . $this->evento_id;
        $result = Conexao::consultar($query);
        $row = mysqli_fetch_assoc($result);
   		$totalParticipantes = $row['total'];
        return $totalParticipantes;
    }

	public function listarInscritos() {
		$lista = new ArrayObject();
        $query = "SELECT id, nome, email, matricula, cpf, cidade, nota FROM inscritos_fadergs WHERE evento_id = " . $this->evento_id;
        $result = Conexao::consultar($query);
        if( mysqli_num_rows( $result ) > 0 ){
			while( list( $id, $nome, $email, $matricula, $cpf, $cidade, $nota  ) = mysqli_fetch_row($result) ){
				$i = new Inscritos($this->evento_id);
				$i->id = $id;
				$i->nome = $nome;
				$i->email = $email;
				$i->matricula = $matricula;
				$i->cpf = $cpf;
				$i->cidade = $cidade;
				$i->nota = $nota;
				$lista->append( $i );
			}
		}
		return $lista;
    }
	public function listarNotas() {
		$lista = new ArrayObject();
        $query = "SELECT FORMAT(AVG(nota), 2) AS `Avaliação`,
		(SELECT MAX(nota) FROM inscritos_fadergs WHERE evento_id = " . $this->evento_id . ") AS `Nota máxima`,
		(SELECT MIN(nota) FROM inscritos_fadergs WHERE evento_id = " . $this->evento_id . ") AS `Nota mínima`
		FROM inscritos_fadergs WHERE evento_id = " . $this->evento_id;
        $result = Conexao::consultar($query);
		if( mysqli_num_rows( $result ) > 0 ){
			while( list( $nota, $notaMax, $notaMin ) = mysqli_fetch_row($result) ){
				$i = new Inscritos($this->evento_id);
				$i->nota = $nota;
				$i->notaMax = $notaMax;
				$i->notaMin = $notaMin;
				$lista->append( $i );
			}
		}
		return $lista;
    }
}

?>