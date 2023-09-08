<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/slack.php';

inventory('config/servers.yml');

// Project name
set('application','marinesTeam26');

// Project repository
set('repository','git@github.com:HOT-FACTORY/marinesTeam26.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', [
]);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', [
]);

set('keep_releases', 3);

// Tasks
task('set_branch', function(){
    $stage = null;
    if (input()->hasArgument('stage')) {
        $stage = input()->getArgument('stage');
    }
    if ($stage == 'production') {
        $branch = 'main';
    } else if ($stage == 'staging') {
        $branch = input()->getOption('branch');
        if (empty($branch)) {
            $branch = 'stg';
        }
    }
    set('branch', $branch);
});
before('deploy', 'set_branch');

task('refresh_release_path', function() {
    set('release_path', '/var/www/site/releases/{{release_name}}/laravel');
});
after('deploy:update_code', 'refresh_release_path');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

// slack
set('slack_webhook', 'https://hooks.slack.com/services/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');
set('slack_title', 'marinesTeam26 Deployer');
after('set_branch', 'slack:notify');
after('success', 'slack:notify:success');
after('deploy:failed', 'slack:notify:failure');
after('rollback', 'slack:notify:rollback');

// nginx,php再起動
after('success', 'nginx_reload');
task('nginx_reload', function () {
    run('sudo systemctl reload php81-php-fpm');
    run('sudo systemctl reload nginx');
});

