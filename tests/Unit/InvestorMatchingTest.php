use App\Models\Pitch;
use App\Models\Investor;
use App\Models\InvestorPreference;
use App\Services\InvestorMatchingService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvestorMatchingTest extends TestCase
{
    use RefreshDatabase;

    public function test_investor_matching_logic()
    {
        $pitch = Pitch::factory()->create([
            'industry' => 'technology',
            'funding_amount' => 150000,
            'location' => 'London',
        ]);

        $investor = Investor::factory()->create();

        InvestorPreference::create([
            'investor_id' => $investor->id,
            'preferred_industries' => ['technology'],
            'min_investment' => 100000,
            'max_investment' => 200000,
            'preferred_locations' => ['London'],
        ]);

        $service = new InvestorMatchingService();

        $result = $service->match($pitch);

        $this->assertCount(1, $result);
        $this->assertEquals($investor->id, $result->first()->id);
    }
}
