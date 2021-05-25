<?php

namespace Database\Seeders;

use App\Domains\Master\Models\Cluster;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class ClusterSeeder.
 */
class ClusterSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('cluster');

        if (app()->environment(['local', 'testing'])) {
            Cluster::create([
                'nama' => 'cluster 1',
                'formula' => '[a-i]',
            ]);
            Cluster::create([
                'nama' => 'cluster 2',
                'formula' => '[j-r]',
            ]);
            Cluster::create([
                'nama' => 'cluster 3',
                'formula' => '[s-z]',
            ]);
        }

        $this->enableForeignKeys();
    }
}
