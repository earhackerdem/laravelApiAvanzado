<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NewsletterNotification;
use Illuminate\Console\Command;

class SendNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter {emails?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo electronico';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $userEmails = $this->argument('emails');

        $builder = User::query();

        if ($userEmails) {

            $builder->whereIn('email', $userEmails);
        }

        $builder->whereNotNull('email_verified_at');

        if ($count = $builder->count()) {

            $this->info("Se enviaran {$count} correos");

            if ($this->confirm('¿Estas de acuerdo?')) {

                $this->output->progressStart($count);

                $builder->each(function (User $user) {

                    $user->notify(new NewsletterNotification());

                    $this->output->progressAdvance();
                });

                $this->info(" Se enviaron {$count} correos");

                $this->output->progressFinish();

            } else {
                $this->info('No se envío ningún correo');
            }
        } else {

            $this->info('No se envío ningún correo');
        }
    }
}
