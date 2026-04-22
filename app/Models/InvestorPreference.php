use Illuminate\Database\Eloquent\Model;

class InvestorPreference extends Model
{
    protected $fillable = [
        'investor_id',
        'preferred_industries',
        'min_investment',
        'max_investment',
        'preferred_locations',
    ];

    protected $casts = [
        'preferred_industries' => 'array',
        'preferred_locations' => 'array',
    ];
}