<?php

class Factura extends \Eloquent {
      protected $fillable = array(
            'clave',
            'autorizacion',
            'vencimiento',
            'fecha',
            'factura',
            'nit',
            'monto',
            'control',
            'imagenQR',
            'created_by',
            'updated_by'
      );
}
