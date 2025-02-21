<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config
set('keep_releases', 3);
set('composer_options', '--verbose --prefer-dist --no-progress --no-interaction');
set('application', 'teleasistencia_projecte');
set('repository', 'git@github.com:Proyecto-integrador-AJD/Back.git');
set('branch', 'ADMIN');
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

task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php8.3-fpm restart');
});

task('deploy:build_assets', function () {
    run('cd {{release_path}} && npm install');
    run('cd {{release_path}} && npm run build');
});

task('artisan:db:seed', function () {
    run('{{bin/php}} {{release_path}}/artisan migrate:refresh --seed --force');
});

task('artisan:route:clear', function () {
    run('{{bin/php}} {{release_path}}/artisan route:clear');
});

before('artisan:route:cache', 'artisan:route:clear');

after('deploy', 'reload:php-fpm');
after('deploy:failed', 'deploy:unlock');
after('deploy:update_code', 'deploy:build_assets');
before('deploy:symlink', 'artisan:db:seed');