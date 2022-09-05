<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);

/* pmis constants */
defined('ENUM_ADMINISTRATOR') || define('ENUM_ADMINISTRATOR', 1);
defined('ENUM_SUPER_ADMIN') || define('ENUM_SUPER_ADMIN', 1);
defined('ENUM_CENTRAL_MANAGER') || define('ENUM_CENTRAL_MANAGER', 2);
defined('ENUM_REGIONAL_MANAGER') || define('ENUM_REGIONAL_MANAGER', 3);
defined('ENUM_CENTRAL_OPERATOR') || define('ENUM_CENTRAL_OPERATOR', 4);
defined('ENUM_REGIONAL_OPERATOR') || define('ENUM_REGIONAL_OPERATOR', 5);
defined('ENUM_GUEST') || define('ENUM_GUEST', 6);
defined('BRIDGE_RES_ID') || define('BRIDGE_RES_ID', '18 06');

defined('WORK_CATEGORY_NEW') || define('WORK_CATEGORY_NEW', 1);
defined('WORK_CATEGORY_CARRY') || define('WORK_CATEGORY_CARRY', 2);
defined('WORK_CATEGORY_CANCELLED') || define('WORK_CATEGORY_CANCELLED', 3);
defined('UNCOMPLETED') || define('UNCOMPLETED', 0);
defined('COMPLETED') || define('COMPLETED', 1);
defined('BRIDGE_INF_CODE') || define('BRIDGE_INF_CODE', " 18 06 ");

defined('MAJOR_LEFT') || define('MAJOR_LEFT', 0);
defined('MAJOR_RIGHT') || define('MAJOR_RIGHT', 1);
defined('ENUM_NEW_CONSTRUCTION') || define('ENUM_NEW_CONSTRUCTION',0);
defined('ENUM_MAJOR_MAINTENANCE') || define('ENUM_MAJOR_MAINTENANCE', 1);
defined('MM_CODE') || define('MM_CODE', 'MM');

defined('BRIDGE_CATEGORY_NEW') || define('BRIDGE_CATEGORY_NEW', 1);
defined('BRIDGE_CATEGORY_CARRY') || define('BRIDGE_CATEGORY_CARRY', 2);
defined('BRIDGE_CATEGORY_CANCELLED') || define('BRIDGE_CATEGORY_CANCELLED', 3);

define('ENUM_LOC_COUNTRY', 5);
define('ENUM_LOC_DEV_REGION', 6);
define('ENUM_LOC_ZONE', 7);
define('ENUM_LOC_DISTRICT', 8);
define('ENUM_LOC_MUNICIPALITY', 9);
define('ENUM_LOC_VDC', 10);
define('ENUM_SUPPORT_LOCAL', 1);
define('ENUM_SUPPORT_GOVERMENT', 2);

define('ENUM_SUPPORT_OTHER', 3);
define('ENUM_SUPPORT_INGO', 4);
define('ENUM_SUPPORT_NGO', 5);