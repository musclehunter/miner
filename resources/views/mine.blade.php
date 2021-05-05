@extends('base')

@section('content')
    <ul id="app" class="col my-2">
        <li v-for="mine in mineList" class="row">
            <button v-on:click="select_mine(mine.id)" class="col btn btn-primary mt-1">@{{ mine.name }}</button>
            <span v-if="miningState[mine.id] == 1" class="col mt-1">出発準備中</span>
            <span v-else-if="miningState[mine.id] == 2" class="col mt-1">採掘中 完了まで@{{ mine.remain_seconds }}秒</span>
            <span v-else-if="miningState[mine.id] == 3" class="col mt-1">採掘完了</span>
            <span v-else class="col mt-1">採掘できます</span>
        </li>
    </ul>
    <script>
        const Counter = {
            data() {
                return {
                    mineList: @json($mineList),
                    intervalId: [],
                    miningState: []//mineId: state    state 0:いける 1:レスポンス待ち 2:採掘中 3:完了
                }
            },
            methods: {
                select_mine(mineId) {
                    if (this.miningState[mineId] === 3) {
                        // 採掘完了
                        this.miningState[mineId] = 0;
                        return false;
                    } else if (this.miningState[mineId] !== undefined && this.miningState[mineId] !== 0) {
                        // 既に採掘中です
                        return false;
                    }
                    this.miningState[mineId] = 1;
                    fetch('/mine/execute/' + mineId, {
                        credentials: 'same-origin'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status != 1) {
                                alert(data.message);
                                this.miningState[mineId] = 0;
                                return;
                            }
                            let resultId = data.result.id;
                            let resultCompleteAt = data.result.complete_at;
                            this.mineList[resultId].complete_at = new Date(resultCompleteAt);
                            this.mineList[resultId].remain_seconds = Math.floor((this.mineList[resultId].complete_at.getTime() - (new Date().getTime())) / 1000);
                            this.miningState[resultId] = 2;
                            this.intervalId[resultId] = setInterval(() => {
                                this.mineList[resultId].remain_seconds = Math.floor((this.mineList[resultId].complete_at.getTime() - (new Date().getTime())) / 1000);
                                if (this.mineList[resultId].remain_seconds < 1) {
                                    clearInterval(this.intervalId[resultId]);
                                    this.miningState[resultId] = 3;
                                }
                            }, 1000);
                        });
                }
            }
        };
        const vm = Vue.createApp(Counter).mount('#app');
    </script>
@endsection
