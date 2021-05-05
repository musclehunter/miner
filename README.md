# miner

Laravelの学習用になんかつくります

## つくる予定のもの

- 早く動かせるようにするためできる限り簡素化します
- 鉱石を掘り出すゲーム？
- 鉱石を掘る場所を選べる
    - 選んだ場所によって出やすい鉱石の種類がある
- 鉱石を掘るための装備が存在する
- 鉱石にはレア度みたいなもんがある
- 鉱石は売れる
- キャラクターのステータスによって鉱石の産出具合がかわる？
- キャラクターのステータス
    - HP 0になると死にます
    - 力 鉱石の採掘量、一度に掘れる量に影響する アイテムの所持量に影響する
    - すばやさ 鉱石を掘るのにかかる時間に影響する 移動速度に影響する
    - 器用さ 鉱石の採掘量、採掘されるレア度に影響する
    - 感覚 敵の気配を察知します。生存率があがる
    - なんかスキルがある

## 採掘

- 鉱山を選んで採掘に出る
- 採掘には時間がかかり、終了までの時間をカウントダウンして表示する
- 鉱山までの距離によって採掘時間がかわる
- 採掘量はキャラクターのステータスによって変わる

### 画面

1. 掘る場所を選ぶ

### マスターデータ

1. item
    - id int
    - type
    - sub_type int
    - name string
    - weight int
    - level int
    - description
1. 鉱山 master_mines
    - id int
    - name string
    - distance int
    - description
1. 鉱石ドロップ率 mine_drop
    - id
    - ore_id
    - mine_id
    - rate
    - dex
1. item_type
    - id
    - name

### ゲームデータ

1. characters
    - id
    - name
1. character_status
    - character_id
    - level
    - exp
    - hp
    - str
    - quick
    - dex
    - sense
1. キャラクターの持ち物
    - id
    - item_id
    - quantity
1. character_actions
    - id
    - character_id
    - action_type
    - state
    - complete_at
    - message
1. character_minings
    - id
    - character_id
    - mine_id
    
### ログ
