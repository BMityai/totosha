<?php

namespace App\Console\Commands;

use App\Product;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';
    /**
     * @var Client
     */
    private $elasticsearch;

    /**
     * Create a new command instance.
     *
     * @param Client $elasticsearch
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');
        foreach (Product::cursor() as $product) {
            $this->elasticsearch->index(
                [
                    'index' => $product->getSearchIndex(),
                    'type'  => $product->getSearchType(),
                    'id'    => $product->getKey(),
                    'body'  => $product->toSearchArray(),
                ]
            );
            $this->output->write('.');
        }
        $this->info('\nDone!');
    }
}
