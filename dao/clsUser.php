<?php

	class User{
		
		public 
		$id,
		$name,
		$admin,
		$email,
		$password;
		

		public function __construct(){
			 
		}
		
		public function insert(){
		
			$query = "INSERT INTO users ( name, admin, email, password) VALUES ( 
					'$this->name' , 
				 	 $this->admin , 
					'$this->email' , 
				 	'$this->password'  );" ;

			return Conexao::executarComRetornoId( $query );
			
		}
		
		
		public static function getUserByLogin( $email , $pass){

			if( $email == "" ){
				return null;
			}else{
				$query = "SELECT id, name, admin 
						FROM users 
						WHERE  email =  '$email'  AND 
							password = '$pass' " ;
				
				$result = Conexao::consultar( $query );
				if( mysqli_num_rows( $result ) > 0 ){
					list( $id, $name, $admin ) = mysqli_fetch_row( $result );
					$u = new User();
					$u->id = $id;
					$u->name = $name;
					$u->admin = $admin;
					return $u;
				}else{ 
					return null;
				}
			}
			
		}
		
		
		
	}