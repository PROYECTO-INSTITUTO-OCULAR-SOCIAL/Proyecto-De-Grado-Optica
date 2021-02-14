<?php

namespace App\Models;
require_once ('BasicModel.php');
require_once ('Municipio.php');

class Persona extends BasicModel
{

    private int $id_persona;
    private String $tipo_documento;
    private int $documento;
    private String $nombre;
    private String $apellido;
    private String $direccion;
    private int $telefono;
    private ?Municipio $municipio;
    private String $rol;
    private ?String $contrasena;
    private String $estado;

    /**
     *  Usuarios constructor.
     * @param int $id_persona
     * @param String $tipo_documento
     * @param int $documento
     * @param String $nombre
     * @param String $apellido
     * @param String $direccion
     * @param int $telefono
     * @param Municipio $municipio
     * @param String $rol
     * @param String $contrasena
     * @param String $estado
     */

    public function __construct($Persona = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id_persona = $Persona['id_persona'] ?? 0;
        $this->tipo_documento = $Persona['tipo_documento'] ?? '';
        $this->documento = $Persona['documento'] ?? 0;
        $this->nombre = $Persona['nombre'] ?? '';
        $this->apellido = $Persona['apellido'] ?? '';
        $this->direccion = $Persona['direccion'] ?? '';
        $this->telefono = $Persona['telefono'] ?? 0;
        $this->municipio = $Persona['municipio'] ?? null;
        $this->rol = $Persona['rol'] ?? '';
        $this->contrasena = $Persona['contrasena'] ?? '';
        $this->estado = $Persona['estado'] ?? '';
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return mixed|null
     */
    public function getIdPersona(): int
    {
        return $this->id_persona;
    }

    /**
     * @param  $id_persona
     */
    public function setIdPersona(int $id_persona): void
    {
        $this->id_persona = $id_persona;
    }

    /**
     * @return mixed|null
     */
    public function getTipoDocumento(): String
    {
        return $this->tipo_documento;
    }

    /**
     * @param  $tipo_documento
     */
    public function setTipoDocumento(String $tipo_documento): void
    {
        $this->tipo_documento = $tipo_documento;
    }


    /**
     * @return mixed|null
     */
    public function getDocumento(): int
    {
        return $this->documento;
    }

    /**
     * @param  $documento
     */
    public function setDocumento(int $documento): void
    {
        $this->documento = $documento;
    }

    /**
     * @return mixed|null
     */
    public function getNombre(): String
    {
        return $this->nombre;
    }

    /**
     * @param $nombre
     */
    public function setNombre(String $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed|null
     */
    public function getApellido(): String
    {
        return $this->apellido;
    }

    /**
     * @param  $apellido
     */
    public function setApellido(String $apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed|null
     */
    public function getDireccion(): String
    {
        return $this->direccion;
    }

    /**
     * @param $direccion
     */
    public function setDireccion(String $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed|null
     */
    public function getTelefono(): int
    {
        return $this->telefono;
    }

    /**
     * @param  $telefono
     */
    public function setTelefono(int $telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed|null
     */
    public function getMunicipio(): Municipio
    {
        return $this->municipio;
    }

    /**
     * @param $municipio
     */
    public function setMunicipio(Municipio $municipio): void
    {
        $this->municipio = $municipio;
    }

    /**
     * @return mixed|null
     */
    public function getRol(): String
    {
        return $this->rol;
    }

    /**
     * @param $rol
     */
    public function setRol(String $rol): void
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed|null
     */
    public function getContrasena(): String
    {
        return $this->contrasena;
    }

    /**
     * @param $contrasena
     */
    public function setContrasena(String $contrasena): void
    {
        $this->contrasena = $contrasena;
    }

    /**
     * @return mixed|null
     */
    public function getEstado(): String
    {
        return $this->estado;
    }

    /**
     * @param  $estado
     */
    public function setEstado(String $estado): void
    {
        $this->estado = $estado;
    }



    public function Create()
    {
        $result = $this->insertRow("INSERT INTO mer_optica.Persona VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->tipo_documento,
                $this->documento,
                $this->nombre,
                $this->apellido,
                $this->direccion,
                $this->telefono,
                $this->municipio->getIdMunicipio(),
                $this->rol,
                $this->contrasena,
                $this->estado,

            )
        );
        $this->setIdPersona(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    public function update()
    {
        $result = $this->updateRow("UPDATE mer_optica.Persona SET tipo_documento = ?, documento = ?, nombre = ?, apellido = ?, direccion = ?, telefono = ?, municipio = ?, rol = ?, contrasena = ?, estado = ? WHERE id_persona = ?", array(
                $this->tipo_documento,
                $this->documento,
                $this->nombre,
                $this->apellido,
                $this->direccion,
                $this->telefono,
                $this->municipio->getIdMunicipio(),
                $this->rol,
                $this->contrasena,
                $this->estado,
                $this->id_persona,
            )
        );
        $this->Disconnect();
        return $result;
    }

    public static function getAll()

    {
        return Persona::search("SELECT * FROM mer_optica.Persona");
    }

    public static function PersonaRegistrado($nombre): bool
    {
        $result = Persona::search("SELECT nombre FROM mer_optica.Persona where nombre = '" . $nombre . "'");
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }

    }

    public static function search($query)
    {

        $arrPersona = array();
        $tmp = new Persona();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Persona = new Persona();
            $Persona->id_persona = $valor['id_persona'];
            $Persona->tipo_documento = $valor['tipo_documento'];
            $Persona->documento = $valor['documento'];
            $Persona->nombre = $valor['nombre'];
            $Persona->apellido = $valor['apellido'];
            $Persona->direccion = $valor['direccion'];
            $Persona->telefono = $valor['telefono'];
            $Persona->municipio = Municipio::searchForId($valor['municipio']);
            $Persona->rol = $valor['rol'];
            $Persona->contrasena = $valor['contrasena'];
            $Persona->estado = $valor['estado'];
            $Persona->Disconnect();
            array_push($arrPersona, $Persona);
        }
        $tmp->Disconnect();
        return $arrPersona;
    }

    public static function searchForId($id)
    {
        $Persona = null;
        if ($id > 0) {
            $Persona = new Persona();
            $getrow = $Persona->getRow("SELECT * FROM mer_optica.Persona WHERE id_persona =?", array($id));
            $Persona->id_persona = $getrow['id_persona'];
            $Persona->tipo_documento = $getrow['tipo_documento'];
            $Persona->documento = $getrow['documento'];
            $Persona->nombre = $getrow['nombre'];
            $Persona->apellido = $getrow['apellido'];
            $Persona->direccion = $getrow['direccion'];
            $Persona->telefono = $getrow['telefono'];
            $Persona->municipio = Municipio::searchForId($getrow['municipio']);
            $Persona->rol = $getrow['rol'];
            $Persona->contrasena = $getrow['contrasena'];
            $Persona->estado = $getrow['estado'];
        }
        $Persona->Disconnect();
        return $Persona;
    }

    public function deleted($id)
    {
        $Persona = Persona::searchForId($id); //Buscando un usuario por el ID
        $Persona->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $Persona->update();                    //Guarda los cambios..
    }

    public function nombresCompletos()
    {
        return $this->nombre . " ";
    }

}