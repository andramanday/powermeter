<?php
Route::get('/', function() {
    return redirect(route('admin.dashboard'));
});
Route::get('/home', function() {
    return redirect(route('admin.dashboard'));
});

Route::get('roless', 'UserController@roless');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function() {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('users/roles', 'UserController@roles')->name('users.roles');
    Route::get('users/test', 'UserController@test');
    Route::get('users/companies', 'UserController@companies')->name('users.companies');
    Route::resource('users', 'UserController', [
        'names' => [
            'index' => 'users'
        ]
    ]);


    Route::resource('sensors', 'SensorController', [
        'names' => [
            'index' => 'sensors'
        ]
    ]);
    route::get('companies/ambil', 'CompanyController@ambil');
    Route::resource('companies', 'CompanyController', [
        'names' => [
            'index' => 'companies'
        ]
    ]);
    Route::resource('devices', 'DeviceController', [
        'names' => [
            'index' => 'devices'
        ]
    ]);
    Route::get('devices/sub/{dev}', 'DeviceController@sub');
    Route::get('devices/unsub/{dev}', 'DeviceController@unsub');

    Route::resource('histories', 'HistoryController', [
        'names' => [
            'index' => 'histories'
        ]
    ]);

    // Route::get('sensor', 'SensorController@index')->name('sensor');
    // Route::get('devices', 'DevicesController@index')->name('devices');
    // Route::get('devices/create', 'DevicesController@create')->name('devices.create');
    // Route::post('devices', 'DevicesController@store')->name('devices.store');

    Route::get('publish', 'DevicesController@publish');
    Route::get('subscribe', 'DevicesController@subscribe');

    // Route::view('sensors', 'admin.sensors', [
    //     'data' => App\sensor::all()
    // ]);
});

Route::middleware('auth')->get('logout', function() {
    Auth::logout();
    return redirect(route('login'))->withInfo('You have successfully logged out!');
})->name('logout');

Auth::routes(['verify' => true]);

Route::name('js.')->group(function() {
    Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
});

// Get authenticated user
Route::get('users/auth', function() {
    return response()->json(['user' => Auth::check() ? Auth::user() : false]);
});


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('mencoba', function() {
    return redirect('/admin/devices')->withStatus('kontuik');
});
