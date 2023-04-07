<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailVerificationReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder {method=user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo electronico a los usuarios que no han verificado su cuenta despues de haberse registraod hace una semana';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $method  = $this->argument('method');

        if ($method !== 'user') {

            $this->handleforApi();

        } else {

            $this->handleForUser();
        }
    }

    public function handleforApi()
    {

        $builder = User::query()
            ->whereDate('created_at', '=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->whereNull('email_verified_at');

        if ($builder->count()) {

            $builder->each(function (User $user) {

                $user->sendEmailVerificationNotification();
            });
        }
    }

    public function handleForUser()
    {

        $builder = User::query()
            ->whereDate('created_at', '=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->whereNull('email_verified_at');

        if ($count = $builder->count()) {

            $this->info("Se enviaran {$count} correos");

            if ($this->confirm('¿Estas de acuerdo?')) {

                $this->output->progressStart($count);

                $builder->each(function (User $user) {

                    $user->sendEmailVerificationNotification();

                    $this->output->progressAdvance();
                });

                $this->info(" Se enviaron {$count} correos");

                $this->output->progressFinish();
            } else {

                $this->info('Operación cancelada. No se envío ningún correo');
            }
        } else {
            $this->info('No hay correos por enviar');
        }
    }
}
