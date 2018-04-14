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

//Landing Page
Route::get('/', 'LandingPageController@showLandingPage'); //done

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); //done
Route::post('login', 'Auth\LoginController@login'); //done
Route::get('logout', 'Auth\LoginController@logout')->name('logout'); //done
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register'); //done
Route::post('register', 'Auth\RegisterController@register'); //done

// User
Route::get('api/users/{username}', 'User\UserController@showProfile')->name('user_profile');
Route::get('api/users/{username}/edit', 'User\UserController@editProfileForm')->name('edit_profile');
Route::post('api/users/{username}/edit', 'User\UserController@editProfileAction')->name('edit_profile_action');

Route::post('api/users/projects/accept_invite', 'User\UserController@acceptInvite');
Route::post('api/users/projects/unsigned_project', 'User\UserController@unsignProject');
Route::post('api/users/projects/search_project', 'User\UserController@searchUserProject');


Route::put('api/users/projects/new_project', 'User\UserController@newProject');


// Project
Route::get('api/projects/{project_id}/members', 'ProjectController@projectMembersView')->name('project_members');
Route::get('api/projects/{project_id}/settings/members', 'ProjectController@projectSettingsMembersList');
Route::delete('api/projects/{project_}/settings/members/{username}', 'ProjectController@projectSettingsMembersRemove');
Route::get('api/projects/{project_id}/settings/requests', 'ProjectController@projectSettingsRequestsList');
Route::post('api/projects/{project_id}/settings/requests/{request_id}/accept', 'ProjectController@projectSettingsRequestsAccept');
Route::post('api/projects/{project_id}/settings/requests/{request_id}/reject', 'ProjectController@projectSettingsRequestsReject');
Route::post('api/projects/{project_id}/edit', 'ProjectController@projectSettingsRequestsAccept');
Route::get('api/projects/{project_id}/statistics', 'ProjectController@projectStatisticsView');
Route::post('api/projects/{project_id}/members', 'ProjectController@projectMembersSearch');
Route::post('api/projects/{project_id}/settings/members', 'ProjectController@projectSettingsMembersSearch');

/*Route::get('api/projects/{project_id}', function($id) {
	return redirect()->route('project_sprints', ['id' => $id]);
})->name('project'); // done*/
Route::get('api/projects/{project_id}', 'ProjectController@project')->name('project');

//Sprints and Tasks
Route::get('api/projects/{project_id}/sprints', 'ProjectController@sprintsView')->name('project_sprints'); //done
/*Route::get('api/projects/{project_id}/sprints', 'ProjectController@sprintsViewPartial')->name('project_sprints_partial');*/
Route::get('api/projects/{project_id}/sprints/{sprint_id}/edit', 'ProjectController@sprintEditForm');
Route::post('api/projects/{project_id}/sprints/{sprint_id}/edit', 'ProjectController@sprintEdit');
Route::get('api/projects/{project_id}/sprints/new_sprint', 'ProjectController@newSprintForm');
Route::put('api/projects/{project_id}/sprints', 'ProjectController@newSprint');
Route::delete('api/projects/{project_id}/sprints/{sprint_id}','ProjectController@deleteSprint');

//Tasks 
Route::get('api/projects/{project_id}/tasks', 'ProjectController@taskView')->name('project_tasks');
Route::get('api/projects/{project_id}/tasks/{task_id}', 'ProjectController@taskPageView');
Route::get('api/projects/{project_id}/tasks/{task_id}/edit', 'ProjectController@taskEditForm');
Route::post('api/projects/{project_id}/tasks/{task_id}/edit', 'ProjectController@taskEditAction');
Route::delete('api/projects/{project_id}/tasks/{task_id}', 'ProjectController@deleteTask');
Route::post('api/projects/{project_id}/tasks/{task_id}/complete', 'ProjectController@completeTask');
Route::post('api/projects/{project_id}/tasks/{task_id}/assign', 'ProjectController@taskAssignUser');
Route::post('api/projects/{project_id}/tasks/{task_id}/unassign', 'ProjectController@taskUnassignUser');
Route::put('api/projects/{project_id}/tasks', 'ProjectController@newTask');
Route::put('api/projects/{project_id}/tasks/{task_id}/comments', 'ProjectController@newComment');
Route::get('api/projects/{project_id}/tasks/{task_id}/comments/{comment_id}/edit', 'ProjectController@editCommentForm');
Route::post('api/projects/{project_id}/tasks/{task_id}/comments/{comment_id}/edit', 'ProjectController@editCommentAction');
Route::delete('api/projects/{project_id}/tasks/{task_id}/comments/{comment_id}', 'ProjectController@deleteComment');

//Project Forum
Route::get('projects/{id}/threads', 'ProjectController@threadsView')->name('forum');
/*Route::get('projects/{id}/threads/create', 'ProjectController@threadsCreateForm');
Route::put('projects/{id}/threads', 'ProjectController@createThread');
*/Route::get('projects/{id}/threads/{thread_id}', 'ProjectController@threadPageView');
/*Route::get('projects/{id}/threads/{thread_id}/edit', 'ProjectController@threadEditForm');
Route::post('projects/{id}/threads/{thread_id}', 'ProjectController@threadEditAction');
Route::put('projects/{id}/threads/{thread_id}/comments', 'ProjectController@newThreadComment');
Route::get('projects/{id}/threads/{thread_id}/comments/{comment_id}/edit', 'ProjectController@threadCommentEditForm');
Route::post('projects/{id}/threads/{thread_id}/comments/{comment_id}', 'ProjectController@threadCommentEditAction');
Route::delete('projects/{id}/threads/{thread_id}', 'ProjectController@deleteThread');
Route::delete('projects/{id}/threads/{thread_id}/comments/{comment_id}', 'ProjectController@deleteComment');

//Admin Administraton, Report and Static Pages
*/Route::get('admin/reports/comments', 'AdminController@commentReportsView');
/*Route::get('admin/reports/users', 'AdminController@userReportsView');
Route::get('admin/reports/comments/{comment_report_id}', 'AdminController@commentReportView');
Route::get('admin/reports/users/{user_report_id}', 'AdminController@userReportView');
Route::delete('admin/reports/{report_id}', 'AdminController@deleteReport');
Route::post('admin/reports/users/{report_id}', 'AdminController@disableUser');
Route::delete('admin/reports/comments/{report_id}', 'AdminController@deleteComment');
Route::delete('admin/projects/{project_id}', 'AdminController@deleteProject');

Route::get('actions/reports/comments', 'ReportController@commentReportForm');
Route::get('actions/reports/users', 'ReportController@userReportForm');
Route::put('actions/reports/users', 'ReportController@createUserReport');
Route::put('actions/reports/comments', 'ReportController@createCommentReport');
*/


/*
// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');
*/