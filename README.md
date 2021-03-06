MYRegexSearch
=============

MYRegexSearch is a MediaWiki extension for searching all pages with regular
expressions. 

![screenshot](https://github.com/zackz/MYRegexSearch/raw/master/screenshot.png)

Before installation
-------------------

MYRegexSearch was created for finding exact text I had wrote in my wiki which 
is for personal knowledge management. Since the PKM wiki was used only by
myself, there is less consideration about proformance/security/concurrency... yet.
The main task of MYRegexSearch is finding text and display them well.

How to use
----------

* Tested environment: mediawiki 1.20.3 1.23.9 / mysql 5.5.29 / php 5.3.10
  * Not used any new features in MYRegexSearch. Mediawiki must be 1.18+ though.
* Put all files into mediawiki extension directory, such as:

```
/var/www/mediawiki-1.20.3/extensions/MYRegexSearch
```

* Add one line to LocalSettings.php

```php
require_once( "$IP/extensions/MYRegexSearch/MYRegexSearch.php" );
```

* Once you have successfully installed MYRegexSearch, it will appear in
"Special pages --> Data and tools"

More
----

* [More about finding stuff in MediaWiki](https://gist.github.com/zackz/5381253)
