<?php

require_once __DIR__ . '/recipe/common.php';

set('shared_dirs', ['storage', 'node_modules']);

set('shared_files', ['.env']);

set('writable_dirs', ['storage', 'vendor']);

set('repository', 'git@github.com:faizshukri/katsitu.git');

server('prod', 'direct.katsitu.com', 22)
    ->user('root')
    ->forwardAgent()
    ->stage('production')
    ->env('branch', 'master')
    ->env('deploy_path', '/vhosts/katsitu.com');

task('deploy:vendorscripts', function(){
    run('cd {{release_path}} && php artisan clear-compiled && php artisan optimize && php artisan migrate');
});

task('deploy:postlaravel', function(){
    run('cd {{release_path}} && npm install');
});

task('deploy:buildasset', function(){
    run('cd {{release_path}} && bower install --allow-root && node node_modules/gulp/bin/gulp.js --production');
});

task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:vendorscripts',
    'deploy:postlaravel',
    'deploy:buildasset',
    'deploy:symlink',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');