<?php

namespace ChatGPT\modelos;

class Articulo {

    private $id;
    private $titulo;
    private $texto;
    private $img;
    private $fecha;

    /**
     * @param $id
     * @param $titulo
     * @param $texto
     * @param $img
     * @param $fecha
     */
    public function __construct($id="", $titulo="", $texto="", $img="", $fecha="")
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->img = $img;
        $this->fecha = $fecha;
    }

    /**
     * @return mixed|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed|string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed|string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed|string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed|string $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return mixed|string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed|string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed|string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed|string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

}
