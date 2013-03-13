<?php
/**
 * MYRegexSearch
 * https://github.com/zackz/MYRegexSearch
 */

if ( !defined( 'MEDIAWIKI' ) ) die();

$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'name' => 'MYRegexSearch',
	'version' => '0.1.0',
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





