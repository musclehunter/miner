<?php

namespace App\Http\Controllers;

use App\Models\CharacterMining;
use App\Models\MasterMine;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Psy\Util\Json;

class MineController extends Controller
{
    const RESULT_STATUS_SUCCESS = 1;
    const RESULT_STATUS_FAILED = 2;

    public function index()
    {
        $mineList = MasterMine::all()->keyBy('id');

        return view('mine', ['mineList' => $mineList]);
    }

    public function execute(MasterMine $mine)
    {
        // 採掘可否の判定
        /*** @var CharacterMining $characterMining */
        $characterMining = CharacterMining::firstOrCreate(
            ['character_id' => 1],
            ['state' => 0, 'mine_id' => $mine->id]
        );
        if (!$characterMining->canMining()) {
            return response()->json(['status' => self::RESULT_STATUS_FAILED, 'reason' => $characterMining->reason, 'message' => $characterMining->message]);
        }

        // 採掘の実行
        $characterMining->execute($mine);

        $data = $mine->toArray();
        $data['complete_at'] = $characterMining->complete_at;
        $data['remain_seconds'] = 0;//表示用なので計算不要
        $response = [
            'status' => self::RESULT_STATUS_SUCCESS,
            'result' => $data,
        ];

        return response()->json($response);
    }
}
