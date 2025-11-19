<?php

namespace App\Traits;

use Illuminate\Validation\ValidationException;

trait HandlesJobLevelConsistency
{
    /**
     * Check if updating the parent level would cause inconsistency.
     * Only checks the child with the minimum level.
     *
     * @param int $newLevel
     * @return void
     * @throws ValidationException
     */
    public function validateLevelConsistency(int $newLevel)
    {
        $minLevelChild = $this->children()
        ->orderBy('level','desc')
        ->limit(1)
        ->first(['id', 'title', 'level']);
        

        if ($minLevelChild && $minLevelChild->level > $newLevel) {
            throw ValidationException::withMessages([
                'level' => 'Cannot update level. Child job "' . $minLevelChild->title . '" (ID: ' . $minLevelChild->id . ') has level (' . $minLevelChild->level . ').',
            ]);
        }
    }

    /**
     * Update the level after ensuring consistency.
     *
     * @param int $newLevel
     * @return void
     * @throws ValidationException
     */
    public function updateLevelSafely(int $newLevel)
    {
        $this->validateLevelConsistency($newLevel);

        $this->level = $newLevel;
        $this->save();
    }
}
