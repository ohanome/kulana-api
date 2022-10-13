<?php
namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', '');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('production')
    ->set('hostname', '')
    ->set('remote_user', '')
    ->set('deploy_path', '');

// Hooks

after('deploy:failed', 'deploy:unlock');
