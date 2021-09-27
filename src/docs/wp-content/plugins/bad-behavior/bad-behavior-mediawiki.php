<?php
/*
Bad Behavior - detects and blocks unwanted Web accesses
Copyright (C) 2005,2006,2007,2008,2009,2010,2011,2012 Michael Hampton

Bad Behavior is free software; you can redistribute it and/or modify it under
the terms of the GNU Lesser General Public License as published by the Free
Software Foundation; either version 3 of the License, or (at your option) any
later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along
with this program. If not, see <http://www.gnu.org/licenses/>.

Please report any problems to bad . bots AT ioerror DOT us
http://www.bad-behavior.ioerror.us/
*/

###############################################################################
###############################################################################

// This file is the entry point for Bad Behavior.

if (!defined('MEDIAWIKI')) die();

$wgBadBehaviorTimer = false;

// Settings you can adjust for Bad Behavior.
// DO NOT EDIT HERE; instead make changes in settings.ini.
// These settings are used when settings.ini is not present.
$bb2_settings_defaults = array(
	'log_table' => $wgDBprefix . 'bad_behavior',
	'display_stats' => false,
	'strict' => false,
	'verbose' => false,
	'logging' => true,
	'httpbl_key' => '',
	'httpbl_threat' => '25',
	'httpbl_maxage' => '30',
	'offsite_forms' => false,
	'reverse_proxy' => false,
	'reverse_proxy_header' => 'X-Forwarded-For',
	'reverse_proxy_addresses' => array(),
);

define('BB2_CWD', dirname(__FILE__));

// Bad Behavior callback functions.
require_once("bad-behavior-mysql.php");

// Return current time in the format preferred by your database.
function bb2_db_date() {
	return gmdate('Y-m-d H:i:s');
}

// Return affected rows from most recent query.
function bb2_db_affected_rows($result) {
	$db = wfGetDB(DB_MASTER);
	return $db->affectedRows();
}

// Escape a string for database usage
function bb2_db_escape($string) {
	// TODO SECURITY: Convert to using safeQuery()
	return addslashes($string);
}

// Return the number of rows in a particular query.
function bb2_db_num_rows($result) {
	return $result->numRows();
}

// Run a query and return the results, if any.
// Should return FALSE if an error occurred.
function bb2_db_query($query) {
	$db = wfGetDB(DB_MASTER);
	try {
		$bb2_last_query = $db->query($query);
	} catch (DBQueryError $e) {
		trigger_error("Bad Behavior DBQueryError " . $e->getMessage(), E_USER_WARNING);
		return false;
	}
	return $bb2_last_query;
}

// Return all rows in a particular query.
// Should contain an array of all rows generated by calling mysql_fetch_assoc()
// or equivalent and appending the result of each call to an array.
function bb2_db_rows($result) {
	$rows = array();
	try {
		while ($row = $result->fetchRow()) {
			$rows[] = $row;
		}
	} catch (DBUnexpectedError $e) {
		trigger_error("Bad Behavior DBUnexpectedError " . $e->getMessage(), E_USER_WARNING);
	}
	return $rows;
}

// Return emergency contact email address.
function bb2_email() {
	global $wgEmergencyContact;
	return $wgEmergencyContact;
}

// retrieve whitelist
function bb2_read_whitelist() {
	return @parse_ini_file(dirname(BB2_CORE) . "/whitelist.ini");
}

// This Bad Behavior-related function is a stub. You can help MediaWiki by expanding it.
// retrieve settings from database
function bb2_read_settings() {
	global $bb2_settings_defaults;
	$settings = @parse_ini_file(dirname(__FILE__) . "/settings.ini");
	if (!$settings) $settings = array();
	return @array_merge($bb2_settings_defaults, $settings);
}

// This Bad Behavior-related function is a stub. You can help MediaWiki by expanding it.
// write settings to database
function bb2_write_settings($settings) {
	return;
}

// In some configurations automatic table creation may fail with the message
// You must update your load-balancing configuration.
// You can create the table manually (see query in
// bad-behavior/database.inc.php) and add this line to your LocalSettings.php:
//
//   define('BB2_NO_CREATE', true);

// installation
function bb2_install() {
	$settings = bb2_read_settings();
	if (defined('BB2_NO_CREATE')) return;
	if (!$settings['logging']) return;
	bb2_db_query(bb2_table_structure($settings['log_table']));
}

// Return the top-level relative path of wherever we are (for cookies)
function bb2_relative_path() {
	// TODO: This might not be the best way, but it seems to work
	global $wgScript;
	return dirname($wgScript) . "/";
}

// Cute timer display
function bb2_mediawiki_timer(&$out, &$skin) {
	global $bb2_timer_total, $wgBadBehaviorTimer;
	if ($wgBadBehaviorTimer) {
		$out->addHTML("<!-- Bad Behavior " . BB2_VERSION . " run time: " . number_format(1000 * $bb2_timer_total, 3) . " ms -->");
	}
	return true;
}

function bb2_mediawiki_entry() {
	global $bb2_timer_total;

	$bb2_mtime = explode(" ", microtime());
	$bb2_timer_start = $bb2_mtime[1] + $bb2_mtime[0];

	if (php_sapi_name() != 'cli') {
		bb2_install();	// FIXME: see above
		$settings = bb2_read_settings();
		// FIXME: Need to make this multi-DB compatible eventually
		$dbr = wfGetDB(DB_SLAVE);
		if (get_class($dbr) != "DatabaseMysql") {
			$settings['logging'] = false;
		}
		bb2_start($settings);
	}

	$bb2_mtime = explode(" ", microtime());
	$bb2_timer_stop = $bb2_mtime[1] + $bb2_mtime[0];
	$bb2_timer_total = $bb2_timer_stop - $bb2_timer_start;
}

require_once(BB2_CWD . "/bad-behavior/core.inc.php");
$wgExtensionCredits['other'][] = array(
	'name' => 'Bad Behavior',
	'version' => BB2_VERSION,
	'author' => 'Michael Hampton',
	'description' => 'Detects and blocks unwanted Web accesses',
	'url' => 'http://bad-behavior.ioerror.us/'
);

$wgHooks['BeforePageDisplay'][] = 'bb2_mediawiki_timer';
$wgExtensionFunctions[] = 'bb2_mediawiki_entry';
