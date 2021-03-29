<?php
namespace
{
	/**
	 * All codes written by Angwa, Ogbole Moses
	 * The configuration variable to be used
	 * Edit the file fields to fit your need
	 * All fields are necesarry
	 */
	class Config
	{
		public $env;
		public function __construct()
		{
			$this->env = array(
				'hostname' => 'localhost', //Your servername used for Database and JWT

			    'username' => 'root',		//the server username

			    'password' => '6242',		// the server password

			    'database' => 'saroboot',	//Your database name
			);
		}
	}
}
