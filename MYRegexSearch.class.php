<?php
/**
 * MYRegexSearch
 * https://github.com/zackz/MYRegexSearch
 */

class MYRegexSearch extends QueryPage {

	function __construct( $name = 'MYRegexSearch' ) {
		parent::__construct( $name );
	}

	function execute( $par ) {
		$this->setHeaders();
		$this->outputHeader();
		$out = $this->getOutput();
		$out->addModuleStyles( 'mediawiki.special' );
		$out->allowClickjacking();
		$out->addHTML(
			Xml::openElement( 'form', array( 'id' => 'myregexsearch-form',
				'method' => 'get', 'action' => $GLOBALS['wgScript'] ) ) .
			Html::hidden( 'title', $this->getTitle()->getPrefixedDbKey() ) .
			Xml::input( 'target', 50, $this->getTarget() ) . ' ' .
			Xml::submitButton( $this->msg( 'myregexsearch-ok' )->text() ) .
			' ' .
			Linker::makeExternalLink(
				'http://dev.mysql.com/doc/refman/5.5/en/regexp.html', 'MySQL' ) .
			' ' .
			Linker::makeExternalLink(
				'http://www.php.net/manual/en/reference.pcre.pattern.syntax.php', 'PCRE' ) .
			Xml::closeElement( 'form' ) .
			"\n"
		);

		if ( $this->getTarget() ) {
			$res = parent::execute( $par );
			// TODO: Output elapsed time...
			return $res;
		}
		return 0;
	}

	function getOrderFields() {
		return array( 'rev_timestamp' );
	}

	function sortDescending() {
		return true;
	}

	function getQueryInfo() {
		$retval = array (
			'tables' => array ( 'page', 'revision', 'text' ),
			'fields' => array(
				'title' => 'page_title',
				'namespace' => 'page_namespace',
				'text' => 'old_text',
				'timestamp' => 'rev_timestamp',
			),
			'conds' => array(
				'rev_id = page_latest',
				'rev_text_id = old_id',
				'CONVERT(old_text USING UTF8) REGEXP ' .
					wfGetDB( DB_SLAVE )->addQuotes( $this->getTarget() ),
			),
		);
		return $retval;
	}

	function formatResult( $skin, $result ) {
		$title = Title::makeTitleSafe( $result->namespace, $result->title );
		$retval = Linker::linkKnown( $title ) .
			'<span class="mw-search-result-data"> - ' .
			$this->getLanguage()->userTimeAndDate( $result->timestamp, $this->getUser() ) .
			"</span><br />\n";

		$target = $this->getTarget();
		$d = MYRegexSearch::getProperDelimiter( $target );
		preg_match_all( "{$d}.*(?:{$target}).*{$d}iu", $result->text, $lines);

		// Hightlight matched text, escape special chars, and display them all.
		foreach ( $lines[0] as $line ) {
			preg_match_all( "{$d}{$target}{$d}iu", $line, $matches, PREG_OFFSET_CAPTURE);
			$lastpos = 0;  // Byte offset
			foreach ( $matches[0] as $_ ) {
				$retval .= htmlspecialchars( substr( $line, $lastpos, $_[1] - $lastpos ) ) .
					'<span class="searchmatch">' . htmlspecialchars( $_[0] ) . '</span>';
				$lastpos = $_[1] + strlen($_[0]);
			}
			$retval .= htmlspecialchars( substr( $line, $lastpos ) ) . "<br />\n";
		}
		return $retval;
	}

	static function getProperDelimiter( $pattern ) {
		$delimiters = '~!@#$%^&*()';
		for ( $i = 0; $i < strlen($delimiters); $i++ ) {
			$d = $delimiters[$i];
			if ( strpos( $pattern, $d ) === false ) {
				return $d;
			}
		}
		return '/';
	}

	function getTarget() {
		return $this->getRequest()->getVal( 'target' );
	}

	function linkParameters() {
		return array( 'target' => $this->getTarget() );
	}

	function isExpensive() {
		return true;
	}

	public function isCacheable() {
		return false;
	}

	function isCached() {
		return false;
	}

	function isSyndicated() {
		return false;
	}
}


