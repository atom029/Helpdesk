<?php




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingController@index')->name('landing');
Route::post('/getTicketInfo', 'LandingController@getTicketInfo')->name('getTicketInfo');
Route::post('/sendFullConvo', 'SendEmailController@sendFullConvo')->name('sendFullConvo');
Route::post('/checkTicket', 'SendEmailController@checkTicket')->name('checkTicket');
Route::post('/sendReply', 'SendEmailController@sendReply')->name('sendReply');
Route::post('/sendTicketNo', 'SendEmailController@sendTicketNo')->name('sendTicketNo');


Route::get('/dashboard', 'DasboardController@index')->name('dashboard');
Route::get('/adminDashboard', 'AdminController@index')->name('adminDashboard');

Route::get('/login', 'LandingController@login')->name('login');
Route::get('/register', 'LandingController@register')->name('register');
Route::get('/checkUser/{user}', 'LandingController@checkUser')->name('checkUser');
Route::get('/logout', 'LandingController@logout')->name('logout');
Route::post('/checkCred', 'LandingController@checkCred')->name('checkCred');


Route::get('/user', 'UsersController@index')->name('user');
Route::post('/insertUser', 'UsersController@store')->name('insertUser');
Route::get('/agent', 'UsersController@agent')->name('agent');
Route::post('/agentInfo', 'UsersController@agentInfo')->name('agentInfo');



Route::post('assignTask', 'TaskController@store')->name('assignTask');
Route::get('taskChat/{ticket}/{task}', 'TaskController@index')->name('taskChat');
Route::post('/insertTaskResponse', 'TaskController@insertTaskResponse')->name('insertTaskResponse');
// Route::post('/insertTaskResponse', 'TaskController@insertTaskResponse')->name('insertTaskResponse');

Route::get('chat/{id}', 'TimelineController@index')->name('chat');
Route::get('timeline/{id}', 'TimelineController@show')->name('timeline');
Route::post('transferDepartment', 'TimelineController@store')->name('transferDepartment');


Route::get('/topic', 'TopicsController@index')->name('topic');
Route::post('/insertTopic', 'TopicsController@store')->name('insertTopic');
Route::post('/getTopic', 'TopicsController@getTopic')->name('getTopic');
Route::post('/updateTopic', 'TopicsController@updateTopic')->name('updateTopic');
Route::post('/deleteTopic', 'TopicsController@deleteTopic')->name('deleteTopic');


Route::get('/getProfanityWords', 'TicketsController@getProfanityWords')->name('getProfanityWords');
Route::get('/tickets', 'TicketsController@index')->name('tickets');
Route::post('/ticketStatus', 'TicketsController@show')->name('ticketStatus');
Route::post('/createTicket', 'TicketsController@store')->name('createTicket');
Route::post('/createSubTicket', 'TicketsController@subTicket')->name('createSubTicket');
Route::get('dept_agent/{id}', 'TicketsController@dept_agent')->name('dept_agent');
Route::get('/random', 'TicketsController@random')->name('random');
Route::post('/serverTicket', 'TicketsController@serverTicket')->name('serverTicket');
Route::post('/updateTicket', 'TicketsController@update')->name('updateTicket');
Route::get('/agentTicket/{id}', 'TicketsController@agentTicket')->name('agentTicket');


Route::post('/insertResponse', 'ResponseController@store')->name('insertResponse');
Route::post('/closedTicket', 'ResponseController@update')->name('closedTicket');
Route::get('/reopen/{id}', 'ResponseController@reopen')->name('reopen');

Route::get('/userTickets', 'UserTicketController@index')->name('userTickets');
Route::get('/getNotif', 'UserTicketController@store')->name('getNotif');


Route::get('multifileupload', 'LandingController@multifileupload')->name('multifileupload');
Route::post('multifileupload', 'LandingController@stores')->name('multifileupload');


Route::get('/department', 'DepartmentController@index')->name('department');
Route::post('/insertDepartment', 'DepartmentController@store')->name('insertDepartment');
Route::post('/selectEmployee', 'DepartmentController@show')->name('selectEmployee');
Route::post('/getDept', 'DepartmentController@getDept')->name('getDept');
Route::post('/updateDepartment', 'DepartmentController@updateDepartment')->name('updateDepartment');

Route::post('/assignEmp', 'DepartmentController@update')->name('assignEmp');

Route::get('/tickets/date', 'TicketsController@dateCreated')->name('filter_date');
Route::get('/tickets/unread', 'TicketsController@unread')->name('filter_unread');
Route::get('/tickets/closed', 'TicketsController@closed')->name('closed');
Route::post('/requestAccess', 'TicketsController@requestAccess')->name('requestAccess');

Route::get('/reports', 'ReportsController@index')->name('reports');
Route::get('/allAgentPerformance', 'ReportsController@allAgentPerformance')->name('allAgentPerformance');





