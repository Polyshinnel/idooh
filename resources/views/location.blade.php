@extends('layouts.app')

@section('content')
    <x-hero-slide
        :background="asset($unit['hero_photo'])"
        :header="$unit['street'] . ' <br> ' . $unit['name']"
        subheader="DOWNLOAD MEDIAKIT"
        :subheader-action="asset($unit['media_kit_url'])"
    />

    @php
        $details = [
            [
                'title' => 'location',
                'icon' => 'assets/icons/location-icon.png',
                'value' => $unit['location'],
            ],
            [
                'title' => 'media',
                'icon' => 'assets/icons/media-icon.png',
                'value' => $unit['media'],
            ],
            [
                'title' => 'traffic',
                'icon' => 'assets/icons/traffic-icon.png',
                'value' => number_format($unit['traffic']),
            ],
            [
                'title' => 'size',
                'icon' => 'assets/icons/size-icon.png',
                'value' => $unit['size'],
            ],
            [
                'title' => 'landmarks',
                'icon' => 'assets/icons/search-icon.png',
                'value' => $unit['landmarks'],
            ],
        ];
    @endphp

    <section class="unitDescriptionList">
        @foreach($details as $detail)
            <div class="descriptionItem">
                <div
                    class="descriptionItemImage"
                    style="background-image: url('{{ asset($detail['icon']) }}')"
                ></div>
                <div class="descriptionItemContainer">
                    <div class="descriptionItemTitle">{{ $detail['title'] }}</div>
                    <div class="descriptionItemValue">
                        @if(is_array($detail['value']))
                            @foreach($detail['value'] as $valueItem)
                                <span>{{ $valueItem }}</span>
                            @endforeach
                        @else
                            {{ $detail['value'] }}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <section class="unitGallery">
        @if(!empty($unit['video_urls']))
            @foreach($unit['video_urls'] as $video)
                <video
                    class="unitPhoto"
                    autoplay
                    muted
                    loop
                    playsinline
                >
                    <source src="{{ asset($video) }}" type="video/mp4">
                </video>
            @endforeach
        @endif

        @foreach($unit['photos'] as $photo)
            <div
                class="unitPhoto"
                style="background-image: url('{{ asset($photo) }}')"
            ></div>
        @endforeach
    </section>

    <section class="unitMapContainer">
        <div class="unitMapTitle">Map</div>
        <div
            class="mapCanvas js-single-map"
            data-marker="{{ asset('assets/img/maker-drop.png') }}"
            data-center='@json($unit['coords'])'
        ></div>
    </section>
@endsection

@push('body-end')
    <script>
        window.IDOOH = window.IDOOH || {};
        window.IDOOH.unit = @json($unit);
    </script>
@endpush

