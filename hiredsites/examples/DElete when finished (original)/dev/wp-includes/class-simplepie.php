<?php
if ( !class_exists( 'SimplePie' ) ) :
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2009, Ryan Parman and Geoffrey Sneddon
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @version 1.2
 * @copyright 2004-2009 Ryan Parman, Geoffrey Sneddon
 * @author Ryan Parman
 * @author Geoffrey Sneddon
 * @link http://simplepie.org/ SimplePie
 * @link http://simplepie.org/support/ Please submit all bug reports and feature requests to the SimplePie forums
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @todo phpDoc comments
 */

/**
 * SimplePie Name
 */
define('SIMPLEPIE_NAME', 'SimplePie');

/**
 * SimplePie Version
 */
define('SIMPLEPIE_VERSION', '1.2');

/**
 * SimplePie Build
 */
define('SIMPLEPIE_BUILD', '20090627192103');

/**
 * SimplePie Website URL
 */
define('SIMPLEPIE_URL', 'http://simplepie.org');

/**
 * SimplePie Useragent
 * @see SimplePie::set_useragent()
 */
define('SIMPLEPIE_USERAGENT', SIMPLEPIE_NAME . '/' . SIMPLEPIE_VERSION . ' (Feed Parser; ' . SIMPLEPIE_URL . '; Allow like Gecko) Build/' . SIMPLEPIE_BUILD);

/**
 * SimplePie Linkback
 */
define('SIMPLEPIE_LINKBACK', '<a href="' . SIMPLEPIE_URL . '" title="' . SIMPLEPIE_NAME . ' ' . SIMPLEPIE_VERSION . '">' . SIMPLEPIE_NAME . '</a>');

/**
 * No Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_NONE', 0);

/**
 * Feed Link Element Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_AUTODISCOVERY', 1);

/**
 * Local Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_EXTENSION', 2);

/**
 * Local Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_BODY', 4);

/**
 * Remote Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_EXTENSION', 8);

/**
 * Remote Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_BODY', 16);

/**
 * All Feed Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_ALL', 31);

/**
 * No known feed type
 */
define('SIMPLEPIE_TYPE_NONE', 0);

/**
 * RSS 0.90
 */
define('SIMPLEPIE_TYPE_RSS_090', 1);

/**
 * RSS 0.91 (Netscape)
 */
define('SIMPLEPIE_TYPE_RSS_091_NETSCAPE', 2);

/**
 * RSS 0.91 (Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091_USERLAND', 4);

/**
 * RSS 0.91 (both Netscape and Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091', 6);

/**
 * RSS 0.92
 */
define('SIMPLEPIE_TYPE_RSS_092', 8);

/**
 * RSS 0.93
 */
define('SIMPLEPIE_TYPE_RSS_093', 16);

/**
 * RSS 0.94
 */
define('SIMPLEPIE_TYPE_RSS_094', 32);

/**
 * RSS 1.0
 */
define('SIMPLEPIE_TYPE_RSS_10', 64);

/**
 * RSS 2.0
 */
define('SIMPLEPIE_TYPE_RSS_20', 128);

/**
 * RDF-based RSS
 */
define('SIMPLEPIE_TYPE_RSS_RDF', 65);

/**
 * Non-RDF-based RSS (truly intended as syndication format)
 */
define('SIMPLEPIE_TYPE_RSS_SYNDICATION', 190);

/**
 * All RSS
 */
define('SIMPLEPIE_TYPE_RSS_ALL', 255);

/**
 * Atom 0.3
 */
define('SIMPLEPIE_TYPE_ATOM_03', 256);

/**
 * Atom 1.0
 */
define('SIMPLEPIE_TYPE_ATOM_10', 512);

/**
 * All Atom
 */
define('SIMPLEPIE_TYPE_ATOM_ALL', 768);

/**
 * All feed types
 */
define('SIMPLEPIE_TYPE_ALL', 1023);

/**
 * No construct
 */
define('SIMPLEPIE_CONSTRUCT_NONE', 0);

/**
 * Text construct
 */
define('SIMPLEPIE_CONSTRUCT_TEXT', 1);

/**
 * HTML construct
 */
define('SIMPLEPIE_CONSTRUCT_HTML', 2);

/**
 * XHTML construct
 */
define('SIMPLEPIE_CONSTRUCT_XHTML', 4);

/**
 * base64-encoded construct
 */
define('SIMPLEPIE_CONSTRUCT_BASE64', 8);

/**
 * IRI construct
 */
define('SIMPLEPIE_CONSTRUCT_IRI', 16);

/**
 * A construct that might be HTML
 */
define('SIMPLEPIE_CONSTRUCT_MAYBE_HTML', 32);

/**
 * All constructs
 */
define('SIMPLEPIE_CONSTRUCT_ALL', 63);

/**
 * Don't change case
 */
define('SIMPLEPIE_SAME_CASE', 1);

/**
 * Change to lowercase
 */
define('SIMPLEPIE_LOWERCASE', 2);

/**
 * Change to uppercase
 */
define('SIMPLEPIE_UPPERCASE', 4);

/**
 * PCRE for HTML attributes
 */
define('SIMPLEPIE_PCRE_HTML_ATTRIBUTE', '((?:[\x09\x0A\x0B\x0C\x0D\x20]+[^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3D\x3E]*(?:[\x09\x0A\x0B\x0C\x0D\x20]*=[\x09\x0A\x0B\x0C\x0D\x20]*(?:"(?:[^"]*)"|\'(?:[^\']*)\'|(?:[^\x09\x0A\x0B\x0C\x0D\x20\x22\x27\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x3E]*)?))?)*)[\x09\x0A\x0B\x0C\x0D\x20]*');

/**
 * PCRE for XML attributes
 */
define('SIMPLEPIE_PCRE_XML_ATTRIBUTE', '((?:\s+(?:(?:[^\s:]+:)?[^\s:]+)\s*=\s*(?:"(?:[^"]*)"|\'(?:[^\']*)\'))*)\s*');

/**
 * XML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XML', 'http://www.w3.org/XML/1998/namespace');

/**
 * Atom 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_10', 'http://www.w3.org/2005/Atom');

/**
 * Atom 0.3 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_03', 'http://purl.org/atom/ns#');

/**
 * RDF Namespace
 */
define('SIMPLEPIE_NAMESPACE_RDF', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');

/**
 * RSS 0.90 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_090', 'http://my.netscape.com/rdf/simple/0.9/');

/**
 * RSS 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10', 'http://purl.org/rss/1.0/');

/**
 * RSS 1.0 Content Module Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10_MODULES_CONTENT', 'http://purl.org/rss/1.0/modules/content/');

/**
 * RSS 2.0 Namespace
 * (Stupid, I know, but I'm certain it will confuse people less with support.)
 */
define('SIMPLEPIE_NAMESPACE_RSS_20', '');

/**
 * DC 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_10', 'http://purl.org/dc/elements/1.0/');

/**
 * DC 1.1 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_11', 'http://purl.org/dc/elements/1.1/');

/**
 * W3C Basic Geo (WGS84 lat/long) Vocabulary Namespace
 */
define('SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO', 'http://www.w3.org/2003/01/geo/wgs84_pos#');

/**
 * GeoRSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_GEORSS', 'http://www.georss.org/georss');

/**
 * Media RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS', 'http://search.yahoo.com/mrss/');

/**
 * Wrong Media RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG', 'http://search.yahoo.com/mrss');

/**
 * iTunes RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_ITUNES', 'http://www.itunes.com/dtds/podcast-1.0.dtd');

/**
 * XHTML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XHTML', 'http://www.w3.org/1999/xhtml');

/**
 * IANA Link Relations Registry
 */
define('SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY', 'http://www.iana.org/assignments/relation/');

/**
 * Whether we're running on PHP5
 */
define('SIMPLEPIE_PHP5', version_compare(PHP_VERSION, '5.0.0', '>='));

/**
 * No file source
 */
define('SIMPLEPIE_FILE_SOURCE_NONE', 0);

/**
 * Remote file source
 */
define('SIMPLEPIE_FILE_SOURCE_REMOTE', 1);

/**
 * Local file source
 */
define('SIMPLEPIE_FILE_SOURCE_LOCAL', 2);

/**
 * fsockopen() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FSOCKOPEN', 4);

/**
 * cURL file source
 */
define('SIMPLEPIE_FILE_SOURCE_CURL', 8);

/**
 * file_get_contents() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FILE_GET_CONTENTS', 16);

/**
 * SimplePie
 *
 * @package SimplePie
 */
class SimplePie
{
	/**
	 * @var array Raw data
	 * @access private
	 */
	var $data = array();

	/**
	 * @var mixed Error string
	 * @access private
	 */
	var $error;

	/**
	 * @var object Instance of SimplePie_Sanitize (or other class)
	 * @see SimplePie::set_sanitize_class()
	 * @access private
	 */
	var $sanitize;

	/**
	 * @var string SimplePie Useragent
	 * @see SimplePie::set_useragent()
	 * @access private
	 */
	var $useragent = SIMPLEPIE_USERAGENT;

	/**
	 * @var string Feed URL
	 * @see SimplePie::set_feed_url()
	 * @access private
	 */
	var $feed_url;

	/**
	 * @var object Instance of SimplePie_File to use as a feed
	 * @see SimplePie::set_file()
	 * @access private
	 */
	var $file;

	/**
	 * @var string Raw feed data
	 * @see SimplePie::set_raw_data()
	 * @access private
	 */
	var $raw_data;

	/**
	 * @var int Timeout for fetching remote files
	 * @see SimplePie::set_timeout()
	 * @access private
	 */
	var $timeout = 10;

	/**
	 * @var bool Forces fsockopen() to be used for remote files instead
	 * of cURL, even if a new enough version is installed
	 * @see SimplePie::force_fsockopen()
	 * @access private
	 */
	var $force_fsockopen = false;

	/**
	 * @var bool Force the given data/URL to be treated as a feed no matter what
	 * it appears like
	 * @see SimplePie::force_feed()
	 * @access private
	 */
	var $force_feed = false;

	/**
	 * @var bool Enable/Disable XML dump
	 * @see SimplePie::enable_xml_dump()
	 * @access private
	 */
	var $xml_dump = false;

	/**
	 * @var bool Enable/Disable Caching
	 * @see SimplePie::enable_cache()
	 * @access private
	 */
	var $cache = true;

	/**
	 * @var int Cache duration (in seconds)
	 * @see SimplePie::set_cache_duration()
	 * @access private
	 */
	var $cache_duration = 3600;

	/**
	 * @var int Auto-discovery cache duration (in seconds)
	 * @see SimplePie::set_autodiscovery_cache_duration()
	 * @access private
	 */
	var $autodiscovery_cache_duration = 604800; // 7 Days.

	/**
	 * @var string Cache location (relative to executing script)
	 * @see SimplePie::set_cache_location()
	 * @access private
	 */
	var $cache_location = './cache';

	/**
	 * @var string Function that creates the cache filename
	 * @see SimplePie::set_cache_name_function()
	 * @access private
	 */
	var $cache_name_function = 'md5';

	/**
	 * @var bool Reorder feed by date descending
	 * @see SimplePie::enable_order_by_date()
	 * @access private
	 */
	var $order_by_date = true;

	/**
	 * @var mixed Force input encoding to be set to the follow value
	 * (false, or anything type-cast to false, disables this feature)
	 * @see SimplePie::set_input_encoding()
	 * @access private
	 */
	var $input_encoding = false;

	/**
	 * @var int Feed Autodiscovery Level
	 * @see SimplePie::set_autodiscovery_level()
	 * @access private
	 */
	var $autodiscovery = SIMPLEPIE_LOCATOR_ALL;

	/**
	 * @var string Class used for caching feeds
	 * @see SimplePie::set_cache_class()
	 * @access private
	 */
	var $cache_class = 'SimplePie_Cache';

	/**
	 * @var string Class used for locating feeds
	 * @see SimplePie::set_locator_class()
	 * @access private
	 */
	var $locator_class = 'SimplePie_Locator';

	/**
	 * @var string Class used for parsing feeds
	 * @see SimplePie::set_parser_class()
	 * @access private
	 */
	var $parser_class = 'SimplePie_Parser';

	/**
	 * @var string Class used for fetching feeds
	 * @see SimplePie::set_file_class()
	 * @access private
	 */
	var $file_class = 'SimplePie_File';

	/**
	 * @var string Class used for items
	 * @see SimplePie::set_item_class()
	 * @access private
	 */
	var $item_class = 'SimplePie_Item';

	/**
	 * @var string Class used for authors
	 * @see SimplePie::set_author_class()
	 * @access private
	 */
	var $author_class = 'SimplePie_Author';

	/**
	 * @var string Class used for categ