<?php

namespace EasySwoole\DDL\Enum;

use EasySwoole\Spl\SplEnum;

/**
 * 字符集类型枚举
 * Class Character
 * @package EasySwoole\DDL\Enum
 */
class Character extends SplEnum
{
    // armscii8
    const ARMSCII8_BIN = "armscii8_bin";
    const ARMSCII8_GENERAL_CI = "armscii8_general_ci";

    // ascii
    const ASCII_BIN = "ascii_bin";
    const ASCII_GENERAL_CI = "ascii_general_ci";

    // big5
    const BIG5_BIN = "big5_bin";
    const BIG5_CHINESE_CI = "big5_chinese_ci";

    // binary
    const BINARY = "binary";

    // cp1250
    const CP1250_BIN = "cp1250_bin";
    const CP1250_CROATIAN_CI = "cp1250_croatian_ci";
    const CP1250_CZECH_CS = "cp1250_czech_cs";
    const CP1250_GENERAL_CI = "cp1250_general_ci";
    const CP1250_POLISH_CI = "cp1250_polish_ci";

    // cp1251
    const CP1251_BIN = "cp1251_bin";
    const CP1251_BULGARIAN_CI = "cp1251_bulgarian_ci";
    const CP1251_GENERAL_CI = "cp1251_general_ci";
    const CP1251_GENERAL_CS = "cp1251_general_cs";
    const CP1251_UKRAINIAN_CI = "cp1251_ukrainian_ci";

    // cp1256
    const CP1256_BIN = "cp1256_bin";
    const CP1256_GENERAL_CI = "cp1256_general_ci";

    // cp1257
    const CP1257_BIN = "cp1257_bin";
    const CP1257_GENERAL_CI = "cp1257_general_ci";
    const CP1257_LITHUANIAN_CI = "cp1257_lithuanian_ci";

    // cp850
    const CP850_BIN = "cp850_bin";
    const CP850_GENERAL_CI = "cp850_general_ci";

    // cp852
    const CP852_BIN = "cp852_bin";
    const CP852_GENERAL_CI = "cp852_general_ci";

    // cp866
    const CP866_BIN = "cp866_bin";
    const CP866_GENERAL_CI = "cp866_general_ci";

    // cp932
    const CP932_BIN = "cp932_bin";
    const CP932_JAPANESE_CI = "cp932_japanese_ci";
    // dec8
    const DEC8_BIN = "dec8_bin";
    const DEC8_SWEDISH_CI = "dec8_swedish_ci";

    // eucjpms
    const EUCJPMS_BIN = "eucjpms_bin";
    const EUCJPMS_JAPANESE_CI = "eucjpms_japanese_ci";

    // euckr
    const EUCKR_BIN = "euckr_bin";
    const EUCKR_KOREAN_CI = "euckr_korean_ci";

    // gb18030
    const GB18030_BIN = "gb18030_bin";
    const GB18030_CHINESE_CI = "gb18030_chinese_ci";
    const GB18030_UNICODE_520_CI = "gb18030_unicode_520_ci";

    // gb2312
    const GB2312_BIN = "gb2312_bin";
    const GB2312_CHINESE_CI = "gb2312_chinese_ci";

    // gbk
    const GBK_BIN = "gbk_bin";
    const GBK_CHINESE_CI = "gbk_chinese_ci";

    // geostd8
    const GEOSTD8_BIN = "geostd8_bin";
    const GEOSTD8_GENERAL_CI = "geostd8_general_ci";

    // greek
    const GREEK_BIN = "greek_bin";
    const GREEK_GENERAL_CI = "greek_general_ci";

    // hebrew
    const HEBREW_BIN = "hebrew_bin";
    const HEBREW_GENERAL_CI = "hebrew_general_ci";

    // hp8
    const HP8_BIN = "hp8_bin";
    const HP8_ENGLISH_CI = "hp8_english_ci";

    // keybcs2
    const KEYBCS2_BIN = "keybcs2_bin";
    const KEYBCS2_GENERAL_CI = "keybcs2_general_ci";

    // koi8r
    const KOI8R_BIN = "koi8r_bin";
    const KOI8R_GENERAL_CI = "koi8r_general_ci";

    // koi8u
    const KOI8U_BIN = "koi8u_bin";
    const KOI8U_GENERAL_CI = "koi8u_general_ci";

    // latin1
    const LATIN1_BIN = "latin1_bin";
    const LATIN1_DANISH_CI = "latin1_danish_ci";
    const LATIN1_GENERAL_CI = "latin1_general_ci";
    const LATIN1_GENERAL_CS = "latin1_general_cs";
    const LATIN1_GERMAN1_CI = "latin1_german1_ci";
    const LATIN1_GERMAN2_CI = "latin1_german2_ci";
    const LATIN1_SPANISH_CI = "latin1_spanish_ci";
    const LATIN1_SWEDISH_CI = "latin1_swedish_ci";

    // latin2
    const LATIN2_BIN = "latin2_bin";
    const LATIN2_CROATIAN_CI = "latin2_croatian_ci";
    const LATIN2_CZECH_CS = "latin2_czech_cs";
    const LATIN2_GENERAL_CI = "latin2_general_ci";
    const LATIN2_HUNGARIAN_CI = "latin2_hungarian_ci";

    // latin5
    const LATIN5_BIN = "latin5_bin";
    const LATIN5_TURKISH_CI = "latin5_turkish_ci";

    // latin7
    const LATIN7_BIN = "latin7_bin";
    const LATIN7_ESTONIAN_CS = "latin7_estonian_cs";
    const LATIN7_GENERAL_CI = "latin7_general_ci";
    const LATIN7_GENERAL_CS = "latin7_general_cs";

    // macce
    const MACCE_BIN = "macce_bin";
    const MACCE_GENERAL_CI = "macce_general_ci";

    // macroman
    const MACROMAN_BIN = "macroman_bin";
    const MACROMAN_GENERAL_CI = "macroman_general_ci";

    // sjis
    const SJIS_BIN = "sjis_bin";
    const SJIS_JAPANESE_CI = "sjis_japanese_ci";

    // swe7
    const SWE7_BIN = "swe7_bin";
    const SWE7_SWEDISH_CI = "swe7_swedish_ci";

    // tis620
    const TIS620_BIN = "tis620_bin";
    const TIS620_THAI_CI = "tis620_thai_ci";

    // ucs2
    const UCS2_BIN = "ucs2_bin";
    const UCS2_CROATIAN_CI = "ucs2_croatian_ci";
    const UCS2_CZECH_CI = "ucs2_czech_ci";
    const UCS2_DANISH_CI = "ucs2_danish_ci";
    const UCS2_ESPERANTO_CI = "ucs2_esperanto_ci";
    const UCS2_ESTONIAN_CI = "ucs2_estonian_ci";
    const UCS2_GENERAL_CI = "ucs2_general_ci";
    const UCS2_GENERAL_MYSQL500_CI = "ucs2_general_mysql500_ci";
    const UCS2_GERMAN2_CI = "ucs2_german2_ci";
    const UCS2_HUNGARIAN_CI = "ucs2_hungarian_ci";
    const UCS2_ICELANDIC_CI = "ucs2_icelandic_ci";
    const UCS2_LATVIAN_CI = "ucs2_latvian_ci";
    const UCS2_LITHUANIAN_CI = "ucs2_lithuanian_ci";
    const UCS2_PERSIAN_CI = "ucs2_persian_ci";
    const UCS2_POLISH_CI = "ucs2_polish_ci";
    const UCS2_ROMANIAN_CI = "ucs2_romanian_ci";
    const UCS2_ROMAN_CI = "ucs2_roman_ci";
    const UCS2_SINHALA_CI = "ucs2_sinhala_ci";
    const UCS2_SLOVAK_CI = "ucs2_slovak_ci";
    const UCS2_SLOVENIAN_CI = "ucs2_slovenian_ci";
    const UCS2_SPANISH2_CI = "ucs2_spanish2_ci";
    const UCS2_SPANISH_CI = "ucs2_spanish_ci";
    const UCS2_SWEDISH_CI = "ucs2_swedish_ci";
    const UCS2_TURKISH_CI = "ucs2_turkish_ci";
    const UCS2_UNICODE_520_CI = "ucs2_unicode_520_ci";
    const UCS2_UNICODE_CI = "ucs2_unicode_ci";
    const UCS2_VIETNAMESE_CI = "ucs2_vietnamese_ci";

    // ujis
    const UJIS_BIN = "ujis_bin";
    const UJIS_JAPANESE_CI = "ujis_japanese_ci";

    // utf16
    const UTF16_BIN = "utf16_bin";
    const UTF16_CROATIAN_CI = "utf16_croatian_ci";
    const UTF16_CZECH_CI = "utf16_czech_ci";
    const UTF16_DANISH_CI = "utf16_danish_ci";
    const UTF16_ESPERANTO_CI = "utf16_esperanto_ci";
    const UTF16_ESTONIAN_CI = "utf16_estonian_ci";
    const UTF16_GENERAL_CI = "utf16_general_ci";
    const UTF16_GERMAN2_CI = "utf16_german2_ci";
    const UTF16_HUNGARIAN_CI = "utf16_hungarian_ci";
    const UTF16_ICELANDIC_CI = "utf16_icelandic_ci";
    const UTF16_LATVIAN_CI = "utf16_latvian_ci";
    const UTF16_LITHUANIAN_CI = "utf16_lithuanian_ci";
    const UTF16_PERSIAN_CI = "utf16_persian_ci";
    const UTF16_POLISH_CI = "utf16_polish_ci";
    const UTF16_ROMANIAN_CI = "utf16_romanian_ci";
    const UTF16_ROMAN_CI = "utf16_roman_ci";
    const UTF16_SINHALA_CI = "utf16_sinhala_ci";
    const UTF16_SLOVAK_CI = "utf16_slovak_ci";
    const UTF16_SLOVENIAN_CI = "utf16_slovenian_ci";
    const UTF16_SPANISH2_CI = "utf16_spanish2_ci";
    const UTF16_SPANISH_CI = "utf16_spanish_ci";
    const UTF16_SWEDISH_CI = "utf16_swedish_ci";
    const UTF16_TURKISH_CI = "utf16_turkish_ci";
    const UTF16_UNICODE_520_CI = "utf16_unicode_520_ci";
    const UTF16_UNICODE_CI = "utf16_unicode_ci";
    const UTF16_VIETNAMESE_CI = "utf16_vietnamese_ci";

    // utf16le
    const UTF16LE_BIN = "utf16le_bin";
    const UTF16LE_GENERAL_CI = "utf16le_general_ci";

    // utf32
    const UTF32_BIN = "utf32_bin";
    const UTF32_CROATIAN_CI = "utf32_croatian_ci";
    const UTF32_CZECH_CI = "utf32_czech_ci";
    const UTF32_DANISH_CI = "utf32_danish_ci";
    const UTF32_ESPERANTO_CI = "utf32_esperanto_ci";
    const UTF32_ESTONIAN_CI = "utf32_estonian_ci";
    const UTF32_GENERAL_CI = "utf32_general_ci";
    const UTF32_GERMAN2_CI = "utf32_german2_ci";
    const UTF32_HUNGARIAN_CI = "utf32_hungarian_ci";
    const UTF32_ICELANDIC_CI = "utf32_icelandic_ci";
    const UTF32_LATVIAN_CI = "utf32_latvian_ci";
    const UTF32_LITHUANIAN_CI = "utf32_lithuanian_ci";
    const UTF32_PERSIAN_CI = "utf32_persian_ci";
    const UTF32_POLISH_CI = "utf32_polish_ci";
    const UTF32_ROMANIAN_CI = "utf32_romanian_ci";
    const UTF32_ROMAN_CI = "utf32_roman_ci";
    const UTF32_SINHALA_CI = "utf32_sinhala_ci";
    const UTF32_SLOVAK_CI = "utf32_slovak_ci";
    const UTF32_SLOVENIAN_CI = "utf32_slovenian_ci";
    const UTF32_SPANISH2_CI = "utf32_spanish2_ci";
    const UTF32_SPANISH_CI = "utf32_spanish_ci";
    const UTF32_SWEDISH_CI = "utf32_swedish_ci";
    const UTF32_TURKISH_CI = "utf32_turkish_ci";
    const UTF32_UNICODE_520_CI = "utf32_unicode_520_ci";
    const UTF32_UNICODE_CI = "utf32_unicode_ci";
    const UTF32_VIETNAMESE_CI = "utf32_vietnamese_ci";

    // utf8
    const UTF8_BIN = "utf8_bin";
    const UTF8_CROATIAN_CI = "utf8_croatian_ci";
    const UTF8_CZECH_CI = "utf8_czech_ci";
    const UTF8_DANISH_CI = "utf8_danish_ci";
    const UTF8_ESPERANTO_CI = "utf8_esperanto_ci";
    const UTF8_ESTONIAN_CI = "utf8_estonian_ci";
    const UTF8_GENERAL_CI = "utf8_general_ci";
    const UTF8_GENERAL_MYSQL500_ci = "utf8_general_mysql500";
    const UTF8_GERMAN2_CI = "utf8_german2_ci";
    const UTF8_HUNGARIAN_CI = "utf8_hungarian_ci";
    const UTF8_ICELANDIC_CI = "utf8_icelandic_ci";
    const UTF8_LATVIAN_CI = "utf8_latvian_ci";
    const UTF8_LITHUANIAN_CI = "utf8_lithuanian_ci";
    const UTF8_PERSIAN_CI = "utf8_persian_ci";
    const UTF8_POLISH_CI = "utf8_polish_ci";
    const UTF8_ROMANIAN_CI = "utf8_romanian_ci";
    const UTF8_ROMAN_CI = "utf8_roman_ci";
    const UTF8_SINHALA_CI = "utf8_sinhala_ci";
    const UTF8_SLOVAK_CI = "utf8_slovak_ci";
    const UTF8_SLOVENIAN_CI = "utf8_slovenian_ci";
    const UTF8_SPANISH2_CI = "utf8_spanish2_ci";
    const UTF8_SPANISH_CI = "utf8_spanish_ci";
    const UTF8_SWEDISH_CI = "utf8_swedish_ci";
    const UTF8_TOLOWER_CI = "utf8_tolower_ci";
    const UTF8_TURKISH_CI = "utf8_turkish_ci";
    const UTF8_UNICODE_520_CI = "utf8_unicode_520_ci";
    const UTF8_UNICODE_CI = "utf8_unicode_ci";
    const UTF8_VIETNAMESE_CI = "utf8_vietnamese_ci";

    // utf8mb4
    const UTF8MB4_0900_AI_CI = "utf8mb4_0900_ai_ci";
    const UTF8MB4_0900_AS_CI = "utf8mb4_0900_as_ci";
    const UTF8MB4_0900_AS_CS = "utf8mb4_0900_as_cs";
    const UTF8MB4_BIN = "utf8mb4_bin";
    const UTF8MB4_CROATIAN_CI = "utf8mb4_croatian_ci";
    const UTF8MB4_CS_0900_AI_CI = "utf8mb4_cs_0900_ai_ci";
    const UTF8MB4_CS_0900_AS_CS = "utf8mb4_cs_0900_as_cs";
    const UTF8MB4_CZECH_CI = "utf8mb4_czech_ci";
    const UTF8MB4_DANISH_CI = "utf8mb4_danish_ci";
    const UTF8MB4_DA_0900_AI_CI = "utf8mb4_da_0900_ai_ci";
    const UTF8MB4_DA_0900_AS_CS = "utf8mb4_da_0900_as_cs";
    const UTF8MB4_DE_PB_0900_AI_Ci = "utf8mb4_de_pb_0900_ai_c";
    const UTF8MB4_DE_PB_0900_AS_Cs = "utf8mb4_de_pb_0900_as_c";
    const UTF8MB4_EO_0900_AI_CI = "utf8mb4_eo_0900_ai_ci";
    const UTF8MB4_EO_0900_AS_CS = "utf8mb4_eo_0900_as_cs";
    const UTF8MB4_ESPERANTO_CI = "utf8mb4_esperanto_ci";
    const UTF8MB4_ESTONIAN_CI = "utf8mb4_estonian_ci";
    const UTF8MB4_ES_0900_AI_CI = "utf8mb4_es_0900_ai_ci";
    const UTF8MB4_ES_0900_AS_CS = "utf8mb4_es_0900_as_cs";
    const UTF8MB4_ES_TRAD_0900_AI_ci = "utf8mb4_es_trad_0900_ai";
    const UTF8MB4_ES_TRAD_0900_AS_cs = "utf8mb4_es_trad_0900_as";
    const UTF8MB4_ET_0900_AI_CI = "utf8mb4_et_0900_ai_ci";
    const UTF8MB4_ET_0900_AS_CS = "utf8mb4_et_0900_as_cs";
    const UTF8MB4_GENERAL_CI = "utf8mb4_general_ci";
    const UTF8MB4_GERMAN2_CI = "utf8mb4_german2_ci";
    const UTF8MB4_HR_0900_AI_CI = "utf8mb4_hr_0900_ai_ci";
    const UTF8MB4_HR_0900_AS_CS = "utf8mb4_hr_0900_as_cs";
    const UTF8MB4_HUNGARIAN_CI = "utf8mb4_hungarian_ci";
    const UTF8MB4_HU_0900_AI_CI = "utf8mb4_hu_0900_ai_ci";
    const UTF8MB4_HU_0900_AS_CS = "utf8mb4_hu_0900_as_cs";
    const UTF8MB4_ICELANDIC_CI = "utf8mb4_icelandic_ci";
    const UTF8MB4_IS_0900_AI_CI = "utf8mb4_is_0900_ai_ci";
    const UTF8MB4_IS_0900_AS_CS = "utf8mb4_is_0900_as_cs";
    const UTF8MB4_JA_0900_AS_CS = "utf8mb4_ja_0900_as_cs";
    const UTF8MB4_JA_0900_AS_CS_Ks = "utf8mb4_ja_0900_as_cs_k";
    const UTF8MB4_LATVIAN_CI = "utf8mb4_latvian_ci";
    const UTF8MB4_LA_0900_AI_CI = "utf8mb4_la_0900_ai_ci";
    const UTF8MB4_LA_0900_AS_CS = "utf8mb4_la_0900_as_cs";
    const UTF8MB4_LITHUANIAN_CI = "utf8mb4_lithuanian_ci";
    const UTF8MB4_LT_0900_AI_CI = "utf8mb4_lt_0900_ai_ci";
    const UTF8MB4_LT_0900_AS_CS = "utf8mb4_lt_0900_as_cs";
    const UTF8MB4_LV_0900_AI_CI = "utf8mb4_lv_0900_ai_ci";
    const UTF8MB4_LV_0900_AS_CS = "utf8mb4_lv_0900_as_cs";
    const UTF8MB4_PERSIAN_CI = "utf8mb4_persian_ci";
    const UTF8MB4_PL_0900_AI_CI = "utf8mb4_pl_0900_ai_ci";
    const UTF8MB4_PL_0900_AS_CS = "utf8mb4_pl_0900_as_cs";
    const UTF8MB4_POLISH_CI = "utf8mb4_polish_ci";
    const UTF8MB4_ROMANIAN_CI = "utf8mb4_romanian_ci";
    const UTF8MB4_ROMAN_CI = "utf8mb4_roman_ci";
    const UTF8MB4_RO_0900_AI_CI = "utf8mb4_ro_0900_ai_ci";
    const UTF8MB4_RO_0900_AS_CS = "utf8mb4_ro_0900_as_cs";
    const UTF8MB4_RU_0900_AI_CI = "utf8mb4_ru_0900_ai_ci";
    const UTF8MB4_RU_0900_AS_CS = "utf8mb4_ru_0900_as_cs";
    const UTF8MB4_SINHALA_CI = "utf8mb4_sinhala_ci";
    const UTF8MB4_SK_0900_AI_CI = "utf8mb4_sk_0900_ai_ci";
    const UTF8MB4_SK_0900_AS_CS = "utf8mb4_sk_0900_as_cs";
    const UTF8MB4_SLOVAK_CI = "utf8mb4_slovak_ci";
    const UTF8MB4_SLOVENIAN_CI = "utf8mb4_slovenian_ci";
    const UTF8MB4_SL_0900_AI_CI = "utf8mb4_sl_0900_ai_ci";
    const UTF8MB4_SL_0900_AS_CS = "utf8mb4_sl_0900_as_cs";
    const UTF8MB4_SPANISH2_CI = "utf8mb4_spanish2_ci";
    const UTF8MB4_SPANISH_CI = "utf8mb4_spanish_ci";
    const UTF8MB4_SV_0900_AI_CI = "utf8mb4_sv_0900_ai_ci";
    const UTF8MB4_SV_0900_AS_CS = "utf8mb4_sv_0900_as_cs";
    const UTF8MB4_SWEDISH_CI = "utf8mb4_swedish_ci";
    const UTF8MB4_TR_0900_AI_CI = "utf8mb4_tr_0900_ai_ci";
    const UTF8MB4_TR_0900_AS_CS = "utf8mb4_tr_0900_as_cs";
    const UTF8MB4_TURKISH_CI = "utf8mb4_turkish_ci";
    const UTF8MB4_UNICODE_520_CI = "utf8mb4_unicode_520_ci";
    const UTF8MB4_UNICODE_CI = "utf8mb4_unicode_ci";
    const UTF8MB4_VIETNAMESE_CI = "utf8mb4_vietnamese_ci";
    const UTF8MB4_VI_0900_AI_CI = "utf8mb4_vi_0900_ai_ci";
    const UTF8MB4_VI_0900_AS_CS = "utf8mb4_vi_0900_as_cs";
}
