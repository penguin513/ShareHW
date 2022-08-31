<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <h1 class="text-3xl text-center mb-10">新規登録</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('名前（ニックネーム）')" class="inline-block"/>
                <span class="bg-red-500 text-white p-1 text-xs rounded-lg">{{ __('必須') }}</span>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('メールアドレス')" class="inline-block"/>
                <span class="bg-red-500 text-white p-1 text-xs rounded-lg">{{ __('必須') }}</span>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- room id -->
            <div class="mt-4">
                <x-label for="room_id" :value="__('部屋ID（半角数字12桁）')" class="inline-block"/>
                <span class="bg-red-500 text-white p-1 text-xs rounded-lg">{{ __('必須') }}</span>

                <x-input id="room_id" class="block mt-1 w-full" type="text" name="room_id" :value="old('room_id')" required />
            </div>

            <!-- area -->
            <div class="mt-4">
                <x-label for="area" :value="__('お住いの地域（任意）')" />
                <p class="text-xs text-red-500">※ご登録がない場合、一部のサービスをご利用いただけません</p>

                <select name="area" id="area" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full" type="text" name="area">
                    <option value="">--</option>
                    <optgroup label="北海道" class="text-purple-600">
                        <option class="text-black" value="011000" @if (old('area') == '011000') selected @endif>稚内</option>
                        <option class="text-black" value="012010" @if (old('area') == '012010') selected @endif>旭川</option>
                        <option class="text-black" value="012020" @if (old('area') == '012020') selected @endif>留萌</option>
                        <option class="text-black" value="013010" @if (old('area') == '013010') selected @endif>網走</option>
                        <option class="text-black" value="013020" @if (old('area') == '013020') selected @endif>北見</option>
                        <option class="text-black" value="013030" @if (old('area') == '013030') selected @endif>紋別</option>
                        <option class="text-black" value="014010" @if (old('area') == '014010') selected @endif>根室</option>
                        <option class="text-black" value="014020" @if (old('area') == '014020') selected @endif>釧路</option>
                        <option class="text-black" value="014030" @if (old('area') == '014030') selected @endif>帯広</option>
                        <option class="text-black" value="015010" @if (old('area') == '015010') selected @endif>室蘭</option>
                        <option class="text-black" value="015020" @if (old('area') == '015020') selected @endif>浦河</option>
                        <option class="text-black" value="016010" @if (old('area') == '016010') selected @endif>札幌</option>
                        <option class="text-black" value="016020" @if (old('area') == '016020') selected @endif>岩見沢</option>
                        <option class="text-black" value="016030" @if (old('area') == '016030') selected @endif>倶知安</option>
                        <option class="text-black" value="017010" @if (old('area') == '017010') selected @endif>函館</option>
                        <option class="text-black" value="017020" @if (old('area') == '017020') selected @endif>江差</option>
                    </optgroup>
                    <optgroup label="青森県" class="text-purple-600">
                        <option class="text-black" value="020010" @if (old('area') == '020010') selected @endif>青森</option>
                        <option class="text-black" value="020020" @if (old('area') == '020020') selected @endif>むつ</option>
                        <option class="text-black" value="020030" @if (old('area') == '020030') selected @endif>八戸</option>
                    </optgroup>

                    <optgroup label="岩手県" class="text-purple-600">
                        <option class="text-black" value="030010" @if (old('area') == '030010') selected @endif>盛岡</option>
                        <option class="text-black" value="030020" @if (old('area') == '030020') selected @endif>宮古</option>
                        <option class="text-black" value="030030" @if (old('area') == '030030') selected @endif>大船渡</option>
                    </optgroup>
                    <optgroup label="宮城県" class="text-purple-600">
                        <option class="text-black" value="040010" @if (old('area') == '040010') selected @endif>仙台</option>
                        <option class="text-black" value="040020" @if (old('area') == '040020') selected @endif>白石</option>
                    </optgroup>
                    <optgroup label="秋田県" class="text-purple-600">
                        <option class="text-black" value="050010" @if (old('area') == '050010') selected @endif>秋田</option>
                        <option class="text-black" value="050020" @if (old('area') == '050020') selected @endif>横手</option>
                    </optgroup>
                    <optgroup label="山形県" class="text-purple-600">
                        <option class="text-black" value="060010" @if (old('area') == '060010') selected @endif>山形</option>
                        <option class="text-black" value="060020" @if (old('area') == '060020') selected @endif>米沢</option>
                        <option class="text-black" value="060030" @if (old('area') == '060030') selected @endif>酒田</option>
                        <option class="text-black" value="060040" @if (old('area') == '060040') selected @endif>新庄</option>
                    </optgroup>
                    <optgroup label="福島県" class="text-purple-600">
                        <option class="text-black" value="070010" @if (old('area') == '070010') selected @endif>福島</option>
                        <option class="text-black" value="070020" @if (old('area') == '070020') selected @endif>小名浜</option>
                        <option class="text-black" value="070030" @if (old('area') == '070030') selected @endif>若松</option>
                    </optgroup>
                    <optgroup label="茨城県" class="text-purple-600">
                        <option class="text-black" value="080010" @if (old('area') == '080010') selected @endif>水戸</option>
                        <option class="text-black" value="080020" @if (old('area') == '080020') selected @endif>土浦</option>
                    </optgroup>
                    <optgroup label="栃木県" class="text-purple-600">
                        <option class="text-black" value="090010" @if (old('area') == '090010') selected @endif>宇都宮</option>
                        <option class="text-black" value="090020" @if (old('area') == '090020') selected @endif>大田原</option>
                    </optgroup>
                    <optgroup label="群馬県" class="text-purple-600">
                        <option class="text-black" value="100010" @if (old('area') == '100010') selected @endif>前橋</option>
                        <option class="text-black" value="100020" @if (old('area') == '100020') selected @endif>みなかみ</option>
                    </optgroup>
                    <optgroup label="埼玉県" class="text-purple-600">
                        <option class="text-black" value="110010" @if (old('area') == '110010') selected @endif>さいたま</option>
                        <option class="text-black" value="110020" @if (old('area') == '110020') selected @endif>熊谷</option>
                        <option class="text-black" value="110030" @if (old('area') == '110030') selected @endif>秩父</option>
                    </optgroup>
                    <optgroup label="千葉県" class="text-purple-600">
                        <option class="text-black" value="120010" @if (old('area') == '120010') selected @endif>千葉</option>
                        <option class="text-black" value="120020" @if (old('area') == '120020') selected @endif>銚子</option>
                        <option class="text-black" value="120030" @if (old('area') == '120030') selected @endif>館山</option>
                    </optgroup>
                    <optgroup label="東京都" class="text-purple-600">
                        <option class="text-black" value="130010" @if (old('area') == '130010') selected @endif>東京</option>
                        <option class="text-black" value="130020" @if (old('area') == '130020') selected @endif>大島</option>
                        <option class="text-black" value="130030" @if (old('area') == '130030') selected @endif>八丈島</option>
                        <option class="text-black" value="130040" @if (old('area') == '130040') selected @endif>父島</option>
                    </optgroup>
                    <optgroup label="神奈川県" class="text-purple-600">
                        <option class="text-black" value="140010" @if (old('area') == '140010') selected @endif>横浜</option>
                        <option class="text-black" value="140020" @if (old('area') == '140020') selected @endif>小田原</option>
                    </optgroup>
                    <optgroup label="新潟県" class="text-purple-600">
                        <option class="text-black" value="150010" @if (old('area') == '150010') selected @endif>新潟</option>
                        <option class="text-black" value="150020" @if (old('area') == '150020') selected @endif>長岡</option>
                        <option class="text-black" value="150030" @if (old('area') == '150030') selected @endif>高田</option>
                        <option class="text-black" value="150040" @if (old('area') == '150040') selected @endif>相川</option>
                    </optgroup>
                    <optgroup label="富山県" class="text-purple-600">
                        <option class="text-black" value="160010" @if (old('area') == '160010') selected @endif>富山</option>
                        <option class="text-black" value="160020" @if (old('area') == '160020') selected @endif>伏木</option>
                    </optgroup>
                    <optgroup label="石川県" class="text-purple-600">
                        <option class="text-black" value="170010" @if (old('area') == '170010') selected @endif>金沢</option>
                        <option class="text-black" value="170020" @if (old('area') == '170020') selected @endif>輪島</option>
                    </optgroup>
                    <optgroup label="福井県" class="text-purple-600">
                        <option class="text-black" value="180010" @if (old('area') == '180010') selected @endif>福井</option>
                        <option class="text-black" value="180020" @if (old('area') == '180020') selected @endif>敦賀</option>
                    </optgroup>
                    <optgroup label="山梨県" class="text-purple-600">
                        <option class="text-black" value="190010" @if (old('area') == '190010') selected @endif>甲府</option>
                        <option class="text-black" value="190020" @if (old('area') == '190020') selected @endif>河口湖</option>
                    </optgroup>
                    <optgroup label="長野県" class="text-purple-600">
                        <option class="text-black" value="200010" @if (old('area') == '200010') selected @endif>長野</option>
                        <option class="text-black" value="200020" @if (old('area') == '200020') selected @endif>松本</option>
                        <option class="text-black" value="200030" @if (old('area') == '200030') selected @endif>飯田</option>
                    </optgroup>
                    <optgroup label="岐阜県" class="text-purple-600">
                        <option class="text-black" value="210010" @if (old('area') == '210010') selected @endif>岐阜</option>
                        <option class="text-black" value="210020" @if (old('area') == '210020') selected @endif>高山</option>
                    </optgroup>
                    <optgroup label="静岡県" class="text-purple-600">
                        <option class="text-black" value="220010" @if (old('area') == '220010') selected @endif>静岡</option>
                        <option class="text-black" value="220020" @if (old('area') == '220020') selected @endif>網代</option>
                        <option class="text-black" value="220030" @if (old('area') == '220030') selected @endif>三島</option>
                        <option class="text-black" value="220040" @if (old('area') == '220040') selected @endif>浜松</option>
                    </optgroup>
                    <optgroup label="愛知県" class="text-purple-600">
                        <option class="text-black" value="230010" @if (old('area') == '230010') selected @endif>名古屋</option>
                        <option class="text-black" value="230020" @if (old('area') == '230020') selected @endif>豊橋</option>
                    </optgroup>
                    <optgroup label="三重県" class="text-purple-600">
                        <option class="text-black" value="240010" @if (old('area') == '240010') selected @endif>津</option>
                        <option class="text-black" value="240020" @if (old('area') == '240020') selected @endif>尾鷲</option>
                    </optgroup>
                    <optgroup label="滋賀県" class="text-purple-600">
                        <option class="text-black" value="250010" @if (old('area') == '250010') selected @endif>大津</option>
                        <option class="text-black" value="250020" @if (old('area') == '250020') selected @endif>彦根</option>
                    </optgroup>
                    <optgroup label="京都府" class="text-purple-600">
                        <option class="text-black" value="260010" @if (old('area') == '260010') selected @endif>京都</option>
                        <option class="text-black" value="260020" @if (old('area') == '260020') selected @endif>舞鶴</option>
                    </optgroup>
                    <optgroup label="大阪府" class="text-purple-600">
                        <option class="text-black" value="270000" @if (old('area') == '270000') selected @endif>大阪</option>
                    </optgroup>
                    <optgroup label="兵庫県" class="text-purple-600">
                        <option class="text-black" value="280010" @if (old('area') == '280010') selected @endif>神戸</option>
                        <option class="text-black" value="280020" @if (old('area') == '280020') selected @endif>豊岡</option>
                    </optgroup>
                    <optgroup label="奈良県" class="text-purple-600">
                        <option class="text-black" value="290010" @if (old('area') == '290010') selected @endif>奈良</option>
                        <option class="text-black" value="290020" @if (old('area') == '290020') selected @endif>風屋</option>
                    </optgroup>
                    <optgroup label="和歌山県" class="text-purple-600">
                        <option class="text-black" value="300010" @if (old('area') == '300010') selected @endif>和歌山</option>
                        <option class="text-black" value="300020" @if (old('area') == '300020') selected @endif>潮岬</option>
                    </optgroup>
                    <optgroup label="鳥取県" class="text-purple-600">
                        <option class="text-black" value="310010" @if (old('area') == '310010') selected @endif>鳥取</option>
                        <option class="text-black" value="310020" @if (old('area') == '310020') selected @endif>米子</option>
                    </optgroup>
                    <optgroup label="島根県" class="text-purple-600">
                        <option class="text-black" value="320010" @if (old('area') == '320010') selected @endif>松江</option>
                        <option class="text-black" value="320020" @if (old('area') == '320020') selected @endif>浜田</option>
                        <option class="text-black" value="320030" @if (old('area') == '320030') selected @endif>西郷</option>
                    </optgroup>
                    <optgroup label="岡山県" class="text-purple-600">
                        <option class="text-black" value="330010" @if (old('area') == '330010') selected @endif>岡山</option>
                        <option class="text-black" value="330020" @if (old('area') == '330020') selected @endif>津山</option>
                    </optgroup>
                    <optgroup label="広島県" class="text-purple-600">
                        <option class="text-black" value="340010" @if (old('area') == '340010') selected @endif>広島</option>
                        <option class="text-black" value="340020" @if (old('area') == '340020') selected @endif>庄原</option>
                    </optgroup>
                    <optgroup label="山口県" class="text-purple-600">
                        <option class="text-black" value="350010" @if (old('area') == '350010') selected @endif>下関</option>
                        <option class="text-black" value="350020" @if (old('area') == '350020') selected @endif>山口</option>
                        <option class="text-black" value="350030" @if (old('area') == '350030') selected @endif>柳井</option>
                        <option class="text-black" value="350040" @if (old('area') == '350040') selected @endif>萩</option>
                    </optgroup>
                    <optgroup label="徳島県" class="text-purple-600">
                        <option class="text-black" value="360010" @if (old('area') == '360010') selected @endif>徳島</option>
                        <option class="text-black" value="360020" @if (old('area') == '360020') selected @endif>日和佐</option>
                    </optgroup>
                    <optgroup label="香川県" class="text-purple-600">
                        <option class="text-black" value="370000" @if (old('area') == '370000') selected @endif>高松</option>
                    </optgroup>
                    <optgroup label="愛媛県" class="text-purple-600">
                        <option class="text-black" value="380010" @if (old('area') == '380010') selected @endif>松山</option>
                        <option class="text-black" value="380020" @if (old('area') == '380020') selected @endif>新居浜</option>
                        <option class="text-black" value="380030" @if (old('area') == '380030') selected @endif>宇和島</option>
                    </optgroup>
                    <optgroup label="高知県" class="text-purple-600">
                        <option class="text-black" value="390010" @if (old('area') == '390010') selected @endif>高知</option>
                        <option class="text-black" value="390020" @if (old('area') == '390020') selected @endif>室戸岬</option>
                        <option class="text-black" value="390030" @if (old('area') == '390030') selected @endif>清水</option>
                    </optgroup>
                    <optgroup label="福岡県" class="text-purple-600">
                        <option class="text-black" value="400010" @if (old('area') == '400010') selected @endif>福岡</option>
                        <option class="text-black" value="400020" @if (old('area') == '400020') selected @endif>八幡</option>
                        <option class="text-black" value="400030" @if (old('area') == '400030') selected @endif>飯塚</option>
                        <option class="text-black" value="400040" @if (old('area') == '400040') selected @endif>久留米</option>
                    </optgroup>
                    <optgroup label="佐賀県" class="text-purple-600">
                        <option class="text-black" value="410010" @if (old('area') == '410010') selected @endif>佐賀</option>
                        <option class="text-black" value="410020" @if (old('area') == '410020') selected @endif>伊万里</option>
                    </optgroup>
                    <optgroup label="長崎県" class="text-purple-600">
                        <option class="text-black" value="420010" @if (old('area') == '420010') selected @endif>長崎</option>
                        <option class="text-black" value="420020" @if (old('area') == '420020') selected @endif>佐世保</option>
                        <option class="text-black" value="420030" @if (old('area') == '420030') selected @endif>厳原</option>
                        <option class="text-black" value="420040" @if (old('area') == '420040') selected @endif>福江</option>
                    </optgroup>
                    <optgroup label="熊本県" class="text-purple-600">
                        <option class="text-black" value="430010" @if (old('area') == '430010') selected @endif>熊本</option>
                        <option class="text-black" value="430020" @if (old('area') == '430020') selected @endif>阿蘇乙姫</option>
                        <option class="text-black" value="430030" @if (old('area') == '430030') selected @endif>牛深</option>
                        <option class="text-black" value="430040" @if (old('area') == '430040') selected @endif>人吉</option>
                    </optgroup>
                    <optgroup label="大分県" class="text-purple-600">
                        <option class="text-black" value="440010" @if (old('area') == '440010') selected @endif>大分</option>
                        <option class="text-black" value="440020" @if (old('area') == '440020') selected @endif>中津</option>
                        <option class="text-black" value="440030" @if (old('area') == '440030') selected @endif>日田</option>
                        <option class="text-black" value="440040" @if (old('area') == '440040') selected @endif>佐伯</option>
                    </optgroup>
                    <optgroup label="宮崎県" class="text-purple-600">
                        <option class="text-black" value="450010" @if (old('area') == '450010') selected @endif>宮崎</option>
                        <option class="text-black" value="450020" @if (old('area') == '450020') selected @endif>延岡</option>
                        <option class="text-black" value="450030" @if (old('area') == '450030') selected @endif>都城</option>
                        <option class="text-black" value="450040" @if (old('area') == '450040') selected @endif>高千穂</option>
                    </optgroup>
                    <optgroup label="鹿児島県" class="text-purple-600">
                        <option class="text-black" value="460010" @if (old('area') == '460010') selected @endif>鹿児島</option>
                        <option class="text-black" value="460020" @if (old('area') == '460020') selected @endif>鹿屋</option>
                        <option class="text-black" value="460030" @if (old('area') == '460030') selected @endif>種子島</option>
                        <option class="text-black" value="460040" @if (old('area') == '460040') selected @endif>名瀬</option>
                    </optgroup>
                    <optgroup label="沖縄県" class="text-purple-600">
                        <option class="text-black" value="471010" @if (old('area') == '471010') selected @endif>那覇</option>
                        <option class="text-black" value="471020" @if (old('area') == '471020') selected @endif>名護</option>
                        <option class="text-black" value="471030" @if (old('area') == '471030') selected @endif>久米島</option>
                        <option class="text-black" value="472000" @if (old('area') == '472000') selected @endif>南大東</option>
                        <option class="text-black" value="473000" @if (old('area') == '473000') selected @endif>宮古島</option>
                        <option class="text-black" value="474010" @if (old('area') == '474010') selected @endif>石垣島</option>
                        <option class="text-black" value="474020" @if (old('area') == '474020') selected @endif>与那国島</option>
                    </optgroup>
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('パスワード（8文字以上）')" class="inline-block"/>
                <span class="bg-red-500 text-white p-1 text-xs rounded-lg">{{ __('必須') }}</span>

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('パスワード確認')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="agree_privacy col-span-6 flex flex-col items-center">
                <a href="/contact/privacy" class="text-blue-500 border-b border-blue-500 hover:text-blue-300 hover:border-blue-300 mt-3" target="_blank" rel="noopener noreferrer">プライバシーポリシーを読む</a>
                <div class="flex items-center mt-3">
                    <input type="checkbox" name="agree_privacy" id="agree" class="mr-2 cursor-pointer" value="" autocomplete="off" required="required" />
                    <label for="agree" class="cursor-pointer"> プライバシーポリシーを確認し、同意しました</label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('ユーザ登録済の方はこちら') }}
                </a>

                <x-button id="submit" class="ml-4">
                    {{ __('登録する') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

</x-guest-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(function() {
    $('#submit').prop('disabled', true);

    $('#agree').on('click', function() {
        if ($(this).prop('checked') == false) {
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
        }
    });
});
</script>
