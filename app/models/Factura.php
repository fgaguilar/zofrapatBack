<?php

class Factura extends \Eloquent {
      protected $fillable = array(
            'clave',
            'autorizacion',
            'vencimiento',
            'fecha',
            'factura',
            'nit',
            'nombre',
            'dui',
            'cantidad1',
            'descripcion1',
            'monto1',
            'montot1',
            'cantidad2',
            'descripcion2',
            'monto2',
            'montot2',
            'montot',
            'literal',
            'control',
            'created_by',
            'updated_by'
      );
}
