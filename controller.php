<?php
use App\Models\User;

require_once __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$input = new Symfony\Component\Console\Input\ArgvInput;
$output = new Symfony\Component\Console\Output\ConsoleOutput;
$kernel->bootstrap();
$status = 422;
$message = 'Invalid id';

if (isset($argv[1]) && isset($argv[2])) {

    if(is_numeric($argv[1])) {

        if ($user = User::find($argv[1])) {

            $comments = '';
            for ($i = 2; $i < sizeof($argv); $i++) {
                $comments = "$comments $argv[$i]";
            }
            $user->comments = $comments;
            try {
                $message = 'OK';
                $status = 200;
                $user->save();
            } catch (Exception $exception) {
                $message = 'Could not update database: '.$exception->getMessage();
                $status = 500;
            }
        } else {
            $status = 404;
            $message = "No such user ($argv[1])";
        }

    }

} else {
    $message = "Please specify ID and COMMENTS";
}

$output->writeln($message);
$kernel->terminate($input, $status);
exit($status);
