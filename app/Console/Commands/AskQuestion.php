<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AskQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ask-question';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $name = $this->ask('What is your name?');

        // $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);

        $name = $this->choice(
            'What is your name?',
            ['Taylor', 'Dayle']
        );

        $this->info("You chose: $name");
    }
}
