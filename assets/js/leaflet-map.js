console.log(kunstwerkenData);
console.log(uitgelichtDate);

document.addEventListener('DOMContentLoaded', () => {
    // Config map
    const config = {
        minZoom: 13,
        maxZoom: 14,
    };
    // Magnification with which the map will start
    const zoom = 14;
    // Coordinates
    const lat = 52.54991595738379;
    const lng = 4.6697379762638604;

    // Calling map
    const map = L.map("map", config).setView([lat, lng], zoom);

    // Used to load and display tile layers on the map
    // Most tile servers require attribution, which you can set under `Layer`
    L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    
    const pane = map.createPane("fixed", document.getElementById("map"));

    // Template SVG icon
    const svgIcon = `
    <svg width="31" height="48" viewBox="0 0 31 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.3137 47.1415L2.08795 22.5165L28.0675 22.2688L15.3137 47.1415Z" fill="black"/>
        <rect width="30" height="30" rx="15" fill="black"/>
        <rect x="6" y="5" width="18" height="18" rx="9" fill="white"/>
    </svg>`;

    // Create new div icon with SVG
    const newIcon = L.divIcon({
        className: "marker",
        html: svgIcon,
        iconSize: [40, 40],
        iconAnchor: [12, 24],
        popupAnchor: [7, -16],
    });

    let currentMarkerIndex = 0;
    const markers = [];
    const popup = document.querySelector('.route-detail-window');
    const titleElement = document.getElementById('popup-title');
    const popupDesc = document.getElementById('popup-desc');
    const popupImage = document.getElementById('popup-image');
    const popupRoute = document.getElementById('popup-btn2');
    const popupDetail = document.getElementById('popup-btn1');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');

    // Add markers for each kunstwerk
    const kunstwerkenList = kunstwerkenData;
    for (let i = 0; i < kunstwerkenList.length; i++) {
        const kunstwerk = kunstwerkenList[i];
        const lat = kunstwerk.lat;
        const lng = kunstwerk.lng;
        const title = kunstwerk.title;
        const image = kunstwerk.image;
        const description = kunstwerk.description;
        const knop_route = kunstwerk.knop_route;
        const knop_detail = kunstwerk.knop_detail;
        // const id = kunstwerk.title;

        const marker = L.marker([lat, lng], {
            icon: newIcon,
            alt: description,
        }).addTo(map);

        marker.data = { title, image, description, knop_route, knop_detail};
        markers.push(marker);

        marker.on("click", () => {
            currentMarkerIndex = i;
            showPopup(marker);
            fitBoundsPadding(marker);

            const latlng = marker.getLatLng();
            const point = map.latLngToContainerPoint(latlng);

            popup.style.display = "flex";

            const popupWidth = popup.offsetWidth;
            const popupHeight = popup.offsetHeight;

            const offsetX = 5; 
            const offsetY = -popupHeight / 2;

            popup.style.left = (point.x + 2) + "px";
            popup.style.top = (point.y - popup.offsetHeight / 2) + "px";
        });
    }

    function showPopup(marker) {
        titleElement.textContent = marker.data.title;
        popupDesc.innerHTML = marker.data.description;
        popupImage.src = marker.data.image;
        popupRoute.href = marker.data.knop_route;
        popupDetail.href = marker.data.knop_detail;
        popup.classList.remove('popup-hidden');
        // popup.id = marker.data.title;
        map.setView(marker.getLatLng(), zoom);
    }

    prevButton.addEventListener('click', (e) => {
        e.preventDefault();
        currentMarkerIndex = (currentMarkerIndex - 1 + markers.length) % markers.length;
        showPopup(markers[currentMarkerIndex]);
        setTimeout(() => {
            fitBoundsPadding(markers[currentMarkerIndex]);
        }, 100);
    });

    nextButton.addEventListener('click', (e) => {
        e.preventDefault();
        currentMarkerIndex = (currentMarkerIndex + 1) % markers.length;
        showPopup(markers[currentMarkerIndex]);
        setTimeout(() => {
            fitBoundsPadding(markers[currentMarkerIndex]);
        }, 100);
    });

    // Remove all animation class when popup close
    map.on("click", () => {
        removeAllAnimationClassFromMap();
    });

    const mediaQueryList = window.matchMedia("(min-width: 700px)");

    mediaQueryList.addEventListener("change", onMediaQueryChange);

    onMediaQueryChange(mediaQueryList);

    function onMediaQueryChange(event) {
        if (event.matches) {
            document.documentElement.style.setProperty("--min-width", "true");
        } else {
            // document.documentElement.style.removeProperty("--min-width");
        }
    }

    function fitBoundsPadding(marker) {
        removeAllAnimationClassFromMap();
        popup.style.display = "flex";
        // Get width info div
        const boxInfoWidth = document.querySelector(".route-detail-window").offsetWidth;
    
        // Add class to marker
        marker._icon.classList.add("animation");
        // marker._icon.id = marker.data.title;
    
        // Create a feature group, optionally given an initial set of layers
        const featureGroup = L.featureGroup([marker]).addTo(map);
    
        // Check if attribute exists
        const getPropertyWidth = document.documentElement.style.getPropertyValue("--min-width");
    
        // Sets a map view that contains the given geographical bounds
        // with the maximum zoom level possible
        map.fitBounds(featureGroup.getBounds(), {
            paddingTopLeft: [getPropertyWidth? -boxInfoWidth : 0, 10],
        });

    }

    function removeAllAnimationClassFromMap() {
        popup.style.display = "none";
        // Get all animation class on map
        const animations = document.querySelectorAll(".animation");
        animations.forEach(animation => {
            animation.classList.remove("animation");
        });

        // Back to default position
        map.setView([lat, lng], zoom);
    }
});
