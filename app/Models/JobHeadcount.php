<?php

namespace App\Models;

use App\Repositories\JobHeadcountRepository;
use App\Traits\HasOrgChartAuditProperties;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Traits\BelongsToTenant;

class JobHeadcount extends Model implements Auditable
{
    use HasFactory, HasOrgChartAuditProperties, SoftDeletes, BelongsToTenant;

    protected $table = 'job_headcounts';

    protected $guarded = [];


    // Repository connection
    public static function repository(): JobHeadcountRepository
    {
        return app(JobHeadcountRepository::class);
    }

    // Quick access to repository methods
    public static function getVacantByJob(int $jobId)
    {
        return static::repository()->getVacantByJobId($jobId);
    }

    public static function getVacantFormattedByJob(int $jobId)
    {
        return static::repository()->getVacantHeadcountsFormatted($jobId);
    }

    public static function getJobStats(int $jobId): array
    {
        return static::repository()->getHeadcountStatsByJobId($jobId);
    }

    public static function assignUser(int $headcountId, int $userId): bool
    {
        return static::repository()->assignUserToHeadcount($headcountId, $userId);
    }


    function makeAuditProperties(array $auditData): array
    {
        Debugbar::addMessage([$auditData, $this->orgMetadata]);
        
        $metadata = (object) $this->orgMetadata;
        
        $reason = $metadata->reason ?? '';
        $action = $metadata->action ?? '';
        $source = $metadata->source ?? 'Org Chart';
        $extra = $metadata->extra ?? (object) [];
        $changeMaker = Auth::user();
        $changeTypeText = [
            'add_position' => 'Added Position',
            'remove_position' => 'Removed Position',
            'move_position' => 'Moved Position',
            'assign_employee' => 'Assigned Employee',
            'remove_employee' => 'Removed Employee',
            // note below is not implemented
            'move_employee' => 'Moved Employee',
            'update_headcounts_from_job_management' => 'Updated Headcounts from Job Management',
            'migrated_position' => 'Position Migration',
            'add_position_then_assign' => 'Add Position Then Assign'
        ];
        $details = (function () use ($metadata, $action, $extra): string {
            $node = $metadata->node;

            switch ($action) {
                case 'add_position':
                    $code = null;
                    if (is_object($node) && isset($node->data->code)) {
                        $code = $node->data->code;
                    } elseif (is_array($node) && isset($node['data']['code'])) {
                        $code = $node['data']['code'];
                    }
                    return "Added new position \"{$this->job->title} - {$code}\"";

                case 'remove_position':
                    return "Removed position \"{$this->job->title} - {$node->data->code}\"";
                 
                case 'update_headcounts_from_job_management':
                    return "Reassigned position";    

                case 'move_position':
                    $new = $extra['newHc'];
                    return "Reassigned position \"{$node->data->code}\" to \"{$new->headcount_code}\"";

                case 'assign_employee':
                    $employee = $node->data->name;
                    return "Assigned \"{$employee}\" to \"{$this->job->title} - {$node->data->code}\"";

                case 'remove_employee':
                    $employee = $extra['removedUser']?->name ?? 'employee';
                    return "Removed \"{$employee}\" from \"{$this->job->title} - {$node->data->code}\"\"";

                    // note below is not implemented
                case 'move_employee':
                    $employee = $node->data->name;
                    return "Moved \"{$employee}\" from \"{$this->job->title} - {$node->data->code}\" to \"{$this->job->title} - {$node->data->code}\"";
                
                case 'migrated_position':
                    $code = null;
                    if (is_object($node) && isset($node->data->code)) {
                        $code = $node->data->code;
                    } elseif (is_array($node) && isset($node['data']['code'])) {
                        $code = $node['data']['code'];
                    }
                    return "Added new position \"{$this->job->title} - {$code}\"";
                
                case 'add_position_then_assign':
                    $code = null;
                    $employee = null;
                    if (is_object($node) && isset($node->data->code)) {
                        $code = $node->data->code;
                        $employee = $node->data->name;
                    } elseif (is_array($node) && isset($node['data']['code'])) {
                        $code = $node['data']['code'];
                        $employee = $node['data']['name'];
                    }
                    return "Added new position \"{$this->job->title} - {$code}\" and Assigned to \"{$employee}\"";

                default:
                    Debugbar::error('unsupported action in makeAuditProperties');
                    return '';
            }
            
        })();

        return [
            'change_type' => $changeTypeText[$action],
            'details' => $details,
            'change_by' => $changeMaker->name,
            'reason' => htmlspecialchars($reason),
            'source' => $source,
        ];
    }

    public function parent()
    {
        return $this->belongsTo(JobHeadcount::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(JobHeadcount::class, 'parent_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function superiorUser()
    {
        return $this->parent()->hasOne(User::class, 'id', 'user_id');
    }
}
