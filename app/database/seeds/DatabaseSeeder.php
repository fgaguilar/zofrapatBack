<?php

class DatabaseSeeder extends Seeder
{
	
	public function run(){
		Eloquent::unguard();
		$this->call('PostsTableSeeder');
	}

}

class PostsTableSeeder extends Seeder
{
	
	public function run(){
		DB::table('posts')->insert(array(
			'title'=>'laravel 4, un potenete framework',
			'content'=>'Introduccion a laravel 4'
		));
		DB::table('posts')->insert(array(
            'title' => 'codeigniter, esperando su versión 3.0',
            'content' => 'el día que llegué, se pondrá a la altura de laravel'
    ));

    DB::table('posts')->insert(array(
            'title' => 'zend framework, otro gran framework',
            'content' => 'no soy muy amigo de él, aunque lo conozco'
    ));

    DB::table('posts')->insert(array(
            'title' => 'symfony, gran framework',
            'content' => 'laravel realmente usa muchos recursos de symfony'
    ));

    DB::table('posts')->insert(array(
            'title' => 'angularjs, mvc en javascript',
            'content' => 'trabajando de forma ordenada en javascript'
    ));

    DB::table('posts')->insert(array(
            'title' => 'jQuery, la mejor librería javascript',
            'content' => 'que mal lo ibamos a pasar sin él :D'
    ));		
}
}