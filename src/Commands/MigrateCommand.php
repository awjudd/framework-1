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

		$batch = $this->option('batch') ?? "haunt-pet/haunt";
		$option = $this->argument('option');
		$path = $this->option('path') ?? "{$this->root}/database/migrations";

		foreach(File::allFiles($path) as $file) {
			File::requireOnce($file);
			$filename = pathinfo($file->getFilename(), PATHINFO_FILENAME);
			$migration = $this->resolve($filename);

			try {
				$migration->$option();
			} catch(\Exception $e) {
				$this->output->writeln("<fg=red>Failed to Migrate:</> {$e->getSql()}");
				continue;
			}

			if($option === 'up') {
				DB::table('migrations')
					->insert(['batch' => $batch, 'migration' => $filename]);
				$this->output->writeln("<info>Migrated:</info> {$filename}");
			} else {
				DB::table('migrations')
					->where([['batch', '=', $batch], ['migration', '=', $filename]])
					->delete();
				$this->output->writeln("<comment>Dropped:</comment> {$filename}");
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
