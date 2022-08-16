<?php

class BD
{

	public static function Conectar()
	{
		try 
		{	
			// Exemplo de conexo com o MySQL
			//$this->pdo = new PDO("mysql:host=localhost;dbname=baseteste2021","root","vertrigo"); 

			// Conectando com MS SQL Server, com o php rodando no Linux
			// new PDO('dblib:host='.$this->servidor.';dbname='.$this->base,$this->usuario,$this->senha);

			// Conectando com MS SQL Server, com o php rodando no Windows
			//$pdo = new PDO("sqlsrv:Server=localhost;Database=restaurante2022", 'sa', 'unifai2022');

			$driver 	= "sqlsrv";
			$host		= ".\SQLEXPRESS";
			$bd 		= "restaurante2022_simulado";
			$user		= "sa";
			$password	= "unifai2022";

			$pdo = new PDO("$driver:Server=$host;Database=$bd", $user, $password);

			return $pdo;
		
		} catch(PDOException $e)
		{
			$erro  = "Não foi possível efetuar a conexão com o banco de dados!";
            $erro .= "\n\nOs drivers disponiveis são: " . implode(",", PDO::getAvailableDrivers());
            $erro .= "\n\nErro: " . $e->getMessage();
            throw new Exception($erro);

		}		
	} // construct

} // class BD

