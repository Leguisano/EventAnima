<?php

	class Conexao{
		private static $local = "localhost";
		private static $user  = "root";
		private static $senha = "";
		private static $banco = "eventosFadergs";
	
		private static function abrir(){
			$conn = mysqli_connect(self::$local , self::$user, self::$senha , self::$banco );
			if( $conn ) {
				return $conn;
			}else{
				return NULL;
			}
		}
		private static function fechar( $conn ){
			if( $conn ){
				mysqli_close($conn);
			}
		}
		public static function consultar($query){
			$conn = self::abrir();
			if( $conn ){
				$result = mysqli_query($conn, $query);
				self::fechar($conn);
				return $result;
			}
		}
	
		public static function executar($query){
			$conn = self::abrir();
			if( $conn ){
				mysqli_query($conn, $query);
				self::fechar($conn);
			}     
		}
		public static function executarComRetornoId($query){
			$conn = self::abrir();
			if( $conn ){
				mysqli_query($conn, $query);
				$id = mysqli_insert_id($conn);
				self::fechar($conn);
				return $id;
			}     
		}
	
		
	
	}

?>