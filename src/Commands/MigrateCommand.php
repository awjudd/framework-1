<?php
namespace Haunt\Commands;

use Haunt\Library\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\ConfirmableTrait;

class MigrateCommand extends Command
{
	use ConfirmableTrait;

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run the Haunt migrations.';

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'haunt:migrate
							{option=up : Up\Down.}
							{--batch= : Run a specific batch.}
							{--force : Force the operation to run when in production.}
							{--path= : Migration path.}
							';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		if(!$this->confirmToProceed()) {
			return;
		}

		$batch = $this->option('batch');
		$option = $this->argument('option');
		$path = $this->option('path');

		// check if the migrations table exists
		if(!Schema::hasTable('migrations')) {
			foreach(File::allFiles("{$this->root}/database/migrations") as $file) {
				File::requireOnce($file);
				$filename = pathinfo($file->getFilename(), PATHINFO_FILENAME);
				$migration = $this->resolve($filename);
				$migration->up();

				$this->output->writeln("<info>Migrated:</info> {$filename}");
			}
		}

		if($batch === null) {
			return;
		}

		foreach(File::allFiles($path) as $file) {
			File::requireOnce($file);
			$filename = pathinfo($file->getFilename(), PATHINFO_FILENAME);
			$migration = $this->resolve($filename);

			try {
				$migration->$option();
			} catch(\Exception $e) {
				//
			}

			if($option === 'up') {
				DB::table('migrations')
					->insert(['batch' => $batch, 'migration' => $filename]);
				$this->output->writeln("<info>Migrated:</info> {$filename}");
			} else {
				DB::table('migrations')
					->where([['batch', '=', $batch], ['migration', '=', $filename]])
					->delete();
				$this->output->writeln("<error>Dropped:</error> {$filename}");
			}
		}
	}

    /**
     * Resolve a migration instance from a file.
     *
     * @param string $filename
     * @return object
     */
    public function resolve($filename): object
    {
        $class = Str::studly(implode('_', array_slice(explode('_', $filename), 4)));
        return new $class;
    }
}
