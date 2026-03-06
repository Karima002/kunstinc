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
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    const pane = map.createPane("fixed", document.getElementById("map"));

    // Template SVG icon
    const svgIcon = `
    <svg xmlns="http://www.w3.org/2000/svg" width="47.088" height="69.48" viewBox="0 0 47.088 69.48">
  <g id="Group_94" data-name="Group 94" transform="translate(-938.998 -471)">
    <circle id="Ellipse_13" data-name="Ellipse 13" cx="23.5" cy="23.5" r="23.5" transform="translate(939 471)" fill="#e30813"/>
    <path id="Path_150" data-name="Path 150" d="M9425-17576.711h47.086s-.205,11.885-9.334,19.609-14.429,25.582-14.429,25.582-4.3-18.027-14-25.582S9425-17576.711,9425-17576.711Z" transform="translate(-8486 18072)" fill="#e30813"/>
    <circle id="Ellipse_14" data-name="Ellipse 14" cx="12" cy="12" r="12" transform="translate(951 483)" fill="#fff"/>
  </g>
</svg>
    `;

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
            popup.classList.add('show-popup');
            // popup.id = marker.data.title;
            popup.style.display = "flex"; // TO DO: Remove this line
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
