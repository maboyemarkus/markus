<?php

	abstract class	User { // une class abstract signifie qu'elle ne peut pas être instanciée
		private		$_name;
		private		$_password;
		private		$_email;
		private		$_phone;

		protected	$protec = 'protected attriute';

		public function	__construct($name, $password, $email, $phone) {
			$this->set_name($name);
			$this->set_password($password);
			$this->set_email($email);
			$this->set_phone($phone);
		}

		public function	set_name($name) {
			if (isset($name) && is_string($name))
			{
				$this->_name = $name;
			}
		}

		public function	set_password($password) {
			if (isset($password) && is_string($password))
			{
				$this->_password = md5($password);
			}
		}

		public function	set_email($email) {
			if (isset($email))
			{
				if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
				{
					$this->_email = $email;
				}
			}
		}

		public function	set_phone($phone) {
			if (isset($phone))
			{
				if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $phone))
				{
					$this->_phone = preg_replace('#[-. ]#', '', $phone);
				}
			}
		}

		public function	name() { return ($this->_name); }
		public function	password() { return ($this->_password); }
		public function	email() { return ($this->_email); }
		public function	phone() { return ($this->_phone); }

		abstract public function	abstract_function(); // une méthode abstract doit être déclarée dans toutes les class héritantes
		final public function		final_function() { // une méthode finale ne peut plus être redéfinie par ses héritiers

		}

		public function	__set($property, $value) {
			if (isset($this->$property[$value]))
				return ($this->$property[$value]);
		}

		public function	__get($property) {
			if (isset($this->$property))
				return ($this->$property);
		}
	}

	class	Super_user extends User {
		public function	print_attributes() {
			echo $this->_name; // attr is private we dont have access
			echo $this->protec; // attr is protected so child can access it
		}

		public function	abstract_function() {

		}
	}

	final class	Admin extends Super_user { // final class ne peut pas avoir d'héritié

	}

	interface iDb_connect {
		const	DB_NAME = "my_db";
		const	DB_TABLE = "my_table";
		const	DB_SERVER = "localhost";
		const	DB_UNAME = "root";
		const	DB_UPSWD = "root";
	}

	final class	Users_manager implements iDb_connect {
		private $_db;

		public function	__construct() {
			$this->db_connection();
		}

		final public function	db_connection() {
			$this->_db = new PDO("mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME, self::DB_UNAME, self::DB_UPSWD);
		}

		public function	create(user $user) {
			$query = $this->_db->prepare("INSERT INTO " . self::DB_TABLE . " (name, password, email, phone)
				VALUES(:name, :password, :email, :phone)");
			$query->bindValue(":name", $user->name());
			$query->bindValue(":password", $user->password());
			$query->bindValue(":email", $user->email());
			$query->bindValue(":phone", $user->phone());
			$query->execute();
		}

		public function	delete(user $user) {
			$this->_db->exec("DELETE FROM " . self::DB_NAME . " WHERE name = " . $user->name());
		}
	}
?>
