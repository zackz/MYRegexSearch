<?php
/**
 * MYRegexSearch
 * https://github.com/zackz/MYRegexSearch
 *
 * History:
 * 0.2.0
 * Output elapsed time, and automatically set focus to edit control.
 * 0.1.0
 * Basic regular expressions searching.
 */

if ( !defined( 'MEDIAWIKI' ) ) die();

$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'name' => 'MYRegexSearch',
	'version' => '0.2.0',
	'author' => array( 'Zack Zhou' ),
	'url' => 'https://github.com/zackz/MYRegexSearch',
	'descriptionmsg'  => 'myregexsearch-desc',
);

$dir = dirname( __FILE__ ) . '/';
$wgExtensionMessagesFiles['MYRegexSearch'] = $dir . 'MYRegexSearch.i18n.php';

$wgAvailableRights[] = 'myregexsearch';
$wgGroupPermissions['sysop']['myregexsearch'] = true;

$wgSpecialPages['MYRegexSearch'] = 'MYRegexSearch';
$wgAutoloadClasses['MYRegexSearch'] = $dir . 'MYRegexSearch.class.php';
$wgSpecialPageGroups['MYRegexSearch'] = 'wiki';





