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



    public const USER_AREA_NAME_0 = '??????';
    public const USER_AREA_NAME_1 = '??????';
    public const USER_AREA_NAME_2 = '??????';
    public const USER_AREA_NAME_3 = '??????';
    public const USER_AREA_NAME_4 = '??????';
    public const USER_AREA_NAME_5 = '??????';
    public const USER_AREA_NAME_6 = '??????';
    public const USER_AREA_NAME_7 = '??????';
    public const USER_AREA_NAME_8 = '??????';
    public const USER_AREA_NAME_9 = '??????';
    public const USER_AREA_NAME_10 = '??????';
    public const USER_AREA_NAME_11 = '??????';
    public const USER_AREA_NAME_12 = '?????????';
    public const USER_AREA_NAME_13 = '?????????';
    public const USER_AREA_NAME_14 = '??????';
    public const USER_AREA_NAME_15 = '??????';
    public const USER_AREA_NAME_16 = '??????';
    public const USER_AREA_NAME_17 = '??????';
    public const USER_AREA_NAME_18 = '??????';
    public const USER_AREA_NAME_19 = '??????';
    public const USER_AREA_NAME_20 = '??????';
    public const USER_AREA_NAME_21 = '?????????';
    public const USER_AREA_NAME_22 = '??????';
    public const USER_AREA_NAME_23 = '??????';
    public const USER_AREA_NAME_24 = '??????';
    public const USER_AREA_NAME_25 = '??????';
    public const USER_AREA_NAME_26 = '??????';
    public const USER_AREA_NAME_27 = '??????';
    public const USER_AREA_NAME_28 = '??????';
    public const USER_AREA_NAME_29 = '??????';
    public const USER_AREA_NAME_30 = '??????';
    public const USER_AREA_NAME_31 = '?????????';
    public const USER_AREA_NAME_32 = '??????';
    public const USER_AREA_NAME_33 = '??????';
    public const USER_AREA_NAME_34 = '??????';
    public const USER_AREA_NAME_35 = '?????????';
    public const USER_AREA_NAME_36 = '?????????';
    public const USER_AREA_NAME_37 = '??????';
    public const USER_AREA_NAME_38 = '????????????';
    public const USER_AREA_NAME_39 = '????????????';
    public const USER_AREA_NAME_40 = '??????';
    public const USER_AREA_NAME_41 = '??????';
    public const USER_AREA_NAME_42 = '??????';
    public const USER_AREA_NAME_43 = '??????';
    public const USER_AREA_NAME_44 = '??????';
    public const USER_AREA_NAME_45 = '??????';
    public const USER_AREA_NAME_46 = '??????';
    public const USER_AREA_NAME_47 = '?????????';
    public const USER_AREA_NAME_48 = '??????';
    public const USER_AREA_NAME_49 = '??????';
    public const USER_AREA_NAME_50 = '?????????';
    public const USER_AREA_NAME_51 = '??????';
    public const USER_AREA_NAME_52 = '??????';
    public const USER_AREA_NAME_53 = '??????';
    public const USER_AREA_NAME_54 = '??????';
    public const USER_AREA_NAME_55 = '??????';
    public const USER_AREA_NAME_56 = '??????';
    public const USER_AREA_NAME_57 = '??????';
    public const USER_AREA_NAME_58 = '??????';
    public const USER_AREA_NAME_59 = '??????';
    public const USER_AREA_NAME_60 = '??????';
    public const USER_AREA_NAME_61 = '??????';
    public const USER_AREA_NAME_62 = '?????????';
    public const USER_AREA_NAME_63 = '??????';
    public const USER_AREA_NAME_64 = '??????';
    public const USER_AREA_NAME_65 = '??????';
    public const USER_AREA_NAME_66 = '??????';
    public const USER_AREA_NAME_67 = '??????';
    public const USER_AREA_NAME_68 = '??????';
    public const USER_AREA_NAME_69 = '??????';
    public const USER_AREA_NAME_70 = '??????';
    public const USER_AREA_NAME_71 = '??????';
    public const USER_AREA_NAME_72 = '?????????';
    public const USER_AREA_NAME_73 = '??????';
    public const USER_AREA_NAME_74 = '???';
    public const USER_AREA_NAME_75 = '??????';
    public const USER_AREA_NAME_76 = '??????';
    public const USER_AREA_NAME_77 = '??????';
    public const USER_AREA_NAME_78 = '??????';
    public const USER_AREA_NAME_79 = '??????';
    public const USER_AREA_NAME_80 = '??????';
    public const USER_AREA_NAME_81 = '??????';
    public const USER_AREA_NAME_82 = '??????';
    public const USER_AREA_NAME_83 = '??????';
    public const USER_AREA_NAME_84 = '??????';
    public const USER_AREA_NAME_85 = '?????????';
    public const USER_AREA_NAME_86 = '??????';
    public const USER_AREA_NAME_87 = '??????';
    public const USER_AREA_NAME_88 = '??????';
    public const USER_AREA_NAME_89 = '??????';
    public const USER_AREA_NAME_90 = '??????';
    public const USER_AREA_NAME_91 = '??????';
    public const USER_AREA_NAME_92 = '??????';
    public const USER_AREA_NAME_93 = '??????';
    public const USER_AREA_NAME_94 = '??????';
    public const USER_AREA_NAME_95 = '??????';
    public const USER_AREA_NAME_96 = '??????';
    public const USER_AREA_NAME_97 = '??????';
    public const USER_AREA_NAME_98 = '??????';
    public const USER_AREA_NAME_99 = '???';
    public const USER_AREA_NAME_100 = '??????';
    public const USER_AREA_NAME_101 = '?????????';
    public const USER_AREA_NAME_102 = '??????';
    public const USER_AREA_NAME_103 = '??????';
    public const USER_AREA_NAME_104 = '?????????';
    public const USER_AREA_NAME_105 = '?????????';
    public const USER_AREA_NAME_106 = '??????';
    public const USER_AREA_NAME_107 = '?????????';
    public const USER_AREA_NAME_108 = '??????';
    public const USER_AREA_NAME_109 = '??????';
    public const USER_AREA_NAME_110 = '??????';
    public const USER_AREA_NAME_111 = '??????';
    public const USER_AREA_NAME_112 = '?????????';
    public const USER_AREA_NAME_113 = '??????';
    public const USER_AREA_NAME_114 = '?????????';
    public const USER_AREA_NAME_115 = '??????';
    public const USER_AREA_NAME_116 = '?????????';
    public const USER_AREA_NAME_117 = '??????';
    public const USER_AREA_NAME_118 = '??????';
    public const USER_AREA_NAME_119 = '??????';
    public const USER_AREA_NAME_120 = '????????????';
    public const USER_AREA_NAME_121 = '??????';
    public const USER_AREA_NAME_122 = '??????';
    public const USER_AREA_NAME_123 = '??????';
    public const USER_AREA_NAME_124 = '??????';
    public const USER_AREA_NAME_125 = '??????';
    public const USER_AREA_NAME_126 = '??????';
    public const USER_AREA_NAME_127 = '??????';
    public const USER_AREA_NAME_128 = '??????';
    public const USER_AREA_NAME_129 = '??????';
    public const USER_AREA_NAME_130 = '?????????';
    public const USER_AREA_NAME_131 = '?????????';
    public const USER_AREA_NAME_132 = '??????';
    public const USER_AREA_NAME_133 = '?????????';
    public const USER_AREA_NAME_134 = '??????';
    public const USER_AREA_NAME_135 = '??????';
    public const USER_AREA_NAME_136 = '??????';
    public const USER_AREA_NAME_137 = '?????????';
    public const USER_AREA_NAME_138 = '?????????';
    public const USER_AREA_NAME_139 = '?????????';
    public const USER_AREA_NAME_140 = '?????????';
    public const USER_AREA_NAME_141 = '????????????';


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
