<?php

class Dosificacione extends \Eloquent {
      protected $fillable = array(
      'autorizacion',
      'clave',
      'inicio',
      'vencimiento',
      'numero'
    );
}
