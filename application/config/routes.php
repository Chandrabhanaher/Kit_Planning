<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['atlas_login'] = 'Login';
$route['myLogin'] = 'Login/user_login';
$route['forgotPass'] ='Login/forgot_pass';
$route['logoutMe'] = 'Login/logout';
$route['newUsers'] = 'Login/newReg';
$route['userReg'] = 'Login/addReg';

$route['bashbd'] = 'Home/dashboard';
$route['myHome']='Home';

$route['goToHome'] = 'Home/dashboard';
$route['goToHome_Dash'] = 'Home/pichart';
$route['upload_doc'] = 'Home/upload_files';

$route['import_bom']='Home/import_bom_file';
$route['import_kiting_plans']='Home/import_kiting_plan';
$route['import_stocks']='Home/import_stock';
$route['location_master']= 'Home/import_location';

$route['frozens'] = 'Frozens/frozen';

$route['f_trans'] = 'Frozens/trans';
$route['showF_flag'] = 'Frozens/showFrozen_flag';
$route['close_frozen1'] = 'Frozens/frozen_close';


$route['all_plans'] = 'Alls_Fronens/fetch_user';
$route['add_frozen_flag'] = 'Alls_Fronens/update_frozen_flag';
$route['add_frozen_flag1'] ='Alls_Fronens/update_frozen_flag1';

$route['frozen_items'] = 'Alls_Fronens/fetch_frozen';
$route['pick_frozen'] = 'Alls_Fronens/pick_frozen_flag';
$route['close_frozen'] = 'Alls_Fronens/close_frozen_flag';
$route['close_plans'] = 'Alls_Fronens/close_article_plan';
$route['close_plans1'] = 'Alls_Fronens/close_article_plan1';
$route['call_to_proceduer'] = 'Alls_Fronens/data_opration';

$route['picahrts'] = "Home/pichart";

$route['showRecod'] = 'Home/searchFrozen';

$route['all_article_plans'] = 'All_Plans/fetch_frozen';
$route['secondLevel'] = 'All_Plans/second_level';

$route['firstLevel'] = 'Alls_Fronens/fristLeves';
$route['bom_second_level'] = 'Alls_Fronens/secondLevel';
$route['bom_third_level'] = 'Alls_Fronens/thirdLevel';

$route['bomLevels'] = 'All_Plans/bomLevel';

$route['tempTableInsert'] = 'All_Plans/temp_table_insert';


$route['create_Excel']='Export_Reports/createXLS';
$route['create_Excel1']='Export_Reports/createXLS1';

$route['export_frozen/(\d+)'] = 'Export_Reports/export_fr/$1';

$route['frozen_plan'] = 'Export_Reports/only_frozen';
$route['print_frozen/(\d+)'] ='Export_Reports/frozen_print/$1';

$route['set_priority'] = 'Alls_Fronens/priority_set';
$route['SCM'] = 'Alls_Fronens/scm_remark';
$route['IBL'] = 'Alls_Fronens/ibl_remark';

$route['upload_doc1'] = 'Home/upload_file1';

//User Opration -  1;
$route['all_plans1'] = 'Alls_Fronens_1/fetch_user';
$route['bomLevels1'] = 'All_Plans_1/bomLevel';
$route['frozen_items1'] = 'Alls_Fronens_1/fetch_frozen';

$route['all_plans2'] = 'Alls_Fronens_2/fetch_user';
$route['bomLevels2'] = 'All_Plans_2/bomLevel';
$route['frozen_items2'] = 'Alls_Fronens_2/fetch_frozen';

$route['delete_plan'] = 'All_Plans/plan_delete';
$route['delete_bom'] = 'All_Plans/bom_delete';

$route['reports']='Export_Reports/close_report';
$route['kit_close_rerport'] = 'All_Plans/close_datewise_report';
        
$route['temp_bom'] = 'Export_Reports/temp_bom_excel';