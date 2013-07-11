<?php

require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

class AppCache extends HttpCache
{
	protected function getOptions()
	{
		return array(
				'debug'                  => false,
				// default_ttl: The number of seconds that a cache entry should be considered fresh when no explicit freshness information is provided in a response.
				// Explicit Cache-Control or Expires headers override this value (default: 0);
				'default_ttl'            => 0,
				// private_headers: Set of request headers that trigger "private" Cache-Control behavior on responses that don't explicitly state whether the response
				// is public or private via a Cache-Control directive. (default: Authorization and Cookie);
				'private_headers'        => array('Authorization', 'Cookie'),
				// allow_reload: Specifies whether the client can force a cache reload by including a Cache-Control "no-cache" directive in the request.
				// Set it to true for compliance with RFC 2616 (default: false);
				'allow_reload'           => true,
				// allow_revalidate: Specifies whether the client can force a cache revalidate by including a Cache-Control "max-age=0" directive in the request.
				// Set it to true for compliance with RFC 2616 (default: false);
				'allow_revalidate'       => true,
				// stale_while_revalidate: Specifies the default number of seconds (the granularity is the second as the Response TTL precision is a second)
				// during which the cache can immediately return a stale response while it revalidates it in the background (default: 2); this setting is overridden by the stale-while-revalidate HTTP Cache-Control extension (see RFC 5861);
				'stale_while_revalidate' => 2,
				// stale_if_error: Specifies the default number of seconds (the granularity is the second) during which the cache can serve a stale response
				//when an error is encountered (default: 60). This setting is overridden by the stale-if-error HTTP Cache-Control extension (see RFC 5861).
				'stale_if_error'         => 60,
		);
	}	
}
