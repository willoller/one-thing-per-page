# == Class: php::composer
#
# Install composer package manager
#
# === Parameters
#
# No parameters
#
# === Variables
#
# No variables
#
# === Examples
#
#  include php::composer
#
# === Authors
#
# Christian "Jippi" Winther <jippignu@gmail.com>
#
# === Copyright
#
# Copyright 2012-2013 Christian "Jippi" Winther, unless otherwise noted.
#
class php::composer {

  exec { 'download composer':
    command => 'wget http://getcomposer.org/composer.phar -O /usr/local/bin/composer',
    creates => '/usr/local/bin/composer',
    path    => [ '/bin/', '/sbin/' , '/usr/bin/', '/usr/sbin/' ];
  }

  file { '/usr/local/bin/composer':
    mode    => '0555',
    owner   => root,
    group   => root,
    require => Exec['download composer']
  }
}
