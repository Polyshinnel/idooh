(function () {
    const doc = document;
    const menu = doc.querySelector('[data-menu]');
    const menuCloseButton = doc.querySelector('[data-menu-close]');
    const menuToggleButtons = doc.querySelectorAll('[data-menu-toggle]');
    const menuScrollButtons = doc.querySelectorAll('[data-scroll-target]');
    const mediaButtons = doc.querySelectorAll('[data-media-kit]');
    const contactButtons = doc.querySelectorAll('[data-link]');
    const scrollTopButton = doc.querySelector('[data-scroll-top]');
    const whatsappButton = doc.querySelector('[data-whatsapp]');
    let activeHamburger = null;

    const toggleMenu = (state) => {
        if (!menu) {
            return;
        }
        const shouldOpen = typeof state === 'boolean'
            ? state
            : !menu.classList.contains('mainMenuOpen');
        menu.classList.toggle('mainMenuOpen', shouldOpen);
        if (activeHamburger) {
            activeHamburger.classList.toggle('open', shouldOpen);
            if (!shouldOpen) {
                activeHamburger = null;
            }
        }
    };

    menuToggleButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (menu && !menu.classList.contains('mainMenuOpen')) {
                activeHamburger = button;
            }
            toggleMenu();
        });
    });

    menuCloseButton?.addEventListener('click', () => toggleMenu(false));

    menuScrollButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-scroll-target');
            if (targetId) {
                const target = doc.getElementById(targetId);
                target?.scrollIntoView({ behavior: 'smooth' });
            }
            toggleMenu(false);
        });
    });

    mediaButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const url = button.getAttribute('data-media-kit');
            if (url) {
                window.open(url, '_blank');
            }
        });
    });

    contactButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const link = button.getAttribute('data-link');
            if (link) {
                window.open(link, '_blank');
            }
        });
    });

    scrollTopButton?.addEventListener('click', () => {
        const home = doc.getElementById('home');
        home?.scrollIntoView({ behavior: 'smooth' });
    });

    whatsappButton?.addEventListener('click', () => {
        window.open('https://wa.me/971581733443', '_blank');
    });

    doc.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            toggleMenu(false);
        }
    });

    const parseJSON = (value, fallback) => {
        if (!value) {
            return fallback;
        }
        try {
            return JSON.parse(value);
        } catch (error) {
            return fallback;
        }
    };

    const getMapboxConfig = () => {
        return (window.IDOOH && window.IDOOH.mapbox) || {};
    };

    const createFeatures = (units) => {
        if (!Array.isArray(units)) {
            return [];
        }
        return units
            .filter((unit) => Array.isArray(unit.coords) && unit.coords.length === 2)
            .map((unit) => ({
                type: 'Feature',
                properties: { id: unit.id },
                geometry: {
                    type: 'Point',
                    coordinates: unit.coords,
                },
            }));
    };

    const extendBounds = (features, mapboxglInstance) => {
        if (!features.length) {
            return null;
        }
        return features.reduce((bounds, feature) => {
            const [lng, lat] = feature.geometry.coordinates;
            if (!bounds) {
                return new mapboxglInstance.LngLatBounds([lng, lat], [lng, lat]);
            }
            return bounds.extend([lng, lat]);
        }, null);
    };

    const setupMap = (options) => {
        if (typeof mapboxgl === 'undefined') {
            return;
        }
        const mapboxConfig = getMapboxConfig();
        if (!mapboxConfig.token) {
            return;
        }

        mapboxgl.accessToken = mapboxConfig.token;

        const { container, features, markerImage, fitBounds, unitUrl, clickable, center, zoom } = options;
        if (!container) {
            return;
        }

        const defaultCenter = center || (features[0]?.geometry?.coordinates ?? [55.2678473, 25.1278632]);
        const map = new mapboxgl.Map({
            container,
            style: mapboxConfig.style || 'mapbox://styles/mapbox/light-v11',
            center: defaultCenter,
            zoom: zoom || 9,
            scrollZoom: false,
            minZoom: 5,
        });

        map.addControl(new mapboxgl.NavigationControl({ showCompass: false }));

        map.on('load', () => {
            const addLayers = () => {
                if (!features.length) {
                    return;
                }
                map.addSource('units', {
                    type: 'geojson',
                    data: {
                        type: 'FeatureCollection',
                        features,
                    },
                    generateId: true,
                });

                map.addLayer({
                    id: 'units-layer',
                    type: 'symbol',
                    source: 'units',
                    layout: {
                        'icon-allow-overlap': true,
                        'icon-image': markerImage && map.hasImage('drop-marker') ? 'drop-marker' : 'marker-15',
                        'icon-size': 1,
                        'icon-anchor': 'bottom',
                    },
                });

                if (fitBounds) {
                    const bounds = extendBounds(features, mapboxgl);
                    if (bounds) {
                        map.fitBounds(bounds, {
                            padding: { top: 75, bottom: 30, left: 30, right: 30 },
                        });
                    }
                }
            };

            if (markerImage) {
                map.loadImage(markerImage, (error, image) => {
                    if (!error && image && !map.hasImage('drop-marker')) {
                        map.addImage('drop-marker', image);
                    }
                    addLayers();
                });
            } else {
                addLayers();
            }
        });

        if (clickable && unitUrl) {
            map.on('click', 'units-layer', (event) => {
                const feature = event.features && event.features[0];
                const id = feature?.properties?.id;
                if (typeof id !== 'undefined') {
                    window.location.href = `${unitUrl}/${id}`;
                }
            });
            map.on('mouseenter', 'units-layer', () => {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'units-layer', () => {
                map.getCanvas().style.cursor = '';
            });
        }
    };

    const initUnitsMap = () => {
        const container = doc.querySelector('.js-units-map');
        if (!container) {
            return;
        }
        const units = parseJSON(container.getAttribute('data-units'), []);
        const features = createFeatures(units);
        setupMap({
            container,
            features,
            markerImage: container.getAttribute('data-marker'),
            fitBounds: container.getAttribute('data-fit-bounds') === 'true',
            unitUrl: container.getAttribute('data-unit-url'),
            clickable: true,
        });
    };

    const initUnitMap = () => {
        const container = doc.querySelector('.js-single-map');
        if (!container) {
            return;
        }
        const center = parseJSON(container.getAttribute('data-center'), null);
        if (!Array.isArray(center) || center.length !== 2) {
            return;
        }
        const features = [
            {
                type: 'Feature',
                properties: {},
                geometry: {
                    type: 'Point',
                    coordinates: center,
                },
            },
        ];
        setupMap({
            container,
            features,
            markerImage: container.getAttribute('data-marker'),
            fitBounds: false,
            clickable: false,
            center,
            zoom: 13,
        });
    };

    const initMaps = () => {
        if (typeof mapboxgl === 'undefined') {
            return;
        }
        initUnitsMap();
        initUnitMap();
    };

    const waitForMapbox = () => {
        if (typeof mapboxgl !== 'undefined') {
            initMaps();
            return;
        }
        setTimeout(waitForMapbox, 200);
    };

    waitForMapbox();
})();

