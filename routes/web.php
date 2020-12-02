<?php

use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Http\Request;

Route::redirect('/', '/login');

// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'auth.unique.user'], 'prefix' => 'home', 'as' => 'home.'], function () {
    Route::get('/', ['uses' => 'Dashboard\DashboardController@show', 'as' => 'dashboard']);
    Route::resource('dashboard', 'Dashboard\DashboardController');
    Route::get('dashboard_update', ['uses' => 'Dashboard\DashboardController@updateListAjax', 'as' => 'dashboard.updateList']);
});

Route::get('file-upload', 'FileUpload\FileUploadController@index');
Route::post('file-upload/upload', 'FileUpload\FileUploadController@upload')->name('upload');
Route::delete('file-upload/destroy', 'FileUpload\FileUploadController@destroy')->name('destroy');

Route::group(['middleware' => ['auth', 'auth.unique.user'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/meta4', ['uses' => 'Admin\Meta4Controller@index', 'as' => 'meta4']);

    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);

    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);

    Route::resource('menu', 'Admin\MenuController');
    Route::resource('menuitem', 'Admin\MenuItemController');
    Route::get('menu_update', ['uses' => 'Admin\MenuController@menuUpdateAjax', 'as' => 'menu.menu_update']);
    Route::post('menu_mass_destroy', ['uses' => 'Admin\MenuController@massDestroy', 'as' => 'menu.mass_destroy']);

    Route::resource('dashboard', 'Admin\DashboardController');
    Route::post('dashboard_mass_destroy', ['uses' => 'Admin\DashboardController@massDestroy', 'as' => 'dashboard.mass_destroy']);
});

Route::group(['middleware' => ['auth', 'auth.unique.user'], 'prefix' => 'manager', 'as' => 'manager.'], function () {
    Route::resource('users', 'Manager\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Manager\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('roles', 'Manager\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Manager\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
});

Route::group(['middleware'=>['auth', 'auth.unique.user', 'check.permissions'], 'prefix'=>'cpp', 'as' =>'cpp.'], function(){
    Route::resource('/cadastroE-protocolo', 'Cpp_Controllers\CadastroeProtocoloDiversos');    
    Route::resource('/novosexpedientes', 'Cpp_Controllers\NovosExpedientesController'   );
    Route::resource('/salavotacao', 'Cpp_Controllers\SalaVotacaoController'             );
    Route::resource('/sala44A', 'Cpp_Controllers\Sala44AController'                     );
    Route::resource('/relator', 'Cpp_Controllers\RelatorController'                     );
    Route::resource('/__44a', 'Cpp_Controllers\__44AController'                         );
    Route::resource('/HomologP', 'Cpp_Controllers\HomologPontosController'              );
    Route::resource('/deliberacao', 'Cpp_Controllers\DeliberController'                 );
    Route::resource('/presidentecomissao', 'Cpp_Controllers\PresidenteComissaoController');
    Route::resource('/ata', 'Cpp_Controllers\AtaController'                             );
    Route::resource('/findata', 'Cpp_Controllers\FindAtaController'                     );
    Route::resource('/findeliberacao', 'Cpp_Controllers\FindDeliberacaoController'      );
    Route::resource('/relatorios', 'Cpp_Controllers\RelatorioController'                );
    Route::resource('/secretario', 'Cpp_Controllers\SecretarioController'               );
    Route::resource('/relatorFilterPedidos', 'Cpp_Controllers\FilterPedidosRelatorController'  );
    Route::resource('/pedidosPostergados', 'Cpp_Controllers\PostergadosController'  );
    Route::resource('/gestaocontrole', 'Cpp_Controllers\ChartRelatorioRelator'  );
    Route::resource('/uploadFile', 'Cpp_Controllers\uploadFileController'  );
    Route::resource('/historyDeliberRelator', 'Cpp_Controllers\HistoryDeliberRelatoController'  );
    Route::resource('/eProtocoloAnexoController', 'Cpp_Controllers\eProtocoloAnexoController'                     );
    Route::resource('/registry44A', 'Cpp_Controllers\registry44A'                     );
    Route::resource('/viewRelatorio', 'Cpp_Controllers\showAnexoRelatorioRelatorController'                     );

    Route::post('/getPolice', 'Cpp_Controllers\__44AController@getPolicial');                
    Route::post('/create44A', 'Cpp_Controllers\__44AController@create44A');                
    Route::post('/registre_Vote44A', 'Cpp_Controllers\RelatorController@registre_Vote44A');
    Route::post('/alterParecer', 'Cpp_Controllers\RelatorController@alterParecer'                     );
    Route::post('/update44A', 'Cpp_Controllers\RelatorController@update44_A', ['as'=>'update44A', function(){

    }]);
    Route::post('/novoSecretarioPresidente', 'Cpp_Controllers\SecretarioController@novoSecretarioPresidente');
    Route::post('/editDeliberInAta', 'Cpp_Controllers\AtaController@editDeliberAta'                             );
    Route::post('/editDeliberInAtaRelatado', 'Cpp_Controllers\AtaController@editDeliberAtaRelatado');
    Route::post('/editDeliberInAta44a', 'Cpp_Controllers\AtaController@editDeliberAta44a');
    Route::post('/editDeliberInAtaPost', 'Cpp_Controllers\AtaController@editDeliberAtaPostergado');
    Route::post('/updateParecerPostergados', 'Cpp_Controllers\RelatorController@updateParecerPostergados');
    Route::post('/editPontos', 'Cpp_Controllers\HomologPontosController@editPontos');
    Route::post('/efetiveAlterPontos', 'Cpp_Controllers\HomologPontosController@efetiveAlterPontos'              );
    Route::post('/newExpedienteProtocolSelected', 'Cpp_Controllers\NovosExpedientesController@newExpedienteProtocolSelected');
    
    Route::get('/storedHomologP', 'Cpp_Controllers\HomologPontosController@storedHmologPointing'              );
    Route::get('/atapdf', 'Cpp_Controllers\AtaController@generatePdf'                     );
    Route::get('/editParecer', 'Cpp_Controllers\RelatorController@searcheParecer'                     );
    Route::get('/editarParecer', 'Cpp_Controllers\RelatorController@editParecer'                     );
    Route::get('/showParerPostergados', 'Cpp_Controllers\RelatorController@parecerPostergados'                     );
    Route::get('/editParerPostergados', 'Cpp_Controllers\RelatorController@editParecerPostergados'                     );
    Route::get('/__44A', 'Cpp_Controllers\RelatorController@__44A', ['as'=>'__44A', function(){

    }]);                
    Route::get('/votar44A', 'Cpp_Controllers\RelatorController@votar44A');
    Route::get('/editRegistryRelator', 'Cpp_Controllers\SecretarioController@editRegistryRelator');
    Route::get('/editRegistryPresidentSecretario', 'Cpp_Controllers\SecretarioController@editRegistryPresidentSecretario');
    Route::get('/novata', 'Cpp_Controllers\SecretarioController@novata'               );
    Route::get('/novorelator', 'Cpp_Controllers\SecretarioController@novorelator');
    Route::get('/novopresidentsecretario', 'Cpp_Controllers\SecretarioController@novopresidentsecretario');
    Route::get('/reabrirvotacao', 'Cpp_Controllers\SecretarioController@reabrirvotacao');
    Route::get('/votardeliberacao', 'Cpp_Controllers\RelatorController@votardeliberacao');  
    Route::get('/updateVotoRelatoresDeliber44A', 'Cpp_Controllers\DeliberController@updateVotoRelatoresDeliber44A'                 ); 
    Route::get('/registry_vote_presidente', 'Cpp_Controllers\PresidenteComissaoController@registry_vote_presidente');
    Route::get('/presentingAta', 'Cpp_Controllers\FindAtaController@presentingAta'                     );
    Route::get('/listPedidosRelator', 'Cpp_Controllers\RelatorController@listPedidosRelator'                     );
    Route::get('/showPedidoSelectedToRelator', 'Cpp_Controllers\RelatorController@showPedidoSelectedToRelator'                     );
});

// rotas de testes
// route::resource('/rhpmpr', 'Cpp_Controllers\RhPmPrController');
route::resource('/server', 'Cpp_Controllers\serverController');
route::resource('/cliente', 'Cpp_Controllers\clientController');
