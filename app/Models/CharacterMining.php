<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class CharacterMining
 * @property int $character_id
 * @property int $state
 * @property int $mine_id
 * @property Carbon $complete_at
 * @package App\Models
 */
class CharacterMining extends Model
{
    use HasFactory;

    const STATE_READY = 0;
    const STATE_RUNNING = 1;
    const STATE_COMPLETED = 2;

    const ERROR_REASON_RUNNING = 2;
    const ERROR_MESSAGE_RUNNING = '既に採掘中です';

    public int $reason;
    public string $message;

    protected $fillable = ['character_id', 'mine_id', 'state'];

    /**
     * @return bool
     */
    public function canMining()
    {
        $now = new Carbon();
        if ($this->state === self::STATE_RUNNING && $this->complete_at > $now) {
            $this->reason = self::ERROR_REASON_RUNNING;
            $this->message = self::ERROR_MESSAGE_RUNNING;
            return false;
        }
        return true;
    }

    public function execute(MasterMine $mine)
    {
        $this->complete_at = Carbon::createFromTimestamp(time() + $mine->distance);
        $this->state = self::STATE_RUNNING;
        $this->mine_id = $mine->id;
        $this->save();
    }

}
