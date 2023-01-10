<?php

class Session
{
	public static function init()
	{
		if (session_status() == PHP_SESSION_NONE) {
			$lifetime = 3600*24*30;
			session_set_cookie_params($lifetime);
			session_start();
		}
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}

	public static function checkSession()
	{
		self::init();
		if (self::get('login') == false) {
            session_destroy();

            return false;
		}

        return true;
	}

	public static function checkLogin()
	{
		self::init();
		if (self::get('login') == true) {
			header("Location: " . SITE_URL . "/users/index.php");
		}
	}

	public static function destroy()
	{
		session_destroy();
		header("Location: " . SITE_URL);
	}

	public static function adminSession()
	{
		self::init();
		if (self::get('admin_login') == false) {
			session_destroy();

			return false;
		}

        return true;
	}

	public static function adminLogin()
	{
		self::init();
		if (self::get('admin_login') == true) {
			header("Location: " . SITE_URL . "/admin/index.php");
		}
	}

	public static function adminDestroy()
	{

		session_destroy();
		header("Location: " . SITE_URL . "/admin/login.php");
	}

	public static function unset($key)
	{

		unset($_SESSION[$key]);
	}

	public static function hasSuccess()
	{
		return Session::get('success') ? true : false;
	}

	public static function getSuccess()
	{
		$message = Session::get('success') ?: null;
		Session::unset('success');
		return $message;
	}

	public static function hasError()
	{
		return Session::get('error') ? true : false;
	}

	public static function getError()
	{
		$message = Session::get('error') ?: null;
		Session::unset('error');
		return $message;
	}
}
