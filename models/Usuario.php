<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $password_actual;
    public $password_nuevo;
    public $token;
    public $confirmado;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validarLogin() : array{
        if (!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }

        return self::$alertas;
    }

    public function validarNuevaCuenta() : array{
        if (!$this->nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }
        if (strlen($this->password) < 8) {
            self::$alertas['error'][] = "La contraseña debe contener al menos 8 caracteres";
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = "Las contraseñas ingresadas son diferentes";
        }
        return self::$alertas;
    }

    public function validarEmail() : array{
        if (!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }
        return self::$alertas;
    }

    public function validarPassword() : array{
        if (!$this->password) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }
        if (strlen($this->password) < 8) {
            self::$alertas['error'][] = "La contraseña debe contener al menos 8 caracteres";
        }

        return self::$alertas;
    }

    public function validar_perfil() : array{
        if (!$this->nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }
        return self::$alertas;
    }

    public function nuevo_password() : array{
        if (!$this->password_actual) {
            self::$alertas['error'][] = "La contraseña actual es obligatoria";
        }
        if (!$this->password_nuevo) {
            self::$alertas['error'][] = "Debes ingresar una nueva contraseña";
        }
        if (strlen($this->password_nuevo) < 8) {
            self::$alertas['error'][] = "La contraseña nueva debe tener al menos 8 caracteres";
        }
        return self::$alertas;
    }
    //Comprobar password
    public function comprobar_password() : bool{
        //Retorna true o false
        return password_verify($this->password_actual, $this->password);
    }

    //Hashea password
    public function hashPassword() : void{
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generarToken() : void{
        $this->token = uniqid();
    }
}