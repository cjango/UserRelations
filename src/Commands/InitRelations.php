<?php

namespace Jason\UserRelation\Commands;

use Jason\UserRelation\Models\UserRelation;
use Illuminate\Console\Command;

class InitRelations extends Command
{

    protected $signature = 'user:relation';

    protected $description = 'Init users relation';

    private $directory;

    public function handle()
    {
        $this->info('Find all users.');

        $class = config('relation.user_model');
        $model = new $class;
        $this->info('There are ' . $model->count() . ' users');

        foreach ($model->get() as $user) {
            UserRelation::firstOrCreate([
                'user_id' => $user->id,
            ], [
                'parent_id' => config('relation.default_parent_id'),
                'bloodline' => config('relation.default_parent_id') . ',',
                'layer'     => 1,
            ]);
            $this->info('Synced user : ' . $user->id);
        }

        $this->info('Init users relation success.');
    }
}
