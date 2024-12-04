<?php
/*
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT password(concat(`date`,`name`,`expires`)),
  `expires` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `event_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/


class Event{
	public
	$id,
  	$name,
	$date,
	$dateBR,
	$hours,
	$token,
	$expires,
	$expiresBR,
	$user_id;
	
	
	public function insert(){
		$sql = "INSERT INTO event (name, date, hours, expires, user_id) 
			VALUES ( 
			'".$this->name."' ,
			'".$this->date."' ,
			 ".$this->hours." ,
			'".$this->expires."' ,
			 ".$this->user_id." ); ";
			 echo $sql;
		return Conexao::executarComRetornoId( $sql );
	}
                       
	public static function getEventsByUserId( $user_id = 1 , $order = 0){
	    // $order | 0-> Crescente, 1 -> Decrescente
	    
	    
		$lista = new ArrayObject();
		
		$orderBy = "" ;
		if ( $order == 1){
		    $orderBy = "DESC";
		}
		
		$query  = " SELECT id, name, date, hours, expires , token,  DATE_FORMAT(date, '%d/%m/%Y') AS dateBR,  DATE_FORMAT(expires, '%d/%m/%Y %H:%i') AS expiresBR
					FROM event
					WHERE  $user_id = 1 OR user_id =  $user_id 
					ORDER BY id $orderBy ";
					
		$result = Conexao::consultar( $query );
		if( mysqli_num_rows( $result ) > 0 ){
			while( list( $id, $name, $date, $hours, $expires , $token, $dateBR, $expiresBR  ) = mysqli_fetch_row($result) ){
				$e = new Event();
				$e->id = $id;
				$e->name = $name;
				$e->date = $date;
				$e->dateBR = $dateBR;
				$e->hours = $hours;
				$e->expires = $expires;
				$e->expiresBR = $expiresBR;
				$e->token = $token;
				$lista->append( $e );
			}
		}
		return $lista;
	}

	public static function getEventById( $id ){
		$query  = " SELECT id, name, date, hours, expires , token,  DATE_FORMAT(date, '%d/%m/%Y') AS dateBR,  DATE_FORMAT(expires, '%d/%m/%Y %H:%i') AS expiresBR
					FROM event
					WHERE id  = " .$id ;
		$result = Conexao::consultar( $query );
		if( mysqli_num_rows( $result ) > 0 ){
			 list( $id, $name, $date, $hours, $expires , $token, $dateBR, $expiresBR  ) = mysqli_fetch_row($result);
				$e = new Event();
				$e->id = $id;
				$e->name = $name;
				$e->date = $date;
				$e->dateBR = $dateBR;
				$e->hours = $hours;
				$e->expires = $expires;
				$e->expiresBR = $expiresBR;
				$e->token = $token;
				return $e;
		}
		return null;
	}

	public static function getEventByToken( $token ){
		$query  = " SELECT id, name, date, hours, expires , token,  DATE_FORMAT(date, '%d/%m/%Y') AS dateBR,  DATE_FORMAT(expires, '%d/%m/%Y %H:%i') AS expiresBR
					FROM event
					WHERE token  =  '$token'";
		$result = Conexao::consultar( $query );
		if( mysqli_num_rows( $result ) > 0 ){
			 list( $id, $name, $date, $hours, $expires , $token, $dateBR, $expiresBR  ) = mysqli_fetch_row($result);
				$e = new Event();
				$e->id = $id;
				$e->name = $name;
				$e->date = $date;
			    $e->dateBR = $dateBR;
				$e->hours = $hours;
				$e->expires = $expires;
				$e->expiresBR = $expiresBR;
				$e->token = $token;
				return $e;
		}
		return null;
	}

	public static function update($eventId, $date, $expires) {
        
        $sql = "UPDATE event SET date = '$date', expires = '$expires' WHERE id = $eventId";

		Conexao::executar( $sql );
    }
}

?>