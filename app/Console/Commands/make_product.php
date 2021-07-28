<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Provider\ru_RU\Text as Fk;
use Faker\Generator;
use App\Models\Company;
use App\Models\Product;

class make_product extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:make_product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make test product';

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
        $product=new Product();
        $product->name='Тестовый товар '. crc32(time());
        $product->company_id=$company->id;
        $product->price=mt_rand(1,100000);
        $product->save();
        $this->info('Товар создан!');
        return 0;
    }
}
