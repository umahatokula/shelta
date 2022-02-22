<?php

namespace Migrator\Http\Livewire\Migration;

use Livewire\Component;
use Migrator\Service\MigratorParser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Single extends Component
{

    public $migrationFile;
    public $migrationName;
    public $migrationConnectionName;
    public $migrationCreatedAt;
    public $batch;
    public $structure;

    public function mount($migration)
    {
        $this->migrationFile = $migration->getFilename();
        $migratorParser = new MigratorParser($this->migrationFile);
        $this->migrationName = $migratorParser->getName();
        $this->migrationConnectionName = $migratorParser->getConnectionName();
        $this->migrationCreatedAt = $migratorParser->getDate();
        $this->batch = DB::table(config('database.migrations'))
            ->where('migration', str_replace('.php', '', $this->migrationFile))
            ->first(['batch'])->batch ?? 0;
        $this->structure = $migratorParser->getStructure();
    }

    public function migrate()
    {
        try {
            \Artisan::call('migrate', [
                '--path' => $this->getPath()
            ]);

            $message = 'Migration was migrated.';
            $type = 'success';
        } catch(\Exception $exception) {
            $message = $exception->getMessage();
            $type = 'error';
        }

        $this->dispatchBrowserEvent('show-message', [
            'type' => $type,
            'message' => Str::replace("\n", '<br>', $message)
        ]);

        $this->emit('migrationUpdated');
    }

    public function refresh()
    {
        \Artisan::call('migrate:refresh', [
            '--path' => $this->getPath()
        ]);

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Migration was refreshed.'
        ]);

        $this->emit('migrationUpdated');
    }

    public function removeTable()
    {
        \Artisan::call('migrate:reset', [
            '--path' => $this->getPath(),
            '--force' => true,
        ]);

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Table was dropped.'
        ]);

        $this->emit('migrationUpdated');
    }

    public function deleteMigration()
    {
        $this->removeTable();

        $path = database_path('migrations'.DIRECTORY_SEPARATOR.$this->migrationFile);

        File::delete($path);

        $this->emit('migrationUpdated');
    }

    public function rollback()
    {
        $migrationTable = config('database.migrations');
        \DB::table($migrationTable)
            ->where('migration', str_replace('.php', '', $this->migrationFile))
            ->update(['batch' => \DB::table($migrationTable)->max('batch')]);

        $path = 'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.$this->migrationFile;

        try {
            \Artisan::call('migrate:rollback', [
                '--path' => $path,
            ]);

            $message = 'Migration was rolled back.';
            $type = 'success';
        } catch(\Exception $exception) {
            $message = $exception->getMessage();
            $type = 'error';
        }

        $this->dispatchBrowserEvent('show-message', [
            'type' => $type,
            'message' => Str::replace("\n", '<br>', $message)
        ]);

        $this->emit('migrationUpdated');
    }

    public function render()
    {
        return view('migrator::livewire.migration.single');
    }

    private function getPath()
    {
        return 'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.$this->migrationFile;
    }

}
