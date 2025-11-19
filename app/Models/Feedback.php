<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'feedback';

    // Mass assignable attributes
    protected $fillable = [
        'role',
        'description',
        'sector_name',
        'sub_sector_name',
        'json_data',
        'feedback',
        'feedback_rating',
        'feedback_comment',
    ];

    // Constants for feedback ratings
    public const RATING_INCOMPLETE = 1;
    public const RATING_CONFUSING = 2;
    public const RATING_NOT_ACCURATE = 3;
    public const RATING_PARTIALLY_ACCURATE = 4;
    public const RATING_ACCURATE = 5;

    // Map of ratings to their descriptions
    public const RATING_LABELS = [
        self::RATING_INCOMPLETE => 'Incomplete',
        self::RATING_CONFUSING => 'Confusing',
        self::RATING_NOT_ACCURATE => 'Not Accurate',
        self::RATING_PARTIALLY_ACCURATE => 'Partially Accurate',
        self::RATING_ACCURATE => 'Accurate',
    ];

    /**
     * Get the description for a feedback rating.
     *
     * @return string|null
     */
    public function getFeedbackRatingDescription(): ?string
    {
        return self::RATING_LABELS[$this->feedback_rating] ?? null;
    }
}
