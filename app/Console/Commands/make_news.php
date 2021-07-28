<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\News;
use Faker\Generator;
use Illuminate\Console\Command;
use Faker\Provider\ru_RU\Text as Fk;

class make_news extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:make_news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make test news';

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
        $company=Company::first();
        if(empty($company))return 0;
        $generator=new Generator();
        $faker=new Fk($generator);
        $news=new News();
        $news->title='Тестовая новость '. crc32(time());
        $news->content= $faker->realText(1000);
        $news->company_id=$company->id;
        $news->save();
        $this->info('Новость создана!');
        return 0;
    }
}
