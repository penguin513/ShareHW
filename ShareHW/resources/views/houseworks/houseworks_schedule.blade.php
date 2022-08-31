@extends('layouts.base')


@section('body')

<x-app-layout>
    <x-slot name="header">
        <div class="flex mt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center whitespace-nowrap">
                {{ __('家事スケジュール') }}
            </h2>
            <button onclick="location.href='/houseworks/schedule/new'" class="text-base ml-5 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"><i class="fa-regular fa-square-plus"></i> 新規作成</button>
        </div>
    </x-slot>


    {{-- flashメッセージを表示 --}}
    @if (session('status'))
        <x-ui.flash_message message="{{ session('status') }}"></x-ui.flash_message>
    @endif


    {{-- チャート表示 --}}
    <div class="flex flex-col justify-center items-center sm:flex-row">
        <canvas id="burden_circle" width="250" height="250" class="my-0 mx-auto md:mx-0 w-100"></canvas>
    </div>


    {{-- 検索機能 --}}
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-5">
                    <form action="{{ route('schedules') }}" method="GET">

                        <div class="flex flex-col justify-center md:flex-row">
                            @if ($user_role === 1)
                            <div class="col-span-6 sm:col-span-3 p-2 md:w-full lg:w-48">
                                <label for="room_id" class="block text-sm font-midium text-gray-700">部屋ID</label>
                                <select id="room_id" name="room_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach($room_ids as $option)
                                        <option value="{{ $option }}" @if($room_id == $option) selected @endif >{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="col-span-6 p-2 md:w-full lg:w-48 ">
                                <label for="day_of_week" class="block text-sm font-midium text-gray-700">曜日</label>
                                <select id="day_of_week" name="day_of_week" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--</option>
                                    @foreach(App\Models\ScheduleDayofweek::SCHEDULE_DAYOFWEEK_OBJECT as $key => $value)
                                        <option value="{{ $key }}" @if ($key == $day_of_week) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6 p-2 md:w-full lg:w-48 ">
                                <label for="name" class="block text-sm font-midium text-gray-700">家事の名前</label>
                                <input type="text" name="name" id="name" value="{{ $name }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 p-2 md:w-full lg:w-48">
                                <label for="message" class="block text-sm font-midium text-gray-700">内容</label>
                                <input type="text" name="message" id="message" value="{{ $message }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 p-2 md:w-full lg:w-48">
                                <label for="point" class="block text-sm font-midium text-gray-700">家事ポイント</label>
                                <select name="point" id="point" value="{{ $point }}" class="mt-1 focus:ring-indego-500 focus:border-indigo block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="">--</option>
                                    @for ($i=0; $i<=100; $i++)
                                        @if ($i%10 === 0 && $i !== 0)
                                            <option value="{{ $i }}" @if ($i == $point) selected @endif>{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>

                            <div class="col-span-6 p-2 md:w-full lg:w-48">
                                <label for="pic_name" class="block text-sm font-midium text-gray-700">担当者</label>
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

                            <div class="col-span-6 p-2 md:w-full lg:w-48 relative mt-12">
                                <button type="submit" class="absolute inset-x-0 bottom-2 mr-2 shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-md"><i class="fa-solid fa-magnifying-glass"></i> 検索</button>
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
                            <h3 class="text-2xl font-bold">@if ($day_of_week !== '') {{ App\Models\ScheduleDayofweek::SCHEDULE_DAYOFWEEK_OBJECT[$day_of_week] }} @else 全家事一覧 @endif</h3>
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200 overflow-x-scroll">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">ID</th>
                                                @if ($user_role === 1)
                                                    <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">部屋ID</th>
                                                @endif
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">曜日</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">家事の名前</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">内容</th>
                                                <th class="px-1 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">家事ポイント</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">担当者</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center">作成日</th>
                                                <th class="px-3 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 whitespace-nowrap text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedules as $schedule)
                                                <tr class="border-t hover:bg-orange-50">
                                                    <td class="text-sm px-1 py-3 whitespace-nowrap text-center">{{ $schedule->id }}</td>
                                                    @if ($user_role === 1)
                                                        <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ $schedule->room_id }}</td>
                                                    @endif
                                                    <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ App\Models\ScheduleDayofweek::SCHEDULE_DAYOFWEEK_OBJECT[ $schedule->day_of_week] }}</td>
                                                    <td class="text-sm px-3 py-3 whitespace-nowrap text-center">{{ $schedule->name }}</td>
                                                    <td class="text-sm px-4 py-3">{!! nl2br(e(Str::limit($schedule->message, 50, $end="..."))) !!}</td>
                                                    <td class="text-sm px-1 py-3 text-gray-900 text-center">{{ $schedule->point }}pt</td>
                                                    <td class="text-sm px-2 w-10 text-center whitespace-nowrap text-center">{{ $schedule->pic_name }}</td>
                                                    <td class="text-sm px-3 w-10 text-center whitespace-nowrap text-center">{{ Carbon\Carbon::parse($schedule->created_at)->format('Y年n月j日') }}</td>
                                                    <td class="px-3 w-10 text-center whitespace-nowrap text-center ">
                                                        <button onclick="location.href='/houseworks/schedule/detail/{{ $schedule->id }}'" class="text-xs shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-1"><i class="fa-solid fa-circle-info"></i> 詳細</button>
                                                        <x-dropdown_ope align="right" width="48">
                                                            <x-slot name="trigger"><i class="fa-solid fa-feather-pointed mr-1"></i>編集</x-slot>

                                                            <x-slot name="content">
                                                                <x-dropdown-link href="/houseworks/schedule/edit/{{ $schedule->id }}"><i class="fa-solid fa-pen-to-square"></i> 変更</x-dropdown-link>
                                                                <form method="POST" action="{{ route('schedule.remove', $schedule->id) }}" class="mb-0">
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

                                    {{ $schedules->appends(request()->input())->links() }}
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
    // 家事負担率チャート
    const user_list_arsort = @json($user_list_arsort);
    const ratio_list_arsort = @json($ratio_list_arsort);

    let context2 = document.getElementById("burden_circle").getContext('2d');
    new Chart(context2, {
        type: 'doughnut',
        data: {
            labels: user_list_arsort,
            datasets: [{
                backgroundColor: ["#fa8072", "#00bfff", "#00ff7f", "#ffff00", "#ff00ff", "#00008b",],
                data: ratio_list_arsort
            }]
        },
        options: {
            responsive: false,
            title: {
                display: true,
                text: '現在までの全家事負担率（％）'
            },
        }
    });
</script>
@endsection
