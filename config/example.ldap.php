<?php

return [
    // The domain controllers option is an array of your LDAP hosts. You can
    // use the either the host name or the IP address of your host.
    'domain_controllers'    => ['ACME-DC01.corp.acme.org', '192.168.1.1'],

    // The base distinguished name of your domain.
    'base_dn'               => 'dc=corp,dc=acme,dc=org',

    // The account to use for querying / modifying LDAP records. This
    // does not need to be an actual admin account. This can also
    // be a full distinguished name of the user account.
    'admin_username'        => 'admin@corp.acme.org',
    'admin_password'        => 'password',
];