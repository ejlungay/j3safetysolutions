<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';

//routing user
$route['signup']['post'] = 'users/create_user_account';
$route['signin']['post'] = 'users/signin';
$route['change_password']['post'] = 'users/change_password';
$route['update_user']['post'] = 'users/change_user_detail';
//course routes
$route['add_course']['post'] = 'course_controller/add_course';
$route['course_id']['post'] = 'course_controller/get_course_id_by_course_name';
$route['course_detail']['post'] = 'course_controller/get_course_by_course_id';

//training routes
$route['add_training']['post'] = 'trainings_controller/add_training';
$route['training_id']['get'] = 'trainings_controller/get_training_id_by_course_id';
$route['training_detail']['get'] = 'trainings_controller/get_training_by_training_id';
$route['trainings']['get'] = 'trainings_controller/get_trainings_list';
$route['training_delegates']['get'] = 'trainings_controller/get_training_delegates';

//routing training speaker APIs
$route['add_speaker']['post'] = 'speaker_controller/add_training_speaker';
$route['speaker_id']['get'] = 'speaker_controller/get_speaker_id_by_training_id';
$route['speaker_detail']['get'] = 'speaker_controller/get_speaker_by_speaker_id';

//routing delegates functions
$route['add_delegate']['post'] = 'delegate_controller/add_delegate';
$route['delegate_detail']['get'] = 'delegate_controller/get_delegate_by_delegate_id';
$route['update_delegate']['post'] = 'delegate_controller/update_delegate';

//***********************************************************************************
$route['angu'] = 'Angularjs';
$route['src']['get'] = 'Angularjs/get_list';

$route['translate_uri_dashes'] = FALSE;
