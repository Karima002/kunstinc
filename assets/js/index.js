// function toggleMenu() {
//   const menu = document.getElementById('mobileMenu');
//   const hamburger = document.querySelector('.hamburger');
//   menu.classList.toggle('show');
//   hamburger.classList.toggle('active');
// }
const sectiontoPin = document.getElementById("section_to-pin");
// gsap.registerPlugin(ScrollTrigger);
document.addEventListener("DOMContentLoaded", function () {
if (sectiontoPin) {
  function initializeGSAPScroll() {
    gsap.registerPlugin(ScrollTrigger);

      let gsapScrollInitialized = false;

      function checkScreenSize() {
        if (window.innerWidth >= 900 && !gsapScrollInitialized) {
          initialiseApp();
          gsapScrollInitialized = true;
        } else if (window.innerWidth < 900 && gsapScrollInitialized) {
          cleanupGSAP();
          gsapScrollInitialized = false;
        }
      }

      function initialiseApp() {
        initialiseGSAPScrollTriggerPinningHorizontal();
        initialiseLenisScroll();
      }

      function initialiseGSAPScrollTriggerPinningHorizontal() {
        let sectionPin = document.getElementById("section_pin");

        if (!sectionPin) {
          return;
        }

        const windowWidth = window.innerWidth; // Width of the window
        const fixedWidth = 1200; // Fixed width of the element
        const margin = calculateMargins(windowWidth, fixedWidth);

        // make a function that calcultates the fixed width of 1200px against the window of a screen
        function calculateMargins(windowWidth, fixedWidth) {
          // Calculate the remaining space
          const remainingSpace = windowWidth - fixedWidth;
          // Calculate the margin on each side
          const margin = remainingSpace / 2;
          // Return the margin
          return margin;
        }

        let containerAnimation = gsap.to(sectionPin, {
          scrollTrigger: {
            trigger: "#section_to-pin",
            start: "top top",
            end: () => "+=" + sectionPin.offsetWidth,
            pin: true,
            scrub: true,
            invalidateOnRefresh: true, // Recalculate on refresh
          },
          x: () =>
            -(
              sectionPin.scrollWidth -
              document.documentElement.clientWidth +
              margin
            ) + "px",
          ease: "none",
        });

        // Function to generate unique IDs
        function generateUniqueIDs(elements, prefix = "imageWrapper") {
          elements.forEach((element, index) => {
            element.id = `${prefix}-${index}`;
          });
        }

        // Select all .image_wrapper elements
        let imageWrappers = sectionPin.querySelectorAll(".image_wrapper");

        // Generate and assign unique IDs
        generateUniqueIDs(imageWrappers);

        // Set up GSAP ScrollTrigger animations
        imageWrappers.forEach((imageWrapper) => {
          let imageWrapperID = imageWrapper.id;
          gsap.to(imageWrapper, {
            scrollTrigger: {
              trigger: imageWrapper,
              start: "left center",
              end: "right center",
              containerAnimation: containerAnimation,
              toggleClass: {
                targets: "." + imageWrapperID,
                className: "active",
              },
              invalidateOnRefresh: true, // Recalculate on refresh
            },
          });
        });

        // Ensure ScrollTrigger recalculates on resize
        window.addEventListener("resize", () => {
          ScrollTrigger.refresh();
        });
      }

      function initialiseLenisScroll() {
        const lenis = new Lenis({
          smoothWheel: true,
          duration: 0.8,
        });

        lenis.on("scroll", ScrollTrigger.update);

        gsap.ticker.add((time) => {
          lenis.raf(time * 1000);
        });

        gsap.ticker.lagSmoothing(0);
      }

      function cleanupGSAP() {
        ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
        gsap.killTweensOf("*");
      }

      // Initial call
      checkScreenSize();

      // Call on resize
      window.addEventListener("resize", function () {
        checkScreenSize();
        ScrollTrigger.refresh();
      });
  }

  // Call the function on the necessary pages
  initializeGSAPScroll();
}

});

// document.addEventListener("DOMContentLoaded", function () {
//   var filterButton = document.getElementById("filter-button");
//   var dropdownContent = document.getElementById("myDropdown");

//   filterButton.addEventListener("click", function () {
//     dropdownContent.classList.toggle("show");
//   });

//   // Close the dropdown if the user clicks outside of it
//   window.addEventListener("click", function (event) {
//     if (!event.target.matches('#filter-button')) {
//       var dropdowns = document.getElementsByClassName("dropdown-content");
//       for (var i = 0; i < dropdowns.length; i++) {
//         var openDropdown = dropdowns[i];
//         if (openDropdown.classList.contains('show')) {
//           openDropdown.classList.remove('show');
//         }
//       }
//     }
//   });
// });

const containerGallery = document.querySelector(".gallery");

if (containerGallery) {
  function pageheaderImageCount() {
    const images = containerGallery.querySelectorAll("img");
    const imageCount = images.length;

    if (imageCount === 1) {
      containerGallery.classList.add("one-image");
    } else if (imageCount === 2) {
      containerGallery.classList.add("two-images");
    } else if (imageCount === 3) {
      containerGallery.classList.add("three-images");
    }
  }

  pageheaderImageCount();
}
