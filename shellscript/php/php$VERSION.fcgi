#php$VERSION.fcgi file sample

#!/bin/bash
PHP_CGI=/opt/php72/bin/php-cgi
PHP_FCGI_CHILDREN=2
PHP_FCGI_MAX_REQUESTS=1000
PHPRC="/opt/apache24/"

export PHP_CGI
export PHP_FCGI
export PHP_FCGI_MAX_REQUESTS

exec $PHP_CGI
