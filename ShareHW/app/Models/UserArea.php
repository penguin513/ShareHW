<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArea extends Model
{
    use HasFactory;

    public const USER_AREA_0 = '011000';
    public const USER_AREA_1 = '012010';
    public const USER_AREA_2 = '012020';
    public const USER_AREA_3 = '013010';
    public const USER_AREA_4 = '013020';
    public const USER_AREA_5 = '013030';
    public const USER_AREA_6 = '014010';
    public const USER_AREA_7 = '014020';
    public const USER_AREA_8 = '014030';
    public const USER_AREA_9 = '015010';
    public const USER_AREA_10 = '015020';
    public const USER_AREA_11 = '016010';
    public const USER_AREA_12 = '016020';
    public const USER_AREA_13 = '016030';
    public const USER_AREA_14 = '017010';
    public const USER_AREA_15 = '017020';
    public const USER_AREA_16 = '020010';
    public const USER_AREA_17 = '020020';
    public const USER_AREA_18 = '020030';
    public const USER_AREA_19 = '030010';
    public const USER_AREA_20 = '030020';
    public const USER_AREA_21 = '030030';
    public const USER_AREA_22 = '040010';
    public const USER_AREA_23 = '040020';
    public const USER_AREA_24 = '050010';
    public const USER_AREA_25 = '050020';
    public const USER_AREA_26 = '060010';
    public const USER_AREA_27 = '060020';
    public const USER_AREA_28 = '060030';
    public const USER_AREA_29 = '060040';
    public const USER_AREA_30 = '070010';
    public const USER_AREA_31 = '070020';
    public const USER_AREA_32 = '070030';
    public const USER_AREA_33 = '080010';
    public const USER_AREA_34 = '080020';
    public const USER_AREA_35 = '090010';
    public const USER_AREA_36 = '090020';
    public const USER_AREA_37 = '100010';
    public const USER_AREA_38 = '100020';
    public const USER_AREA_39 = '110010';
    public const USER_AREA_40 = '110020';
    public const USER_AREA_41 = '110030';
    public const USER_AREA_42 = '120010';
    public const USER_AREA_43 = '120020';
    public const USER_AREA_44 = '120030';
    public const USER_AREA_45 = '130010';
    public const USER_AREA_46 = '130020';
    public const USER_AREA_47 = '130030';
    public const USER_AREA_48 = '130040';
    public const USER_AREA_49 = '140010';
    public const USER_AREA_50 = '140020';
    public const USER_AREA_51 = '150010';
    public const USER_AREA_52 = '150020';
    public const USER_AREA_53 = '150030';
    public const USER_AREA_54 = '150040';
    public const USER_AREA_55 = '160010';
    public const USER_AREA_56 = '160020';
    public const USER_AREA_57 = '170010';
    public const USER_AREA_58 = '170020';
    public const USER_AREA_59 = '180010';
    public const USER_AREA_60 = '180020';
    public const USER_AREA_61 = '190010';
    public const USER_AREA_62 = '190020';
    public const USER_AREA_63 = '200010';
    public const USER_AREA_64 = '200020';
    public const USER_AREA_65 = '200030';
    public const USER_AREA_66 = '210010';
    public const USER_AREA_67 = '210020';
    public const USER_AREA_68 = '220010';
    public const USER_AREA_69 = '220020';
    public const USER_AREA_70 = '220030';
    public const USER_AREA_71 = '220040';
    public const USER_AREA_72 = '230010';
    public const USER_AREA_73 = '230020';
    public const USER_AREA_74 = '240010';
    public const USER_AREA_75 = '240020';
    public const USER_AREA_76 = '250010';
    public const USER_AREA_77 = '250020';
    public const USER_AREA_78 = '260010';
    public const USER_AREA_79 = '260020';
    public const USER_AREA_80 = '270000';
    public const USER_AREA_81 = '280010';
    public const USER_AREA_82 = '280020';
    public const USER_AREA_83 = '290010';
    public const USER_AREA_84 = '290020';
    public const USER_AREA_85 = '300010';
    public const USER_AREA_86 = '300020';
    public const USER_AREA_87 = '310010';
    public const USER_AREA_88 = '310020';
    public const USER_AREA_89 = '320010';
    public const USER_AREA_90 = '320020';
    public const USER_AREA_91 = '320030';
    public const USER_AREA_92 = '330010';
    public const USER_AREA_93 = '330020';
    public const USER_AREA_94 = '340010';
    public const USER_AREA_95 = '340020';
    public const USER_AREA_96 = '350010';
    public const USER_AREA_97 = '350020';
    public const USER_AREA_98 = '350030';
    public const USER_AREA_99 = '350040';
    public const USER_AREA_100 = '360010';
    public const USER_AREA_101 = '360020';
    public const USER_AREA_102 = '370000';
    public const USER_AREA_103 = '380010';
    public const USER_AREA_104 = '380020';
    public const USER_AREA_105 = '380030';
    public const USER_AREA_106 = '390010';
    public const USER_AREA_107 = '390020';
    public const USER_AREA_108 = '390030';
    public const USER_AREA_109 = '400010';
    public const USER_AREA_110 = '400020';
    public const USER_AREA_111 = '400030';
    public const USER_AREA_112 = '400040';
    public const USER_AREA_113 = '410010';
    public const USER_AREA_114 = '410020';
    public const USER_AREA_115 = '420010';
    public const USER_AREA_116 = '420020';
    public const USER_AREA_117 = '420030';
    public const USER_AREA_118 = '420040';
    public const USER_AREA_119 = '430010';
    public const USER_AREA_120 = '430020';
    public const USER_AREA_121 = '430030';
    public const USER_AREA_122 = '430040';
    public const USER_AREA_123 = '440010';
    public const USER_AREA_124 = '440020';
    public const USER_AREA_125 = '440030';
    public const USER_AREA_126 = '440040';
    public const USER_AREA_127 = '450010';
    public const USER_AREA_128 = '450020';
    public const USER_AREA_129 = '450030';
    public const USER_AREA_130 = '450040';
    public const USER_AREA_131 = '460010';
    public const USER_AREA_132 = '460020';
    public const USER_AREA_133 = '460030';
    public const USER_AREA_134 = '460040';
    public const USER_AREA_135 = '471010';
    public const USER_AREA_136 = '471020';
    public const USER_AREA_137 = '471030';
    public const USER_AREA_138 = '472000';
    public const USER_AREA_139 = '473000';
    public const USER_AREA_140 = '474010';
    public const USER_AREA_141 = '474020';



    public const USER_AREA_NAME_0 = '稚内';
    public const USER_AREA_NAME_1 = '旭川';
    public const USER_AREA_NAME_2 = '留萌';
    public const USER_AREA_NAME_3 = '網走';
    public const USER_AREA_NAME_4 = '北見';
    public const USER_AREA_NAME_5 = '紋別';
    public const USER_AREA_NAME_6 = '根室';
    public const USER_AREA_NAME_7 = '釧路';
    public const USER_AREA_NAME_8 = '帯広';
    public const USER_AREA_NAME_9 = '室蘭';
    public const USER_AREA_NAME_10 = '浦河';
    public const USER_AREA_NAME_11 = '札幌';
    public const USER_AREA_NAME_12 = '岩見沢';
    public const USER_AREA_NAME_13 = '倶知安';
    public const USER_AREA_NAME_14 = '函館';
    public const USER_AREA_NAME_15 = '江差';
    public const USER_AREA_NAME_16 = '青森';
    public const USER_AREA_NAME_17 = 'むつ';
    public const USER_AREA_NAME_18 = '八戸';
    public const USER_AREA_NAME_19 = '盛岡';
    public const USER_AREA_NAME_20 = '宮古';
    public const USER_AREA_NAME_21 = '大船渡';
    public const USER_AREA_NAME_22 = '仙台';
    public const USER_AREA_NAME_23 = '白石';
    public const USER_AREA_NAME_24 = '秋田';
    public const USER_AREA_NAME_25 = '横手';
    public const USER_AREA_NAME_26 = '山形';
    public const USER_AREA_NAME_27 = '米沢';
    public const USER_AREA_NAME_28 = '酒田';
    public const USER_AREA_NAME_29 = '新庄';
    public const USER_AREA_NAME_30 = '福島';
    public const USER_AREA_NAME_31 = '小名浜';
    public const USER_AREA_NAME_32 = '若松';
    public const USER_AREA_NAME_33 = '水戸';
    public const USER_AREA_NAME_34 = '土浦';
    public const USER_AREA_NAME_35 = '宇都宮';
    public const USER_AREA_NAME_36 = '大田原';
    public const USER_AREA_NAME_37 = '前橋';
    public const USER_AREA_NAME_38 = 'みなかみ';
    public const USER_AREA_NAME_39 = 'さいたま';
    public const USER_AREA_NAME_40 = '熊谷';
    public const USER_AREA_NAME_41 = '秩父';
    public const USER_AREA_NAME_42 = '千葉';
    public const USER_AREA_NAME_43 = '銚子';
    public const USER_AREA_NAME_44 = '館山';
    public const USER_AREA_NAME_45 = '東京';
    public const USER_AREA_NAME_46 = '大島';
    public const USER_AREA_NAME_47 = '八丈島';
    public const USER_AREA_NAME_48 = '父島';
    public const USER_AREA_NAME_49 = '横浜';
    public const USER_AREA_NAME_50 = '小田原';
    public const USER_AREA_NAME_51 = '新潟';
    public const USER_AREA_NAME_52 = '長岡';
    public const USER_AREA_NAME_53 = '高田';
    public const USER_AREA_NAME_54 = '相川';
    public const USER_AREA_NAME_55 = '富山';
    public const USER_AREA_NAME_56 = '伏木';
    public const USER_AREA_NAME_57 = '金沢';
    public const USER_AREA_NAME_58 = '輪島';
    public const USER_AREA_NAME_59 = '福井';
    public const USER_AREA_NAME_60 = '敦賀';
    public const USER_AREA_NAME_61 = '甲府';
    public const USER_AREA_NAME_62 = '河口湖';
    public const USER_AREA_NAME_63 = '長野';
    public const USER_AREA_NAME_64 = '松本';
    public const USER_AREA_NAME_65 = '飯田';
    public const USER_AREA_NAME_66 = '岐阜';
    public const USER_AREA_NAME_67 = '高山';
    public const USER_AREA_NAME_68 = '静岡';
    public const USER_AREA_NAME_69 = '網代';
    public const USER_AREA_NAME_70 = '三島';
    public const USER_AREA_NAME_71 = '浜松';
    public const USER_AREA_NAME_72 = '名古屋';
    public const USER_AREA_NAME_73 = '豊橋';
    public const USER_AREA_NAME_74 = '津';
    public const USER_AREA_NAME_75 = '尾鷲';
    public const USER_AREA_NAME_76 = '大津';
    public const USER_AREA_NAME_77 = '彦根';
    public const USER_AREA_NAME_78 = '京都';
    public const USER_AREA_NAME_79 = '舞鶴';
    public const USER_AREA_NAME_80 = '大阪';
    public const USER_AREA_NAME_81 = '神戸';
    public const USER_AREA_NAME_82 = '豊岡';
    public const USER_AREA_NAME_83 = '奈良';
    public const USER_AREA_NAME_84 = '風屋';
    public const USER_AREA_NAME_85 = '和歌山';
    public const USER_AREA_NAME_86 = '潮岬';
    public const USER_AREA_NAME_87 = '鳥取';
    public const USER_AREA_NAME_88 = '米子';
    public const USER_AREA_NAME_89 = '松江';
    public const USER_AREA_NAME_90 = '浜田';
    public const USER_AREA_NAME_91 = '西郷';
    public const USER_AREA_NAME_92 = '岡山';
    public const USER_AREA_NAME_93 = '津山';
    public const USER_AREA_NAME_94 = '広島';
    public const USER_AREA_NAME_95 = '庄原';
    public const USER_AREA_NAME_96 = '下関';
    public const USER_AREA_NAME_97 = '山口';
    public const USER_AREA_NAME_98 = '柳井';
    public const USER_AREA_NAME_99 = '萩';
    public const USER_AREA_NAME_100 = '徳島';
    public const USER_AREA_NAME_101 = '日和佐';
    public const USER_AREA_NAME_102 = '高松';
    public const USER_AREA_NAME_103 = '松山';
    public const USER_AREA_NAME_104 = '新居浜';
    public const USER_AREA_NAME_105 = '宇和島';
    public const USER_AREA_NAME_106 = '高知';
    public const USER_AREA_NAME_107 = '室戸岬';
    public const USER_AREA_NAME_108 = '清水';
    public const USER_AREA_NAME_109 = '福岡';
    public const USER_AREA_NAME_110 = '八幡';
    public const USER_AREA_NAME_111 = '飯塚';
    public const USER_AREA_NAME_112 = '久留米';
    public const USER_AREA_NAME_113 = '佐賀';
    public const USER_AREA_NAME_114 = '伊万里';
    public const USER_AREA_NAME_115 = '長崎';
    public const USER_AREA_NAME_116 = '佐世保';
    public const USER_AREA_NAME_117 = '厳原';
    public const USER_AREA_NAME_118 = '福江';
    public const USER_AREA_NAME_119 = '熊本';
    public const USER_AREA_NAME_120 = '阿蘇乙姫';
    public const USER_AREA_NAME_121 = '牛深';
    public const USER_AREA_NAME_122 = '人吉';
    public const USER_AREA_NAME_123 = '大分';
    public const USER_AREA_NAME_124 = '中津';
    public const USER_AREA_NAME_125 = '日田';
    public const USER_AREA_NAME_126 = '佐伯';
    public const USER_AREA_NAME_127 = '宮崎';
    public const USER_AREA_NAME_128 = '延岡';
    public const USER_AREA_NAME_129 = '都城';
    public const USER_AREA_NAME_130 = '高千穂';
    public const USER_AREA_NAME_131 = '鹿児島';
    public const USER_AREA_NAME_132 = '鹿屋';
    public const USER_AREA_NAME_133 = '種子島';
    public const USER_AREA_NAME_134 = '名瀬';
    public const USER_AREA_NAME_135 = '那覇';
    public const USER_AREA_NAME_136 = '名護';
    public const USER_AREA_NAME_137 = '久米島';
    public const USER_AREA_NAME_138 = '南大東';
    public const USER_AREA_NAME_139 = '宮古島';
    public const USER_AREA_NAME_140 = '石垣島';
    public const USER_AREA_NAME_141 = '与那国島';


    public const USER_AREA_OBJECT = [
        self::USER_AREA_0 => self::USER_AREA_NAME_0,
        self::USER_AREA_1 => self::USER_AREA_NAME_1,
        self::USER_AREA_2 => self::USER_AREA_NAME_2,
        self::USER_AREA_3 => self::USER_AREA_NAME_3,
        self::USER_AREA_4 => self::USER_AREA_NAME_4,
        self::USER_AREA_5 => self::USER_AREA_NAME_5,
        self::USER_AREA_6 => self::USER_AREA_NAME_6,
        self::USER_AREA_7 => self::USER_AREA_NAME_7,
        self::USER_AREA_8 => self::USER_AREA_NAME_8,
        self::USER_AREA_9 => self::USER_AREA_NAME_9,
        self::USER_AREA_10 => self::USER_AREA_NAME_10,
        self::USER_AREA_11 => self::USER_AREA_NAME_11,
        self::USER_AREA_12 => self::USER_AREA_NAME_12,
        self::USER_AREA_13 => self::USER_AREA_NAME_13,
        self::USER_AREA_14 => self::USER_AREA_NAME_14,
        self::USER_AREA_15 => self::USER_AREA_NAME_15,
        self::USER_AREA_16 => self::USER_AREA_NAME_16,
        self::USER_AREA_17 => self::USER_AREA_NAME_17,
        self::USER_AREA_18 => self::USER_AREA_NAME_18,
        self::USER_AREA_19 => self::USER_AREA_NAME_19,
        self::USER_AREA_20 => self::USER_AREA_NAME_20,
        self::USER_AREA_21 => self::USER_AREA_NAME_21,
        self::USER_AREA_22 => self::USER_AREA_NAME_22,
        self::USER_AREA_23 => self::USER_AREA_NAME_23,
        self::USER_AREA_24 => self::USER_AREA_NAME_24,
        self::USER_AREA_25 => self::USER_AREA_NAME_25,
        self::USER_AREA_26 => self::USER_AREA_NAME_26,
        self::USER_AREA_27 => self::USER_AREA_NAME_27,
        self::USER_AREA_28 => self::USER_AREA_NAME_28,
        self::USER_AREA_29 => self::USER_AREA_NAME_29,
        self::USER_AREA_30 => self::USER_AREA_NAME_30,
        self::USER_AREA_31 => self::USER_AREA_NAME_31,
        self::USER_AREA_32 => self::USER_AREA_NAME_32,
        self::USER_AREA_33 => self::USER_AREA_NAME_33,
        self::USER_AREA_34 => self::USER_AREA_NAME_34,
        self::USER_AREA_35 => self::USER_AREA_NAME_35,
        self::USER_AREA_36 => self::USER_AREA_NAME_36,
        self::USER_AREA_37 => self::USER_AREA_NAME_37,
        self::USER_AREA_38 => self::USER_AREA_NAME_38,
        self::USER_AREA_39 => self::USER_AREA_NAME_39,
        self::USER_AREA_40 => self::USER_AREA_NAME_40,
        self::USER_AREA_41 => self::USER_AREA_NAME_41,
        self::USER_AREA_42 => self::USER_AREA_NAME_42,
        self::USER_AREA_43 => self::USER_AREA_NAME_43,
        self::USER_AREA_44 => self::USER_AREA_NAME_44,
        self::USER_AREA_45 => self::USER_AREA_NAME_45,
        self::USER_AREA_46 => self::USER_AREA_NAME_46,
        self::USER_AREA_47 => self::USER_AREA_NAME_47,
        self::USER_AREA_48 => self::USER_AREA_NAME_48,
        self::USER_AREA_49 => self::USER_AREA_NAME_49,
        self::USER_AREA_50 => self::USER_AREA_NAME_50,
        self::USER_AREA_51 => self::USER_AREA_NAME_51,
        self::USER_AREA_52 => self::USER_AREA_NAME_52,
        self::USER_AREA_53 => self::USER_AREA_NAME_53,
        self::USER_AREA_54 => self::USER_AREA_NAME_54,
        self::USER_AREA_55 => self::USER_AREA_NAME_55,
        self::USER_AREA_56 => self::USER_AREA_NAME_56,
        self::USER_AREA_57 => self::USER_AREA_NAME_57,
        self::USER_AREA_58 => self::USER_AREA_NAME_58,
        self::USER_AREA_59 => self::USER_AREA_NAME_59,
        self::USER_AREA_60 => self::USER_AREA_NAME_60,
        self::USER_AREA_61 => self::USER_AREA_NAME_61,
        self::USER_AREA_62 => self::USER_AREA_NAME_62,
        self::USER_AREA_63 => self::USER_AREA_NAME_63,
        self::USER_AREA_64 => self::USER_AREA_NAME_64,
        self::USER_AREA_65 => self::USER_AREA_NAME_65,
        self::USER_AREA_66 => self::USER_AREA_NAME_66,
        self::USER_AREA_67 => self::USER_AREA_NAME_67,
        self::USER_AREA_68 => self::USER_AREA_NAME_68,
        self::USER_AREA_69 => self::USER_AREA_NAME_69,
        self::USER_AREA_70 => self::USER_AREA_NAME_70,
        self::USER_AREA_71 => self::USER_AREA_NAME_71,
        self::USER_AREA_72 => self::USER_AREA_NAME_72,
        self::USER_AREA_73 => self::USER_AREA_NAME_73,
        self::USER_AREA_74 => self::USER_AREA_NAME_74,
        self::USER_AREA_75 => self::USER_AREA_NAME_75,
        self::USER_AREA_76 => self::USER_AREA_NAME_76,
        self::USER_AREA_77 => self::USER_AREA_NAME_77,
        self::USER_AREA_78 => self::USER_AREA_NAME_78,
        self::USER_AREA_79 => self::USER_AREA_NAME_79,
        self::USER_AREA_80 => self::USER_AREA_NAME_80,
        self::USER_AREA_81 => self::USER_AREA_NAME_81,
        self::USER_AREA_82 => self::USER_AREA_NAME_82,
        self::USER_AREA_83 => self::USER_AREA_NAME_83,
        self::USER_AREA_84 => self::USER_AREA_NAME_84,
        self::USER_AREA_85 => self::USER_AREA_NAME_85,
        self::USER_AREA_86 => self::USER_AREA_NAME_86,
        self::USER_AREA_87 => self::USER_AREA_NAME_87,
        self::USER_AREA_88 => self::USER_AREA_NAME_88,
        self::USER_AREA_89 => self::USER_AREA_NAME_89,
        self::USER_AREA_90 => self::USER_AREA_NAME_90,
        self::USER_AREA_91 => self::USER_AREA_NAME_91,
        self::USER_AREA_92 => self::USER_AREA_NAME_92,
        self::USER_AREA_93 => self::USER_AREA_NAME_93,
        self::USER_AREA_94 => self::USER_AREA_NAME_94,
        self::USER_AREA_95 => self::USER_AREA_NAME_95,
        self::USER_AREA_96 => self::USER_AREA_NAME_96,
        self::USER_AREA_97 => self::USER_AREA_NAME_97,
        self::USER_AREA_98 => self::USER_AREA_NAME_98,
        self::USER_AREA_99 => self::USER_AREA_NAME_99,
        self::USER_AREA_100 => self::USER_AREA_NAME_100,
        self::USER_AREA_101 => self::USER_AREA_NAME_101,
        self::USER_AREA_102 => self::USER_AREA_NAME_102,
        self::USER_AREA_103 => self::USER_AREA_NAME_103,
        self::USER_AREA_104 => self::USER_AREA_NAME_104,
        self::USER_AREA_105 => self::USER_AREA_NAME_105,
        self::USER_AREA_106 => self::USER_AREA_NAME_106,
        self::USER_AREA_107 => self::USER_AREA_NAME_107,
        self::USER_AREA_108 => self::USER_AREA_NAME_108,
        self::USER_AREA_109 => self::USER_AREA_NAME_109,
        self::USER_AREA_110 => self::USER_AREA_NAME_110,
        self::USER_AREA_111 => self::USER_AREA_NAME_111,
        self::USER_AREA_112 => self::USER_AREA_NAME_112,
        self::USER_AREA_113 => self::USER_AREA_NAME_113,
        self::USER_AREA_114 => self::USER_AREA_NAME_114,
        self::USER_AREA_115 => self::USER_AREA_NAME_115,
        self::USER_AREA_116 => self::USER_AREA_NAME_116,
        self::USER_AREA_117 => self::USER_AREA_NAME_117,
        self::USER_AREA_118 => self::USER_AREA_NAME_118,
        self::USER_AREA_119 => self::USER_AREA_NAME_119,
        self::USER_AREA_120 => self::USER_AREA_NAME_120,
        self::USER_AREA_121 => self::USER_AREA_NAME_121,
        self::USER_AREA_122 => self::USER_AREA_NAME_122,
        self::USER_AREA_123 => self::USER_AREA_NAME_123,
        self::USER_AREA_124 => self::USER_AREA_NAME_124,
        self::USER_AREA_125 => self::USER_AREA_NAME_125,
        self::USER_AREA_126 => self::USER_AREA_NAME_126,
        self::USER_AREA_127 => self::USER_AREA_NAME_127,
        self::USER_AREA_128 => self::USER_AREA_NAME_128,
        self::USER_AREA_129 => self::USER_AREA_NAME_129,
        self::USER_AREA_130 => self::USER_AREA_NAME_130,
        self::USER_AREA_131 => self::USER_AREA_NAME_131,
        self::USER_AREA_132 => self::USER_AREA_NAME_132,
        self::USER_AREA_133 => self::USER_AREA_NAME_133,
        self::USER_AREA_134 => self::USER_AREA_NAME_134,
        self::USER_AREA_135 => self::USER_AREA_NAME_135,
        self::USER_AREA_136 => self::USER_AREA_NAME_136,
        self::USER_AREA_137 => self::USER_AREA_NAME_137,
        self::USER_AREA_138 => self::USER_AREA_NAME_138,
        self::USER_AREA_139 => self::USER_AREA_NAME_139,
        self::USER_AREA_140 => self::USER_AREA_NAME_140,
        self::USER_AREA_141 => self::USER_AREA_NAME_141,
    ];

    public const USER_AREA_ARRAY = [
        self::USER_AREA_0,
        self::USER_AREA_1,
        self::USER_AREA_2,
        self::USER_AREA_3,
        self::USER_AREA_4,
        self::USER_AREA_5,
        self::USER_AREA_6,
        self::USER_AREA_7,
        self::USER_AREA_8,
        self::USER_AREA_9,
        self::USER_AREA_10,
        self::USER_AREA_11,
        self::USER_AREA_12,
        self::USER_AREA_13,
        self::USER_AREA_14,
        self::USER_AREA_15,
        self::USER_AREA_16,
        self::USER_AREA_17,
        self::USER_AREA_18,
        self::USER_AREA_19,
        self::USER_AREA_20,
        self::USER_AREA_21,
        self::USER_AREA_22,
        self::USER_AREA_23,
        self::USER_AREA_24,
        self::USER_AREA_25,
        self::USER_AREA_26,
        self::USER_AREA_27,
        self::USER_AREA_28,
        self::USER_AREA_29,
        self::USER_AREA_30,
        self::USER_AREA_31,
        self::USER_AREA_32,
        self::USER_AREA_33,
        self::USER_AREA_34,
        self::USER_AREA_35,
        self::USER_AREA_36,
        self::USER_AREA_37,
        self::USER_AREA_38,
        self::USER_AREA_39,
        self::USER_AREA_40,
        self::USER_AREA_41,
        self::USER_AREA_42,
        self::USER_AREA_43,
        self::USER_AREA_44,
        self::USER_AREA_45,
        self::USER_AREA_46,
        self::USER_AREA_47,
        self::USER_AREA_48,
        self::USER_AREA_49,
        self::USER_AREA_50,
        self::USER_AREA_51,
        self::USER_AREA_52,
        self::USER_AREA_53,
        self::USER_AREA_54,
        self::USER_AREA_55,
        self::USER_AREA_56,
        self::USER_AREA_57,
        self::USER_AREA_58,
        self::USER_AREA_59,
        self::USER_AREA_60,
        self::USER_AREA_61,
        self::USER_AREA_62,
        self::USER_AREA_63,
        self::USER_AREA_64,
        self::USER_AREA_65,
        self::USER_AREA_66,
        self::USER_AREA_67,
        self::USER_AREA_68,
        self::USER_AREA_69,
        self::USER_AREA_70,
        self::USER_AREA_71,
        self::USER_AREA_72,
        self::USER_AREA_73,
        self::USER_AREA_74,
        self::USER_AREA_75,
        self::USER_AREA_76,
        self::USER_AREA_77,
        self::USER_AREA_78,
        self::USER_AREA_79,
        self::USER_AREA_80,
        self::USER_AREA_81,
        self::USER_AREA_82,
        self::USER_AREA_83,
        self::USER_AREA_84,
        self::USER_AREA_85,
        self::USER_AREA_86,
        self::USER_AREA_87,
        self::USER_AREA_88,
        self::USER_AREA_89,
        self::USER_AREA_90,
        self::USER_AREA_91,
        self::USER_AREA_92,
        self::USER_AREA_93,
        self::USER_AREA_94,
        self::USER_AREA_95,
        self::USER_AREA_96,
        self::USER_AREA_97,
        self::USER_AREA_98,
        self::USER_AREA_99,
        self::USER_AREA_100,
        self::USER_AREA_101,
        self::USER_AREA_102,
        self::USER_AREA_103,
        self::USER_AREA_104,
        self::USER_AREA_105,
        self::USER_AREA_106,
        self::USER_AREA_107,
        self::USER_AREA_108,
        self::USER_AREA_109,
        self::USER_AREA_110,
        self::USER_AREA_111,
        self::USER_AREA_112,
        self::USER_AREA_113,
        self::USER_AREA_114,
        self::USER_AREA_115,
        self::USER_AREA_116,
        self::USER_AREA_117,
        self::USER_AREA_118,
        self::USER_AREA_119,
        self::USER_AREA_120,
        self::USER_AREA_121,
        self::USER_AREA_122,
        self::USER_AREA_123,
        self::USER_AREA_124,
        self::USER_AREA_125,
        self::USER_AREA_126,
        self::USER_AREA_127,
        self::USER_AREA_128,
        self::USER_AREA_129,
        self::USER_AREA_130,
        self::USER_AREA_131,
        self::USER_AREA_132,
        self::USER_AREA_133,
        self::USER_AREA_134,
        self::USER_AREA_135,
        self::USER_AREA_136,
        self::USER_AREA_137,
        self::USER_AREA_138,
        self::USER_AREA_139,
        self::USER_AREA_140,
        self::USER_AREA_141,
    ];
}
