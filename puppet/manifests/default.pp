exec { 'apt-get update' :
    command => 'apt-get update',
    path    => '/usr/bin/',
    timeout => 60,
    tries   => 3
}

class { 'apt' :
    always_apt_update => true
}

package { ['build-essential', 'python-software-properties',
           'vim', 'curl'] :
    ensure  => 'installed',
    require => Exec['apt-get update'],
}

#file { '/home/vagrant/.bash_aliases' :
#    source => 'puppet:///modules/puphpet/dot/.bash_aliases',
#    ensure => 'present',
#}

apt::ppa { 'ppa:ondrej/php5' :
    before  => Class['php']
}

#git::repo { 'puphpet' :
#    path   => '/home/vagrant/shared/puphpet.dev/',
#    source => 'https://github.com/jtreminio/Puphpet.git'
#}

class { 'apache' :
    require => Apt::Ppa['ppa:ondrej/php5'],
}

apache::dotconf { 'custom' :
    content => 'EnableSendfile Off',
}

apache::module { 'rewrite' : }

#apache::vhost { 'puphpet' :
#    server_name   => 'puphpet.dev',
#    serveraliases => ['www.puphpet.dev',],
#    docroot       => '/home/vagrant/shared/puphpet/web',
#    port          => '80',
#    env_variables => { 'APP_ENV' => 'dev' },
#    priority      => '1',
#    require       => Git::Repo['puphpet']
#}

class { 'git' :
    svn => true,
    gui => false,
}

class { 'php' :
    service => 'apache',
    require => Package['apache'],
}

php::module { 'cli' : }
php::module { 'curl' : }
php::module { 'intl' : }
php::module { 'mcrypt' : }
php::module { 'mysql' : }

class { 'php::pear' :
    require => Class['php'],
}

class { 'php::devel' :
    require => Class['php'],
}

php::pecl::module { 'pecl_http' :
    use_package => false
}

php::ini { 'default' :
    value    => [
        'date.timezone = America/Chicago',
        'display_errors = On',
        'error_reporting = -1'
    ],
    target   => 'error_reporting.ini'
}

class { 'xdebug' : }

xdebug::config { 'cgi' : }
xdebug::config { 'cli' : }

class { 'php::composer': }

#php::composer::run { 'puphpet':
#    path    => '/home/vagrant/shared/puphpet.dev/',
#    require => Git::Repo['puphpet']
#}

apache::vhost { 'mww' :
    server_name   => 'mww.dev',
    serveraliases => ['www.mww.dev',],
    docroot       => '/home/vagrant/shared',
    port          => '80',
    priority      => '1'
}

class { 'mysql':
  root_password => 'root',
}

mysql::grant { 'McCaffreyWoodworking':
  mysql_privileges     => 'ALL',
  mysql_db             => 'McCaffreyWoodworking',
  mysql_user           => 'mwwadmin',
  mysql_password       => 'mwwadmin',
  mysql_host           => 'localhost',
#  mysql_grant_filepath => '/home/vagrant/puppet-mysql',
}

