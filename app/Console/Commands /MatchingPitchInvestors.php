namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pitch;
use App\Services\InvestorMatchingService;

class MatchPitchInvestors extends Command
{
    protected $signature = 'pitch:match {pitch_id}';

    protected $description = 'Match investors for a given pitch';

    public function handle(InvestorMatchingService $service)
    {
        $pitch = Pitch::find($this->argument('pitch_id'));

        if (!$pitch) {
            $this->error('Pitch not found');
            return 1;
        }

        $matches = $service->match($pitch);

        if ($matches->isEmpty()) {
            $this->info('No investors matched.');
            return 0;
        }

        foreach ($matches as $investor) {
            $this->info("Matched Investor ID: {$investor->id}");
        }

        return 0;
    }
}
