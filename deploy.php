<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config
set('application', 'futbol_femeni');
set('repository', 'git@github.com:Proyecto-integrador-AJD/Back.git');
set('branch', 'Deployer');
set('git_tty', true);

add('shared_files', ['.env']);
add('shared_dirs', ['storage', 'bootstrap/cache']);
add('writable_dirs', ['storage', 'bootstrap/cache']);

// Hosts

host('44.215.212.155')
    ->set('remote_user', 'backend-user')
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/backend/html'); 

// Hooks

task('build', function () {
    run('cd {{release_path}} && build');
});

after('deploy:failed', 'deploy:unlock');

before('deploy:symlink', 'artisan:migrate');