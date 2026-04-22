namespace App\Services;

use App\Models\Pitch;
use App\Models\Investor;

class InvestorMatchingService
{
    public function match(Pitch $pitch)
    {
        $investors = Investor::with('preference')->get();

        return $investors->filter(function ($investor) use ($pitch) {
            $preference = $investor->preference;

            if (!$preference) return false;

            if (!in_array($pitch->industry, $preference->preferred_industries ?? [])) {
                return false;
            }

            if (
                $pitch->funding_amount < $pref->min_investment ||
                $pitch->funding_amount > $pref->max_investment
            ) {
                return false;
            }

            if (!empty($pref->preferred_locations)) {
                if (!in_array($pitch->location, $pref->preferred_locations)) {
                    return false;
                }
            }

            return true;
        });
    }
}
