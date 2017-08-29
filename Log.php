<?php 

class Log
{
	private $connection;

	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}

	public function log($action, $user = null)
	{
		try{
			$ip = $_SERVER['REMOTE_ADDR'];

			$stmt = $this->connection->prepare("INSERT INTO log SET ip = : ip, user = :user, action = :action, date_action = NOW()");
			$stmt->bindValue(":ip", $ip);
			$stmt->bindValue(":user", $user);
			$stmt->bindValue(":action", $action);
			$stmt->execute();
		}catch(\PDOException $e){
			echo 'Erro: ' > $e->getMessage();
		}
	}
}