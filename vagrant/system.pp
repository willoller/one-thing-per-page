group { "puppet":
  ensure => "present",
}

class rsyslog {
  package { 'rsyslog':
    ensure => installed,
  }
  service { 'rsyslog':
    ensure => running,
    enable => true,
  }
}

class system {
  package { "vim":
    ensure => present,
  }

  package { "git":
    ensure => present,
  }
}

class { 'apt':
  always_apt_update => true,
}

apt::ppa { 'ppa:ondrej/php5-oldstable': }

class ruby {
  package { ["ruby", "rake"]:
    ensure => present,
    require => Class["system"],
  }
  package { 'wkhtmltopdf-binary':
    ensure => present,
    provider => 'gem',
  }
}

class php {
  package { ["php5-mysql", "php5-curl", "php5-xdebug", "php5-mcrypt", "php5-cli", "php5-gd"]:
    ensure  => present,
    require => Apt::Ppa["ppa:ondrej/php5-oldstable"],
  }
}

apache::mod { ['php5', 'rewrite', 'headers']: }

apache::vhost { 'dev.onethingperpage.com':
  priority           => '10',
  port               => '80',
  docroot            => '/var/www/web/',
  loglevel           => 'debug',
  logroot            => '/var/log/onethingperpage.com/',
  configure_firewall => false,
  override           => 'All',
  docroot_owner      => 'vagrant',
  docroot_group      => 'vagrant',
  serveraliases      => [
    'dev.onethingperpage.com',
    'dev.theinspectionhub.com',
  ],
}

include apt
include apache
include rsyslog
include system
include php
include pear
include ruby

# vim: set tabstop=2 shiftwidth=2 softtabstop=2

