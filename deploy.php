<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'grasshopper');

// Project repository
set('repository', 'git@github.com:entap/laravel-template.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env', 'firebase-credentials.json']);
add('shared_dirs', ['storage']);

// Writable dirs by web server
add('writable_dirs', ['bootstrap/cache', 'storage']);

// Hosts

host('grasshopper.entap.works')
    ->stage('development')
    ->user('grasshopper')
    ->set('deploy_path', '~/{{application}}')
    ->set('writable_mode', 'chmod');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

desc('Upload local .env file.');
task('deploy:dotenv', function () {
    $src = __DIR__ . '/.env.{{target}}';
    $dst = '{{deploy_path}}/shared/.env';
    $hostname = '{{hostname}}';
    upload($src, $dst);
    writeln("uploaded {$src} to {$hostname}:{$dst}");
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
