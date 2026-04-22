use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    protected $fillable = [
        'funding_amount',
        'industry',
        'location',
        'title',
    ];
}
