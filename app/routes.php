<?php

Route::group(array('prefix' => 'api'), function()
{
    Route::resource('facturas', 'FacturaController',
      ['only'=>['index','store','show','update','destroy']]);
    Route::resource('dosificaciones', 'dosificacioneController',
      ['only'=>['index','store','show','update','destroy']]);          
    Route::get('factura/{id}','FacturaController@factura');
});

Route::group(array('prefix' => 'service'), function() {
    Route::resource('authenticate', 'AuthenticationController',
      ['only'=>['index','store','show','update','destroy']]);
    Route::resource('movies', 'MovieController');
});

Route::get('reporte1', function()
{
    $html = '<html><body>'
            . '<p>Fidel Reporte '
            . 'templating system.</p>'
            . '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->show();
});

//Route::controller('authors', 'AuthorsController');

Route::get('pdf', function(){
    $fpdf = new Fpdf();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(40,10,'Hello World!');
        $fpdf->Output();
        exit;
});

Route::get('pdf2', function()
{
  $factura = Factura::find(1);

  return View::make('pdf.reporte01', array('factura' => $factura));
});

Route::get('pdf3/{id}', array('uses' => 'FacturaController@imprimirFactura'));

Route::get('qrcode', function()
{
  $factura = Factura::find(1);

  return View::make('pdf.reporte02', array('factura' => $factura));
});

Route::get('qrcode2', function()
{
  QrCode::format('png')->generate('Make1 me into a QrCode!');
  return View::make('pdf.footer');
});

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home'
));

/*Route::group(array('before' => 'guest'), function(){
  Router::group(array('before' => 'csrf'), function(){
    
  });
  Route::get();
});*/

Route::group(array('before' => 'guest'),function(){
  
  Route::group(array('before' => 'csrf'),function(){
    Route::post('/account/create',array(
      'as' => 'account-create-post',
      'uses' => 'AccountController@postCreate' 
    ));
  });
  Route::get('/account/create',array(
    'as' => 'account-create',
    'uses' => 'AccountController@getCreate' 
  ));

});
