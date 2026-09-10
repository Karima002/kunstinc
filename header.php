<!doctype html>
<html lang="nl">
 
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Kunst in C">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <?php wp_head(); ?>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
 
</head>
 
<body>
    <header>
    <nav>
    <a href="/" class="logo">
    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    width="196.57" height="102.72" viewBox="0 0 196.57 102.72">
    <defs>
      <clipPath id="clip-path">
        <rect id="Rectangle_36" data-name="Rectangle 36" width="196.57" height="102.72" fill="none" />
      </clipPath>
    </defs>
    <g id="Group_29" data-name="Group 29">
      <path class="K" id="Path_27" data-name="Path 27"
        d="M24.29,34.88l-5.73-7.1h-.04v7.1H14.88V19.46h3.64v6.28h.06l5.51-6.28h4.66l-6.64,7.1,7.04,8.32Z"
        fill="#1d1d1b" />
      <g id="Group_19" data-name="Group 19" clip-path="url(#clip-path)">
        <path id="Path_28" data-name="Path 28"
          d="M112.05,26.05a5.479,5.479,0,0,1-1.34,1.96,6.15,6.15,0,0,1-2.1,1.27,7.667,7.667,0,0,1-2.73.46,7.779,7.779,0,0,1-2.75-.46,6.17,6.17,0,0,1-2.07-1.27,5.537,5.537,0,0,1-1.31-1.96,6.68,6.68,0,0,1-.46-2.54V13.9h3.7v9.3a4.294,4.294,0,0,0,.16,1.2,3.081,3.081,0,0,0,.5,1.01,2.34,2.34,0,0,0,.89.71,3.053,3.053,0,0,0,1.34.26,3.2,3.2,0,0,0,1.34-.26,2.355,2.355,0,0,0,.9-.71,2.9,2.9,0,0,0,.5-1.01,4.7,4.7,0,0,0,.15-1.2V13.9h3.72v9.61a6.681,6.681,0,0,1-.47,2.54"
          fill="#1d1d1b" />
      </g>
      <path id="Path_29" data-name="Path 29"
        d="M170.13,0l.09,10.06h-.07L163.97,0h-4.25V15.42h3.62l-.09-10.08h.06l6.21,10.08h4.23V0Z" fill="#1d1d1b" />
      <g id="Group_20" data-name="Group 20" clip-path="url(#clip-path)">
        <path id="Path_30" data-name="Path 30"
          d="M155.54,38.19a3.373,3.373,0,0,0-1.25-.97,3.5,3.5,0,0,0-1.49-.36,3.808,3.808,0,0,0-.75.07,2.037,2.037,0,0,0-.69.25,1.664,1.664,0,0,0-.51.48,1.276,1.276,0,0,0-.21.75,1.183,1.183,0,0,0,.16.65,1.517,1.517,0,0,0,.48.46,4.378,4.378,0,0,0,.75.36c.29.11.62.22.98.34.52.17,1.07.37,1.63.58a6.1,6.1,0,0,1,1.55.84,4.362,4.362,0,0,1,1.15,1.3,3.775,3.775,0,0,1,.46,1.93,5,5,0,0,1-.49,2.3,4.6,4.6,0,0,1-1.32,1.6,5.729,5.729,0,0,1-1.9.94,8.111,8.111,0,0,1-2.2.3,8.972,8.972,0,0,1-3.2-.58,6.627,6.627,0,0,1-2.57-1.65l2.44-2.48a4.644,4.644,0,0,0,1.49,1.17,4.087,4.087,0,0,0,1.84.47,3.656,3.656,0,0,0,.81-.09,2.129,2.129,0,0,0,.69-.28,1.571,1.571,0,0,0,.47-.52,1.6,1.6,0,0,0,.17-.78,1.183,1.183,0,0,0-.22-.74,2.276,2.276,0,0,0-.62-.56,4.941,4.941,0,0,0-1-.46c-.4-.14-.85-.29-1.36-.45a12.823,12.823,0,0,1-1.45-.57,4.95,4.95,0,0,1-1.26-.84,3.748,3.748,0,0,1-.89-1.24,4.3,4.3,0,0,1-.34-1.77,4.341,4.341,0,0,1,.52-2.2,4.59,4.59,0,0,1,1.37-1.5,5.973,5.973,0,0,1,1.92-.86,8.756,8.756,0,0,1,2.16-.27,8.02,8.02,0,0,1,2.67.48,6.738,6.738,0,0,1,2.38,1.42l-2.37,2.5Z"
          fill="#1d1d1b" />
      </g>
      <path id="Path_31" data-name="Path 31" d="M184.13,57.01v3.18h4.36V72.43h3.72V60.19h4.36V57.01Z" fill="#1d1d1b" />
      <rect id="Rectangle_38" data-name="Rectangle 38" width="3.75" height="15.42" transform="translate(109.44 57.39)"
        fill="#1d1d1b" />
      <path id="Path_32" data-name="Path 32"
        d="M101.99,87.3l.09,10.07h-.07L95.83,87.3H91.58v15.42h3.61l-.08-10.08h.06l6.21,10.08h4.23V87.3Z"
        fill="#1d1d1b" />
      <g id="Group_21" data-name="Group 21" clip-path="url(#clip-path)">
        <path id="Path_33" data-name="Path 33"
          d="M11.76,89.18a8.22,8.22,0,0,1-3.46.69A9.086,9.086,0,0,1,5,89.28,7.638,7.638,0,0,1,.64,85.03,8.314,8.314,0,0,1,0,81.72a8.512,8.512,0,0,1,.64-3.35,7.62,7.62,0,0,1,1.77-2.56,7.829,7.829,0,0,1,2.66-1.62,9.322,9.322,0,0,1,3.29-.57,9.146,9.146,0,0,1,3.21.58,6.21,6.21,0,0,1,2.56,1.69L11.6,78.42a3.148,3.148,0,0,0-1.37-1.07A4.619,4.619,0,0,0,8.49,77a4.452,4.452,0,0,0-1.8.36,4.139,4.139,0,0,0-1.4.99,4.426,4.426,0,0,0-.91,1.49,5.209,5.209,0,0,0-.33,1.89,5.413,5.413,0,0,0,.33,1.92,4.531,4.531,0,0,0,.9,1.49,4.008,4.008,0,0,0,1.38.97,4.423,4.423,0,0,0,1.76.35,4.113,4.113,0,0,0,1.94-.44,3.872,3.872,0,0,0,1.33-1.13l2.59,2.44a7.334,7.334,0,0,1-2.53,1.86"
          fill="#e30613" />
      </g>
      <path id="Path_34" data-name="Path 34" d="M115.82,21.97c15.35,4.73,32.14,5.24,42.1-2.01" fill="none"
          stroke="#e30613" stroke-miterlimit="10" stroke-width="0.2" />
      <path id="Path_35" data-name="Path 35" d="M158.67,22.17l1.66-4.14-4.41.63Z" fill="#e30613" />
      <g id="Group_22" data-name="Group 22" clip-path="url(#clip-path)">
        <path id="Path_36" data-name="Path 36" d="M168.88,16.5c.22,2.79.77,5.77-7.03,14.83" fill="none" stroke="#e30613"
          stroke-miterlimit="10" stroke-width="0.2" />
      </g>
      <path id="Path_37" data-name="Path 37" d="M160.65,29.3l-.81,4.38,4.2-1.49Z" fill="#e30613" />
      <g id="Group_23" data-name="Group 23" clip-path="url(#clip-path)">
        <path id="Path_38" data-name="Path 38" d="M159.24,50.26a74.942,74.942,0,0,0,22.2,13.68" fill="none"
          stroke="#e30613" stroke-miterlimit="10" stroke-width="0.2" />
      </g>
      <path id="Path_39" data-name="Path 39" d="M180,65.65l4.4-.7-2.8-3.46Z" fill="#e30613" />
      <g id="Group_24" data-name="Group 24" clip-path="url(#clip-path)">
        <path id="Path_40" data-name="Path 40" d="M87.9,94.45S54.14,74.91,20.12,81.08" fill="none" stroke="#e30613"
          stroke-miterlimit="10" stroke-width="0.2" />
      </g>
      <path id="Path_41" data-name="Path 41" d="M20.35,78.89,17,81.82l4.21,1.44Z" fill="#e30613" />
      <g id="Group_25" data-name="Group 25" clip-path="url(#clip-path)">
        <path id="Path_42" data-name="Path 42" d="M11.1,69.62s-2.98-13.18,5.52-28.9" fill="none" stroke="#e30613"
          stroke-miterlimit="10" stroke-width="0.2" />
      </g>
      <path id="Path_43" data-name="Path 43" d="M18.16,42.43l-.09-4.46-3.81,2.3Z" fill="#e30613" />
      <g id="Group_26" data-name="Group 26" clip-path="url(#clip-path)">
        <path id="Path_44" data-name="Path 44" d="M107.01,64.46s-8.73.75-9.37,16.28" fill="none" stroke="#e30613"
          stroke-miterlimit="10" stroke-width="0.2" />
      </g>
      <path id="Path_45" data-name="Path 45" d="M95.58,80.05l2.17,3.89,2.28-3.82Z" fill="#e30613" />
      <g id="Group_27" data-name="Group 27" clip-path="url(#clip-path)">
        <path id="Path_46" data-name="Path 46" d="M188.35,75.63c-7.86,20.84-50.44-7.21-68.1-11.08" fill="none"
          stroke="#e30613" stroke-miterlimit="10" stroke-width="0.2" />
      </g>
      <path id="Path_47" data-name="Path 47" d="M121.24,62.61l-4.14,1.64,3.49,2.77Z" fill="#e30613" />
      <g id="Group_28" data-name="Group 28" clip-path="url(#clip-path)">
        <path id="Path_48" data-name="Path 48" d="M30.01,25.14s32.88-18.4,63-6.33" fill="none" stroke="#e30613"
          stroke-miterlimit="10" stroke-width="0.2" />
      </g>
      <path id="Path_49" data-name="Path 49" d="M91.5,20.67l4.42-.57-2.7-3.54Z" fill="#e30613" />
    </g>
  </svg>
    </a>
    <?php
        wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container_class' => 'header-menu-class'
        ));
    ?>
    <div>
      <label for="darkmode" class="darkmode" role="button" aria-label="darkmode button">
          <svg
          xmlns="http://www.w3.org/2000/svg"
          width="49"
          height="186.99"
          viewBox="0 0 49 186.99"
          id="lamp"
        >
          <g id="Group_6" data-name="Group 6" transform="translate(-1813 -0.01)">
            <g id="lamp-svgrepo-com" transform="translate(1813 120.915)">
              <g
                id="lamp-svgrepo-com-2"
                data-name="lamp-svgrepo-com"
                transform="translate(53.694 67.988) rotate(180)"
              >
                <circle
                  id="Ellipse_3"
                  data-name="Ellipse 3"
                  cx="24.5"
                  cy="24.5"
                  r="24.5"
                  transform="translate(4.694 1.903)"
                  fill="rgba(141,124,0,0.11)"
                />
                <path
                  id="Path_1"
                  data-name="Path 1"
                  d="M17.183,27.6V12.841A4.341,4.341,0,0,0,12.841,8.5h0A4.341,4.341,0,0,0,8.5,12.841h0a4.341,4.341,0,0,0,4.341,4.341H28.47a4.341,4.341,0,0,0,4.341-4.341h0A4.341,4.341,0,0,0,28.47,8.5h0a4.341,4.341,0,0,0-4.341,4.341V27.6"
                  transform="translate(8.656 16.075)"
                  fill="none"
                  stroke="#a07f26"
                  stroke-linecap="round"
                  stroke-width="1"
                />
                <path
                  id="Path_2"
                  data-name="Path 2"
                  d="M29.838,16.94a.535.535,0,0,0-.75-.483,24.235,24.235,0,0,1-9.669,2,24.233,24.233,0,0,1-9.669-2A.535.535,0,0,0,9,16.94v6.725a8.683,8.683,0,0,0,8.683,8.683h3.473a8.683,8.683,0,0,0,8.683-8.683Z"
                  transform="translate(9.892 35.64)"
                  fill-rule="evenodd"
                />
              </g>
            </g>
            <path
              id="Path_79"
              data-name="Path 79"
              d="M1837.5,120.915V.01"
              fill="none"
              stroke="#000"
              stroke-width="2"
            />
          </g></svg> 
          <input
          id="darkmode"
          type="checkbox"
          value="darkmode"
          name="darkmode"
          aria-label="darkmode button"
          aria-pressed="false"
        />
          </label>
    </div>
    <button class="hamburger" aria-label="Toggle menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </button>

    <?php
        wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container_class' => 'mobile-menu',
            'container_id' => 'mobileMenu'
        ));
        ?>
  
  </nav>
    </header>
<main>
