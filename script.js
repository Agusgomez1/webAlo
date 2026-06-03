document.addEventListener("DOMContentLoaded", function () {
  const loader = document.getElementById("loader");
  const navbarToggler = document.querySelector(".navbar-toggler");
  const navbarCollapse = document.querySelector(".navbar-collapse");
  const navLinks = document.querySelectorAll(".nav-link");
  const galleryGrid = document.querySelector(".gallery-grid");

  window.addEventListener("load", function () {
    if (loader) {
      loader.style.display = "none";
    }
  });

  if (navbarToggler && navbarCollapse) {
    function openMenu() {
      navbarCollapse.classList.add("show");
      navbarCollapse.style.maxHeight = navbarCollapse.scrollHeight + "px";
      navbarToggler.classList.add("active");
      navbarToggler.setAttribute("aria-expanded", "true");
    }

    function closeMenu() {
      navbarCollapse.style.maxHeight = navbarCollapse.scrollHeight + "px";
      window.setTimeout(function () {
        navbarCollapse.style.maxHeight = "0";
      }, 10);
      window.setTimeout(function () {
        navbarCollapse.classList.remove("show");
        navbarToggler.classList.remove("active");
        navbarToggler.setAttribute("aria-expanded", "false");
      }, 280);
    }

    function toggleMenu() {
      if (navbarCollapse.classList.contains("show")) {
        closeMenu();
      } else {
        openMenu();
      }
    }

    navbarToggler.addEventListener("click", function (event) {
      event.stopPropagation();
      toggleMenu();
    });

    navLinks.forEach(function (link) {
      link.addEventListener("click", function () {
        if (navbarCollapse.classList.contains("show")) {
          closeMenu();
        }
      });
    });

    document.addEventListener("click", function (event) {
      if (
        navbarCollapse.classList.contains("show") &&
        !navbarToggler.contains(event.target) &&
        !navbarCollapse.contains(event.target)
      ) {
        closeMenu();
      }
    });
  }

  if (galleryGrid) {
    fetch("src/getImages.php")
      .then(function (response) {
        return response.json();
      })
      .then(function (images) {
        galleryGrid.innerHTML = "";

        images.forEach(function (image) {
          const divElement = document.createElement("div");
          divElement.classList.add("gallery-item", image.category);

          const imgElement = document.createElement("img");
          imgElement.src = image.src;
          imgElement.alt = image.alt;

          divElement.appendChild(imgElement);
          galleryGrid.appendChild(divElement);
        });
      })
      .catch(function (error) {
        console.error("Error al cargar las imágenes:", error);
      });
  }

  [
    { modalId: "testimonioModal1", videoId: "video1" },
    { modalId: "testimonioModal2", videoId: "video2" },
    { modalId: "testimonioModal3", videoId: "video3" },
  ].forEach(function (item) {
    const modal = document.getElementById(item.modalId);
    const video = document.getElementById(item.videoId);

    if (modal && video) {
      modal.addEventListener("hidden.bs.modal", function () {
        video.pause();
        video.currentTime = 0;
      });
    }
  });
});
