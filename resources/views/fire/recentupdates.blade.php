@extends('layouts.fire_new')
@section('content')

<!-- ======= About Us Section ======= -->
<div class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Recent Updates</h2>
            <ol style="padding-top: 45px;">
                <li><a href="{{ route('actionIndex')}}">Home</a></li>
                <li>Recent Updates</li>
            </ol>
        </div>
    </div>
</div><!-- End About Us Section -->

<style>
    .accordion {
        background: transparent;
        width: 100%;
    }

    .accordion:hover {
        background: transparent;
    }

    .accordion,
    .sub-accordion {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .accordion__item {
        background: #fff;
        border: 1px solid #eee;
        margin-bottom: 5px;
        width: 100%;
    }
    .accordion__item .accordion__link_active {
        color: #fff;
        background: #d73502;
        font-weight: 500;
        font-size: 18px;
    }

    .accordion__link {
        font-weight: 500;
        font-size: 1rem;
        position: relative;
        color: #000;
        text-decoration: none;
        border: 1px solid #eee;
        display: block;
        padding: 12px 50px 12px 20px;
    }

    .accordion__link:not(.accordion__link_active):after {
        position: absolute;
        content: "";
        border-top: 12px #000 solid;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        right: 22px;
        top: 50%;
        transform: translatey(-6px);
    }

    .accordion__link:not(.accordion__link_active):hover {
        opacity: .8;
        color: #000;
        background: #fff;
    }

    .accordion__link:not(.accordion__link_active):hover:after {
        border-top: 12px #000 solid;
    }

    .sub-accordion {
        padding: 5px 20px;
        display: none;
        height: 0;
        overflow: hidden;
    }
    .sub-accordion p {
        font-size: 16px;
        color: #000;
        font-weight: 100;
        text-align: justify;
        padding: 10px 0px;
    }

    .sub-accordion__item {
        padding: 5px 0;
    }

    .accordion__link_active {
        color: #000;
        background-color: #fff;
    }

    .accordion__link_active:after {
        position: absolute;
        content: "";
        border-bottom: 12px #fff solid;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        right: 22px;
        top: 50%;
        transform: translatey(-6px);
    }

    .accordion__link_active+div {
        display: block;
        height: 100%;
    } 
    article {
        width:100%;
    }
    article
</style>
<!-- ======= About Section ======= -->
<section class="services">
    <div class="container d-flex mt-20">
        <article>
            <ul class="accordion">
                @php
                    $i = 1;
                @endphp
                @foreach ($recentupdates as $ru)
                <li class="accordion__item">
                    <a href="#" class="accordion__link @if ($i == 1) accordion__link_active @endif">
                    {{$ru->title}}
                    </a>
                    <div class="sub-accordion">
                        <p>{{$ru->description}}</p>
                        <hr>
                        @if($ru->document)
                        <a href="{{ asset($ru->document) }}" class="btn btn-success w-30" title="Download" target="_blank" style="margin-bottom: 10px;">Download Document</a>
                        @else
                        <p class="text-danger">Document Not Available</p>   
                        @endif
                    </div>
                </li>
                @php
                    $i++;
                @endphp 
                @endforeach 
            </ul>
        </article>
    </div>
</section>

@endsection
@section('scripts')
function slide(link) {

    var down = function (callback, time) 
    {
        var subMenu = link.nextElementSibling;
        var height = subMenu.clientHeight;
        var part = height / 100;

        var paddingTop = parseInt(window.getComputedStyle(subMenu, null).getPropertyValue('padding-top'));
        var paddingBottom = parseInt(window.getComputedStyle(subMenu, null).getPropertyValue('padding-bottom'));
        var paddingTopPart = parseInt(paddingTop) / 50;
        var paddingBottomPart = parseInt(paddingBottom) / 30;

        (function innerFunc(i, t, b) {
            subMenu.style.height = i + 'px';
            i += part;
            if(t < paddingTop) 
            {
                t +=paddingTopPart;
                subMenu.style.paddingTop=t + 'px' ;
            } 
            else if(b < paddingBottom) 
            {
                b +=paddingBottomPart;
                subMenu.style.paddingBottom=b + 'px' ;
            }
            if(i < height)
            {
                setTimeout(function() { innerFunc(i, t, b);}, time / 100);
            } 
            else 
            {
                subMenu.removeAttribute('style');
                callback();
            }
        })(0, 0, 0);
    },

    up=function (callback, time) 
    {
        var subMenu=link.nextElementSibling;
        var height=subMenu.clientHeight;
        var part=subMenu.clientHeight / 100;
        var paddingTop=parseInt(window.getComputedStyle(subMenu).paddingTop);
        var paddingBottom=parseInt(window.getComputedStyle(subMenu).paddingBottom);
        var paddingTopPart=parseInt(paddingTop) / 30;
        var paddingBottomPart=parseInt(paddingBottom) / 50;

        (function innerFunc(i, t, b) 
        {
            subMenu.style.height=i + 'px' ;
            i -=part;
            i=i.toFixed(2);
            if(b> 0) 
            {
                b -= paddingBottomPart;
                b = b.toFixed(1);
                subMenu.style.paddingBottom = b + 'px';
            } 
            else if(t > 0) 
            {
                t -= paddingTopPart;
                t = t.toFixed(1);
                subMenu.style.paddingTop = t + 'px';
            }
            if(i > 0) 
            {
                setTimeout(function() { innerFunc(i, t, b); }, time / 100);
            } 
            else 
            {
                subMenu.removeAttribute('style');
                callback();
            }

        })(height, paddingTop, paddingBottom);
    }

    return {
        down: down,
        up: up
    }
}

var accordion = (function() {

    var menu = document.querySelectorAll('.accordion');
    var activeClass = 'accordion__link_active';
    var arr = [];
    var timer = 100;

    for(let i = 0; i < menu.length; i++) {
        for(let p=0; p < menu[i].children.length; p++) 
        {
            var link=menu[i].children[p].firstElementChild;
            if(link.classList.contains(activeClass)) {
                arr[i]=link;
            }
        }
    }

    function accordionInner(i) {
        var clicked=false;
        menu[i].addEventListener('click', function(e) 
        {
            if(e.target.tagName==='A' && !clicked) {
                clicked=true;
                if(e.target.classList.contains(activeClass)) 
                {
                    slide(e.target).up(function() {
                        clicked=false;
                        e.target.classList.remove(activeClass);
                    }, timer);
                } 
                else 
                {
                    if(arr.length> 0) {
                        slide(arr[i-1]).up(function() {
                            arr[i-1].classList.remove(activeClass);
                            arr[i-1] = e.target;
                        }, timer);
                    }
                    e.target.classList.add(activeClass);
                    slide(e.target).down(function() {
                        clicked = false;
                        arr[i-1] = e.target;
                    }, timer);
                }
            }
        });
        i++;
        if(i < menu.length) { accordionInner(i); }
    } accordionInner(0);
})();
@stop