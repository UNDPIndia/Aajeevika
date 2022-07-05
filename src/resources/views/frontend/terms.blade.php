@extends('layouts.header')
@section('title', 'Terms & Conditions | UNDP')
@section('content')


<section class="verify-otp">
    <div class="container">
        <div class="row">
        	<div class="col-12">
                @if(Session::get('weblangauge') == 'kn')
                    प्रिंटिंग और टाइपसेटिंग उद्योग का बस डमी टेक्स्ट है। लोरेम इप्सम 1500 के दशक के बाद से उद्योग का मानक डमी टेक्स्ट रहा है, जब एक अज्ञात प्रिंटर ने एक प्रकार की गैली ली और इसे एक प्रकार की नमूना पुस्तक बनाने के लिए हाथापाई की। यह न केवल पांच शताब्दियों तक जीवित रहा है, बल्कि इलेक्ट्रॉनिक टाइपसेटिंग में भी छलांग लगाई है, जो अनिवार्य रूप से अपरिवर्तित है। इसे 1960 के दशक में लोरेम इप्सम पैसेज वाले लेट्रासेट शीट्स के रिलीज के साथ लोकप्रिय किया गया था, और हाल ही में डेस्कटॉप प्रकाशन सॉफ्टवेयर जैसे एल्डस पेजमेकर के साथ लोरेम इप्सम के संस्करण भी शामिल थे।
                @else                
                    is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
