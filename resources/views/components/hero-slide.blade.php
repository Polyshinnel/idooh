@props([
    'background',
    'header' => '',
    'subheader' => null,
    'subheaderAction' => null,
    'identifier' => null,
    'parallax' => false,
])

@php
    $classes = ['heroSlide'];
    if ($parallax) {
        $classes[] = 'heroSlideParallax';
    }
    $withActions = ! $parallax;
@endphp

@php
    $sectionAttributes = $attributes->class($classes);
    if ($identifier) {
        $sectionAttributes = $sectionAttributes->merge(['id' => $identifier]);
    }
@endphp

<section {{ $sectionAttributes }} style="background-image: url('{{ $background }}')">
    <div class="heroHeader {{ $withActions ? '' : 'heroHeaderSpacer' }}">
        @if($withActions)
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="IDOOH logo" class="heroLogo">
            </a>
            <svg class="hamburgerIcon" viewBox="0 0 60 40" data-menu-toggle>
                <g stroke="#fff" stroke-width="4">
                    <path class="hamburgerLine top-line" d="M10,10 L50,10 Z"></path>
                    <path class="hamburgerLine middle-line" d="M10,20 L50,20 Z"></path>
                    <path class="hamburgerLine bottom-line" d="M10,30 L50,30 Z"></path>
                </g>
            </svg>
        @endif
    </div>

    <div class="heroTitle">
        <div class="landingHeader">{!! $header !!}</div>
        @if($subheader)
            @if($subheaderAction)
                <button type="button" class="heroSubHeader" data-media-kit="{{ $subheaderAction }}">
                    {!! $subheader !!}
                </button>
            @else
                <div class="heroSubHeader">{!! $subheader !!}</div>
            @endif
        @endif
    </div>

    {{ $slot }}
</section>

