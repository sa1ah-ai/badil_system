from nltk.stem.isri import ISRIStemmer
import arabicstopwords.arabicstopwords as stp
from nltk import word_tokenize
import re
import string
import joblib
import pandas as pd
import warnings
from sklearn.exceptions import InconsistentVersionWarning
import os

# Ignore the warning
warnings.filterwarnings("ignore", category=InconsistentVersionWarning)

model_Path = os.path.dirname(os.path.abspath(__file__))+"\Crime_Category_Classifier.pkl"
# class CrimeClassifier:


def clean_text(text):
    arabPunct = ']،,÷/[{\'|\n)١×؟…—:‘–"\\ـ(~ ؛’%>.€$<£-}'
    arabShapes = 'ًٌٍَُِّْ'
    araStopWords = stp.stopwords_list()
    st = ISRIStemmer()
    punctPattern = '[' + re.escape(string.punctuation + arabPunct) + ']'
    shapePattern = '[' + re.escape(arabShapes) + ']'
    temp_text = re.sub(punctPattern, lambda x: ' ' if x.group(0) != ' ' else x.group(0), text)
    no_punt_text = re.sub(shapePattern, '', temp_text)
    tokenized_list = word_tokenize(no_punt_text)
    re_stop_list = [word for word in tokenized_list if word not in araStopWords]
    stem_list = [st.stem(word) for word in re_stop_list]
    detokenize_text = ' '.join(stem_list)
    ser_text = pd.Series(detokenize_text)
    return ser_text


def has_english_letters(text):
    pattern = r'[a-zA-Z]'
    matches = re.findall(pattern, text)
    return len(matches) > 0

def classify_crime(text):
    model = joblib.load(model_Path)
    arr = model.predict(text)
    crime_category = ' '.join(arr)
    return crime_category

def translate_element(element):
    translation_dict = {
        'Weapons': 'الجرائم المتعلقة بالتعاطي مع الاسلحة',
        'Blackmail': 'جرائم الابتزاز',
        'Assault and Violence': 'جرائم الاعتداء و التعنيف',
        'Insult, Abuse, and Defamation': 'جرائم الإهانة والسباب',
        'Sabotage': 'التخريب',
        'Intimidation': 'الترهيب',
        'Loitering': 'التسكع',
        'Trespassing': ' جرائم التعدي على ممتلكات الغير',
        'Family Crimes': 'الجرائم العائلية',
        'Bribery': 'الرشوة',
        'Disorderly Conduct': 'السلوك غير المنضبط',
        'Racism': 'العنصرية',
        'Gambling': 'القمار',
        'Drugs': 'جرائم المخدرات',
        'Disturbing the Peace': 'انتهاك السلام العام',
        'Concealed Carry Violation': 'انتهاك رخصة الحمل المخفية',
        'Environmental': 'بيئية',
        'Other Crimes': 'جرائم أخرى',
        'Harassment and Sexual Crimes': 'جرائم متعلقة بالتحرش والجنس',
        'Crimes against Children': 'جريمة تتعلق بالأطفال',
        'Criminal': 'جرائم  حدود جنائية من الدرجة الاولى',
        'Theft': 'جرائم السرقة والسطو',
        'Fraud': 'جرائم الاحتيال والنصب',
        'Non-criminal': 'ليست جريمة',
        'Alcohol': 'الجرائم المتعلقة بالكحول'
    }
    translation = translation_dict.get(element, 'لايوجد بديل اصلاحي')
    return translation

def getAlternative(element):
    alternative_dict = {
        'الجرائم المتعلقة بالتعاطي مع الاسلحة': 'لا يتوفر بديل اصلاحي لهذه الجريمة',
        'جرائم الابتزاز': 'لا يتوفر بديل اصلاحي لهذه الجريمة',
        'جرائم الاعتداء و التعنيف': 'لا يتوفر بديل اصلاحي لهذه الجريمة',
        'جرائم الإهانة والسباب': 'العمل في الحراسة العامة للمسجد الحرم والمسجد النبوي',
        'التخريب': 'العمل في الحراسة العامة للمسجد الحرم والمسجد النبوي',
        'الترهيب': 'لا يتوفر بديل اصلاحي لهذه الجريمة',
        'التسكع': 'العمل في الحراسة العامة للمسجد الحرم والمسجد النبوي',
        'التعدي على ممتلكات الغير': 'لا يتوفر بديل اصلاحي لهذه الجريمة',
        'الجرائم العائلية': 'العمل في في رئاسة العامة للمسجد الحرم والمسجد النبوي',
        'الرشوة': 'لا يتوفر بديل اصلاحي لجرائم الحدود',
        'السلوك غير المنضبط': 'خدمة المجتمع: تنظيف الاماكن العامة',
        'العنصرية': 'العمل في الحراسة العامة للمسجد الحرم والمسجد النبوي',
        'القمار': 'العمل في الحراسة العامة للمسجد الحرم والمسجد النبوي',
        'جرائم المخدرات': 'يقترح النظام برنامج الدعم الذاتي للمدمنين برامج',
        'انتهاك السلام العام': 'العمل في مراكز دار العجزة',
        'انتهاك رخصة الحمل المخفية': 'العمل في مراكز التاهيل الشامل (لذوي الهمم)',
        'بيئية': 'العمل في مزارع المراعي',
        'جرائم أخرى': 'لا يتوفر',
        'جرائم متعلقة بالتحرش والجنس': 'لا يتوفر بديل اصلاحي لجرائم الحدود',
        'جريمة تتعلق بالأطفال': 'العمل في مراكز التاهيل الشامل (لذوي الهمم)',
        'جرائم  حدود من الدرجة الاولى': 'لا يتوفر بديل اصلاحي للجرائم الجنائية',
        'جرائم السرقة والسطو': 'لا يتوفر بديل اصلاحي لجرائم الحدود',
        'جرائم الاحتيال والنصب': 'لا يتوفر بديل اصلاحي لهذا النوع من الجرائم',
        'ليست جريمة': 'بريء',
        'الجرائم المتعلقة بالكحول': 'يقترح النظام برنامج الدعم الذاتي للمدمنين'
    }
    alternative = alternative_dict.get(element, 'لا يوجد بديل اصلاحي')
    return alternative

def classify(text):
    return translate_element(classify_crime(clean_text(text)))

