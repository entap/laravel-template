<?php

namespace App\Console\Commands\Examples;

use App\Models\Admin\MailType;
use Illuminate\Console\Command;
use App\Models\Admin\MailTemplate;
use App\Services\SendMailTemplateService;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'example:mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send e-mail example';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = MailType::factory()->create();
        $template = MailTemplate::factory()->create([
            'mail_type_id' => $type->id,
            'subject' => 'Hi, {company.name}.',
            'body' => '{company.name} is great!',
        ]);
        (new SendMailTemplateService())->sendByTypeCode($type->code, [
            'company' => [
                'name' => 'Entap',
            ],
        ]);

        return 0;
    }
}
