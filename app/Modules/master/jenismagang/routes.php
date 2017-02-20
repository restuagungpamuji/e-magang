<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/master/jenismagang', 'App\Modules\master\jenismagang\Controllers\JenismagangController');

});