<?php

namespace Config;

class DatabaseServer
{
	private $host = '127.0.0.1';
	private $database = 'blog';
	private $user = 'root';
	private $password = '';

	/**
	 * @return string
	 */
	public function getHost(): string
	{
		return $this->host;
	}

	/**
	 * @return string
	 */
	public function getDatabase(): string
	{
		return $this->database;
	}

	/**
	 * @return string
	 */
	public function getUser(): string
	{
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}
}
