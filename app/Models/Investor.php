use App\Models\InvestorPreference;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = [];

    public function preference()
    {
        return $this->hasOne(InvestorPreference::class);
    }
}
