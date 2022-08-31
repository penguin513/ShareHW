@extends('layouts.base')


@section('body')

<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center whitespace-nowrap">
                {{ __('今日の家事') }}
            </h2>
            <button onclick="location.href='/houseworks/new'" class="text-base ml-5 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-regular fa-square-plus"></i> 新規作成</button>
            <form method="POST" action="/houseworks/clone" class="m-0">
                @csrf
                <button class="text-base ml-5 shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-regular fa-copy"></i> 今日の家事を追加</button>
            </form>

        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    {{-- チャート表示 --}}
    <div class="flex flex-col justify-center items-center sm:flex-row">
        <canvas id="achievement_circle" width="250" height="250" class="my-0 mx-auto md:mx-0 w-100"></canvas>
        <canvas id="burden_circle" width="250" height="250" class="my-0 mx-auto md:mx-0 w-100"></canvas>

        {{-- 天気API --}}
        <div class="mt-10 md:mt-3 weather px-5">
            <table>
                <tr id="target_area" class="text-lg">
                    <th class="text-right">エリア：</th>
                    <td></td>
                </tr>
                <tr id="today_weather" class="text-lg">
                {{-- 20時以降は明日の天気に更新 --}}
                @if ($now > 20)
                    <th class="text-right">明日の天気：</th>
                @else
                    <th class="text-right">今日の天気：</th>
                @endif
                    <td></td>
                </tr>
            </table>
            <div id="recommend" class="mt-5 flex flex-col">
                <dt class="text-lg">【おすすめの家事】</dt>
            </div>

        </div>

    </div>


    {{-- 検索機能 --}}
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-5">
                    <form action="{{ route('houseworks') }}" method="GET">

                        <div class="flex-col md:flex-row flex flex-row">
                            <div class="col-span-6 sm:col-span-3 p-2 md:w-100 lg:w-48">
                                <label for="status" class="block text-sm font-midium text-gray-700 whitespace-nowrap">進行状況</label>
                                <select name="status" id="status" value="{{ $status }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="">--</option>
                                    @foreach (App\Models\HouseworkStatus::HOMEWORK_STATUS_OBJECT as $key => $value)
                                        <option value="{{ $key }}" @if ($status == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($user_role === 1)
                            <div class="col-span-6 sm:col-span-3 p-2 md:w-100 lg:w-48">
                                <label for="room_id" class="block text-sm font-midium text-gray-700 whitespace-nowrap">部屋ID</label>
                                <select id="room_id" name="room_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach($room_ids as $option)
                                        <option value="{{ $option }}" @if($room_id == $option) selected @endif >{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48 ">
                                <label for="name" class="block text-sm font-midium text-gray-700 whitespace-nowrap">家事の名前</label>
                                <input type="text" name="name" id="name" value="{{ $name }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48">
                                <label for="message" class="block text-sm font-midium text-gray-700 whitespace-nowrap">内容</label>
                                <input type="text" name="message" id="message" value="{{ $message }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48">
                                <label for="point" class="block text-sm font-midium text-gray-700 whitespace-nowrap">家事ポイント</label>
                                <select name="point" id="point" value="{{ $point }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="">--</option>
                                    @for ($i=0; $i<=100; $i++)
                                        @if ($i%10 === 0 && $i !== 0)
                                            <option value="{{ $i }}" @if ($i == $point) selected @endif>{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48">
                                <label for="pic_name" class="block text-sm font-midium text-gray-700 whitespace-nowrap">担当者</label>
                                @if ($user_role === 1)
                                <select id="pic_name" name="pic_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach($all_pic_members as $pic_member)
                                        <option value="{{ $pic_member->name }}" @if ($pic_name == $pic_member->name) selected @endif>{{ $pic_member->name }}</option>
                                    @endforeach
                                </select>
                                @endif
                                @if ($user_role === 5)
                                <select id="pic_name" name="pic_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach($pic_members as $pic_member)
                                        <option value="{{ $pic_member->name }}" @if ($pic_name == $pic_member->name) selected @endif>{{ $pic_member->name }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48">
                                <label for="created_at" class="block text-sm font-midium text-gray-700 whitespace-nowrap">日付</label>
                                <input type="date" name="created_at" id="created_at" value="{{ $created_at }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48 relative mt-12">
                                <button type="submit" class="absolute inset-x-0 bottom-2 mr-2 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-md whitespace-nowrap"><i class="fa-solid fa-magnifying-glass"></i> 検索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- リスト --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200 overflow-x-scroll">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">進行状況</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">ID</th>
                                                @if ($user_role === 1)
                                                    <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">部屋ID</th>
                                                @endif
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">家事の名前</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">内容</th>
                                                <th class="px-1 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">家事ポイント</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">担当者</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">作成日</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($houseworks as $housework)
                                                <tr class="border-t hover:bg-orange-50">
                                                    <td class="text-sm px-1 py-3 whitespace-nowrap text-center">
                                                        <form method="post" id="housework_form" name="housework_form">
                                                            @csrf
                                                            <input type="hidden" name="id" id="select_housework_id" value="">

                                                            <button id="check_btn" type="button" onclick="checkStatus({{ $housework->id }})" class="cursor-pointer ml-3 mr-3 px-1 py-1 shadow-md rounded-md font-semibold text-white text-base
                                                                @if($housework->status === 3)
                                                                    {{ 'bg-green-500 hover:bg-green-700 ring-green-200' }}
                                                                @elseif ($housework->status === 2)
                                                                    {{ 'bg-sky-500 hover:bg-sky-700 ring-sky-200' }}
                                                                @else
                                                                    {{ 'bg-gray-500 hover:bg-gray-700 ring-gray-200' }}
                                                                @endif
                                                            ring-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        {{ App\Models\HouseworkStatus::HOMEWORK_STATUS_OBJECT[$housework->status] }}
                                                    </td>
                                                    <td class="text-sm px-1 py-3 whitespace-nowrap text-center">{{ $housework->id }}</td>
                                                    @if ($user_role === 1)
                                                        <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ $housework->room_id }}</td>
                                                    @endif
                                                    <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ $housework->name }}</td>
                                                    <td class="text-sm px-4 py-3">{!! nl2br(e(Str::limit($housework->message, 50, $end="..."))) !!}</td>
                                                    <td class="text-sm px-1 py-3 text-gray-900 text-center">{{ $housework->point }}pt</td>
                                                    <td class="text-sm px-2 w-10 text-center whitespace-nowrap text-center">{{ $housework->pic_name }}</td>
                                                    <td class="text-sm px-3 w-10 text-center whitespace-nowrap text-center">{{ Carbon\Carbon::parse($housework->created_at)->format('Y年n月j日') }}</td>
                                                    <td class="px-3 w-10 text-center whitespace-nowrap text-center ">
                                                        <button onclick="location.href='/houseworks/detail/{{ $housework->id }}'" class="text-xs shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-1"><i class="fa-solid fa-circle-info"></i> 詳細</button>
                                                        <x-dropdown_ope align="right" width="48">
                                                            <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i>編集</x-slot>

                                                            <x-slot name="content">
                                                                <x-dropdown-link href="/houseworks/edit/{{ $housework->id }}"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                                <form method="POST" action="{{ route('housework.remove', $housework->id) }}" class="mb-0">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <x-dropdown-link_delete onclick="return confirm('本当に削除してもよろしいですか？');">✘ 削除</x-dropdown-link_delete>
                                                                </form>
                                                            </x-slot>
                                                        </x-dropdown_ope>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $houseworks->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

<div id="app"></div>



@section('script')
<!-- chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script async>
    // 本日の達成度チャート
    const status_counts = @json($status_counts);
    const status_list = @json($status_list);

    let context = document.getElementById("achievement_circle").getContext('2d');
    new Chart(context, {
        type: 'doughnut',
        data: {
            labels: status_list,
            datasets: [{
                backgroundColor: ["#fa8072", "#00bfff", "#00ff7f",],
                data: status_counts
            }]
        },
        options: {
            responsive: false,
            title: {
                display: true,
                text: '本日の達成度　※午前4時更新'
            },
        }
    });



    // 家事負担率チャート
    const point_users = @json($point_users);
    const user = [];
    let point = [];
    let point_ratio = [];
    let user_point = [];
    let user_desc = [];
    let point_desc = [];
    let sum = 0;

    point_users.forEach(Element => {
        user.push(Element.pic_name);
        point.push(Element.sum_point);
    });

    point.forEach(Element => {
        Element = Number(Element);
        sum += Element;
    });

    point.forEach(Element => {
        let data = Math.round(Element / sum * 100 * 10) / 10;
        point_ratio.push(data);
    });

    for(let i=0; i<point.length; i++) {
        user_point[user[i]] = point_ratio[i];
    }

    let array = Object.keys(user_point).map((k) => ({
        key: k,
        value: user_point[k]
    }));

    array.sort((a, b) => b.value - a.value);

    user_point = Object.assign({}, ...array.map((item) => ({
        [item.key]: item.value,
    })));

    user_desc.push(Object.keys(user_point));
    point_desc.push(Object.values(user_point));


    let context2 = document.getElementById("burden_circle").getContext('2d');
    new Chart(context2, {
        type: 'doughnut',
        data: {
            labels: user_desc[0],
            datasets: [{
                backgroundColor: ["#fa8072", "#00bfff", "#00ff7f", "#ffff00", "#ff00ff", "#00008b",],
                data: point_desc[0]
            }]
        },
        options: {
            responsive: false,
            title: {
                display: true,
                text: '本日の家事負担率（％）　※午前4時更新'
            },
        }
    });



    // 天気API
    const area_code = @json($area_code);
    if (area_code !== null) {
        let url = "https://weather.tsukumijima.net/api/forecast?city=" + area_code;
        fetch(url)
            .then(function(response) {
                return response.json();
            })
            .then(function(weather) {
                let area = weather.location.city;
                let today = weather.forecasts[0].telop;
                let tomorrow = weather.forecasts[1].telop;

                const now = @json($now);

                // 特定地域の情報を画面に書き出す
                document.getElementById("target_area").lastElementChild.textContent = area;

                // 20時以降は次の日の天気に更新
                if (now > 20) {
                    document.getElementById("today_weather").lastElementChild.textContent = tomorrow;
                } else {
                    document.getElementById("today_weather").lastElementChild.textContent = today;
                }


                // 天気によって条件分岐
                const recommend = document.getElementById('recommend');
                const recommendText = document.createElement('dd');

                if (today.indexOf('雨') !== -1) {
                    recommendText.innerHTML = "・縫い物<br>（趣味に小物を作るのもよし、お子さんのランチョンマット等を作るのもよし！）" + "<br>";
                    recommendText.innerHTML += "・レシピノート作り<br>（雨の日でお家で過ごすときには、書く作業がはかどる！）" + "<br>";
                    recommendText.innerHTML += "・窓の拭き掃除<br>（晴れの日のイメージが強いですが、雨の日は窓の汚れが湿気で浮いて落としやすい！）" + "<br>";

                } else if (today.indexOf('晴') !== -1) {
                    recommendText.innerHTML = "・カーテンのお掃除<br>（色落ち防止のために、洗濯後はカーテンレールにつけて室内干しがおすすめ！）" + "<br>";
                    recommendText.innerHTML += "・靴箱のお掃除<br>（たまには靴箱を開け、靴をすべて出して中をお掃除！）" + "<br>";
                    recommendText.innerHTML += "・床の拭き掃除<br>（晴れた日はすぐ乾くので拭いた後に足跡がつきにくい！）" + "<br>";

                } else {
                    recommendText.innerHTML = "・窓の拭き掃除<br>（晴れて日差しが強いとムラができやすいので曇りの日がおすすめ！）" + "<br>";
                    recommendText.innerHTML += "・庭の手入れ等<br>（夏の暑い時期は、太陽が出ていない比較的涼しい日に外での作業をするのがgood！）" + "<br>";

                }

                recommend.appendChild(recommendText);
            });
    } else {
        document.getElementById("target_area").lastElementChild.innerHTML = "登録なし";
    }


    // check機能処理
    function checkStatus(id) {
        document.querySelector('#select_housework_id').value = id;

        document.querySelector('#housework_form').action = "{{ route('housework.check') }}";

        document.querySelector('#housework_form').submit();
    }


    // ページ更新時スクロール位置固定
    let positionY;
    let STORAGE_KEY = "scrollY";

    function checkOffset() {
        positionY = window.pageYOffset;
        localStorage.setItem(STORAGE_KEY, positionY);
    }


    window.addEventListener("load", function(){
        // ストレージチェック
        positionY = localStorage.getItem(STORAGE_KEY);

        // 前回の保存データがあればスクロールする
        if (positionY !== null) {
            scrollTo(0, positionY);
        }

        // スクロール時のイベント設定
        window.addEventListener("click", checkOffset, false);
    });


console.log(point_users);
</script>
@endsection
