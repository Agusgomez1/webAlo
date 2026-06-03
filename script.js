const aloGalleryImages = [
  { category: "eventos", src: "./src/img/Vicky_1292.JPG", alt: "Evento social de Aló" },
  { category: "eventos", src: "./src/img/Vicky_1504.JPG", alt: "Ambientación de evento social" },
  { category: "eventos", src: "./src/img/Vicky_542.JPG", alt: "Celebración social" },
  { category: "eventos", src: "./src/img/fotografialo/eventos_sociales/Vicky_230.JPG", alt: "Detalle de evento social" },
  { category: "congresos", src: "./src/img/2013-08-21_17.42.04.jpg", alt: "Congreso organizado por Aló" },
  { category: "workshops", src: "./src/img/PHOTO-2024-05-11-17-25-16_1.jpg", alt: "Workshop de Aló" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/DSC_0262.JPG", alt: "Workshop en acción" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/DSC_0283.JPG", alt: "Participantes en workshop" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/DSC_0404.JPG", alt: "Detalle de workshop" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-09 at 22.17.03 (1).jpeg", alt: "Capacitación de eventos" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-09 at 22.17.03.jpeg", alt: "Workshop presencial" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-15 at 20.08.49_f1f03dd2.jpg", alt: "Encuentro de capacitación" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-15 at 20.09.41_fb4b729b.jpg", alt: "Material de workshop" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-15 at 20.10.09_9b6113c7.jpg", alt: "Clase de capacitación" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-15 at 20.11.54_ffed8e5d.jpg", alt: "Workshop para organizadores" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-15 at 20.11.55_51c3507c.jpg", alt: "Experiencia de workshop" },
  { category: "workshops", src: "./src/img/fotografialo/workshops/WhatsApp Image 2024-09-15 at 20.15.11_33fb65a0.jpg", alt: "Cierre de workshop" },
];

const aloWorkshops = [
  {
    id: "coaching",
    title: "Coaching",
    tag: "Herramientas profesionales",
    cover: "./src/img/capacitalo/coaching.JPG",
    text: "Nuevas herramientas para empoderarte como organizador de eventos y liderar con más claridad.",
    images: [
      "./src/img/capacitalo/workshop 1/IMG-20240909-WA0018.jpg",
      "./src/img/capacitalo/workshop 1/IMG-20240909-WA0019.jpg",
      "./src/img/capacitalo/workshop 1/IMG-20240909-WA0020.jpg",
      "./src/img/capacitalo/workshop 1/IMG-20240909-WA0022.jpg",
    ],
  },
  {
    id: "cuentas",
    title: "Cómo manejar las cuentas de tu negocio",
    tag: "Gestión rentable",
    cover: "./src/img/capacitalo/Como_manejar_las_cuentas_de_tu_negocio.jpg",
    text: "Técnicas para ordenar ingresos, mejorar decisiones y hacer más rentable tu emprendimiento.",
    images: [
      "./src/img/capacitalo/workshop 2/IMG-20240511-WA0040.jpg",
      "./src/img/capacitalo/workshop 2/IMG-20240909-WA0021.jpg",
      "./src/img/capacitalo/workshop 2/WhatsApp Image 2024-09-09 at 22.45.38_dba48c4d.jpg",
    ],
  },
  {
    id: "imagen",
    title: "Gestión de la imagen",
    tag: "Marca personal",
    cover: "./src/img/capacitalo/gestion_de_la_imagen.jpg",
    text: "Construí una imagen sólida, auténtica y coherente con los valores que querés transmitir.",
    images: [
      "./src/img/capacitalo/workshop 3/IMG-20240909-WA0024.jpg",
      "./src/img/capacitalo/workshop 3/IMG-20240909-WA0025.jpg",
      "./src/img/capacitalo/workshop 3/IMG-20240909-WA0026.jpg",
      "./src/img/capacitalo/workshop 3/WhatsApp Image 2024-09-09 at 22.45.38_50440354.jpg",
    ],
  },
  {
    id: "ceremonial",
    title: "Taller ceremonial social",
    tag: "Buenas maneras",
    cover: "./src/img/capacitalo/taller_ceremonial_social.jpeg",
    text: "Las reglas de oro para diferenciarte y convertirte en un mejor anfitrión.",
    images: ["./src/img/capacitalo/taller_ceremonial_social.jpeg"],
  },
  {
    id: "gastronomia",
    title: "Experiencias gastronómicas de alto impacto",
    tag: "Tendencias",
    cover: "./src/img/capacitalo/experiencias_gastronomicas_de_alto_impacto.jpeg",
    text: "Tendencias y herramientas para potenciar tu servicio y dejar huella en cada evento.",
    images: [
      "./src/img/capacitalo/workshop 5/IMG-20240909-WA0028.jpg",
      "./src/img/capacitalo/workshop 5/IMG-20240909-WA0029.jpg",
      "./src/img/capacitalo/workshop 5/WhatsApp Image 2024-09-09 at 22.45.38_15645e94.jpg",
    ],
  },
  {
    id: "propio-evento",
    title: "Organizá tu propio evento",
    tag: "Primeros pasos",
    cover: "./src/img/capacitalo/Organiza_tu_Propio_Evento.jpg",
    text: "Diez puntos clave para empezar a organizar tu evento con método, timing y criterio.",
    images: ["./src/img/capacitalo/Organiza_tu_Propio_Evento.jpg"],
  },
  {
    id: "congresos",
    title: "Workshop de Congre - S.O.S.",
    tag: "Eventos científicos",
    cover: "./src/img/capacitalo/workshop 7/CONGRESOS MARIANA.jpeg",
    text: "Claves para dominar eventos científicos, ordenar equipos y evitar estrés en producción.",
    images: ["./src/img/capacitalo/workshop 7/CONGRESOS MARIANA.jpeg"],
  },
];

document.addEventListener("DOMContentLoaded", function () {
  initLoader();
  initNavbar();
  initReveal();
  initVideoModals();
  initGallery();
  initWorkshops();
  initFormSecurityFields();
  initContactStatus();
});

function initLoader() {
  const loader = document.getElementById("loader");
  const content = document.getElementById("content");
  let loaderHidden = false;

  function hideLoader() {
    if (loaderHidden) return;
    loaderHidden = true;

    if (loader) {
      loader.classList.add("loader-container--hidden");
      window.setTimeout(function () {
        loader.style.display = "none";
      }, 320);
    }

    if (content) {
      content.style.display = "block";
    }
  }

  window.requestAnimationFrame(function () {
    window.setTimeout(hideLoader, 450);
  });
  window.addEventListener("load", hideLoader, { once: true });
  window.setTimeout(hideLoader, 2500);
}

function initNavbar() {
  const navbarToggler = document.querySelector(".navbar-toggler");
  const navbarCollapse = document.querySelector(".navbar-collapse");
  const navLinks = document.querySelectorAll(".nav-link");

  if (!navbarToggler || !navbarCollapse) return;

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

  navbarToggler.addEventListener("click", function (event) {
    event.stopPropagation();
    navbarCollapse.classList.contains("show") ? closeMenu() : openMenu();
  });

  navLinks.forEach(function (link) {
    link.addEventListener("click", function () {
      if (navbarCollapse.classList.contains("show")) closeMenu();
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

function initReveal() {
  const revealItems = document.querySelectorAll(".reveal, .service-card, .testimonial-card, .workshop-card, .gallery-item, .contact-card");

  if (!("IntersectionObserver" in window) || revealItems.length === 0) {
    revealItems.forEach(function (item) {
      item.classList.add("is-visible");
    });
    return;
  }

  const observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12 }
  );

  revealItems.forEach(function (item) {
    observer.observe(item);
  });
}

function initVideoModals() {
  const modals = [
    { modalId: "testimonioModal1", videoId: "video1" },
    { modalId: "testimonioModal2", videoId: "video2" },
    { modalId: "testimonioModal3", videoId: "video3" },
  ];

  modals.forEach(function (item) {
    const modal = document.getElementById(item.modalId);
    const video = document.getElementById(item.videoId);

    if (modal && video) {
      modal.addEventListener("hidden.bs.modal", function () {
        video.pause();
        video.currentTime = 0;
      });
    }
  });
}

function initGallery() {
  const galleryGrid = document.querySelector("[data-gallery-grid]");
  const filterButtons = document.querySelectorAll("[data-filter]");

  if (!galleryGrid) return;

  function renderGallery(filter) {
    const selected = filter || "all";
    const images = selected === "all" ? aloGalleryImages : aloGalleryImages.filter(function (image) {
      return image.category === selected;
    });

    galleryGrid.innerHTML = images
      .map(function (image, index) {
        return `
          <button class="gallery-item reveal" type="button" data-lightbox-src="${image.src}" data-lightbox-alt="${image.alt}" style="transition-delay:${Math.min(index * 35, 280)}ms">
            <img src="${image.src}" alt="${image.alt}" loading="lazy" decoding="async" />
            <span>${getCategoryLabel(image.category)}</span>
          </button>
        `;
      })
      .join("");

    initReveal();
    initLightboxTriggers();
  }

  filterButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      filterButtons.forEach(function (item) {
        item.classList.remove("active");
      });
      button.classList.add("active");
      renderGallery(button.dataset.filter);
    });
  });

  renderGallery("all");
}

function initLightboxTriggers() {
  document.querySelectorAll("[data-lightbox-src]").forEach(function (trigger) {
    trigger.addEventListener("click", function () {
      openLightbox(trigger.dataset.lightboxSrc, trigger.dataset.lightboxAlt);
    });
  });
}

function openLightbox(src, alt) {
  let lightbox = document.querySelector(".alo-lightbox");

  if (!lightbox) {
    lightbox = document.createElement("div");
    lightbox.className = "alo-lightbox";
    lightbox.innerHTML = `
      <button class="alo-lightbox__close" type="button" aria-label="Cerrar imagen">&times;</button>
      <img src="" alt="" />
      <p></p>
    `;
    document.body.appendChild(lightbox);

    lightbox.addEventListener("click", function (event) {
      if (event.target === lightbox || event.target.classList.contains("alo-lightbox__close")) {
        closeLightbox();
      }
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") closeLightbox();
    });
  }

  lightbox.querySelector("img").src = src;
  lightbox.querySelector("img").alt = alt;
  lightbox.querySelector("p").textContent = alt;
  lightbox.classList.add("is-open");
  document.body.classList.add("no-scroll");
}

function closeLightbox() {
  const lightbox = document.querySelector(".alo-lightbox");
  if (lightbox) lightbox.classList.remove("is-open");
  document.body.classList.remove("no-scroll");
}

function initWorkshops() {
  const workshopGrid = document.querySelector("[data-workshop-grid]");
  const modalContainer = document.querySelector("[data-workshop-modals]");

  if (!workshopGrid || !modalContainer) return;

  workshopGrid.innerHTML = aloWorkshops
    .map(function (workshop, index) {
      return `
        <article class="workshop-card reveal" style="transition-delay:${Math.min(index * 45, 320)}ms">
          <button type="button" data-bs-toggle="modal" data-bs-target="#workshop-${workshop.id}">
            <img src="${workshop.cover}" alt="${workshop.title}" loading="lazy" decoding="async" />
            <span class="workshop-card__tag">${workshop.tag}</span>
            <div>
              <h3>${workshop.title}</h3>
              <p>${workshop.text}</p>
            </div>
          </button>
        </article>
      `;
    })
    .join("");

  modalContainer.innerHTML = aloWorkshops.map(renderWorkshopModal).join("");
  initReveal();
}

function renderWorkshopModal(workshop) {
  return `
    <div class="modal fade alo-modal workshop-modal" id="workshop-${workshop.id}" tabindex="-1" aria-labelledby="workshop-${workshop.id}-label" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <button type="button" class="btn-close modal-close-floating" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          <div class="workshop-modal__grid">
            <div class="workshop-modal__media">
              <div id="carousel-${workshop.id}" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">
                  ${workshop.images
                    .map(function (image, index) {
                      return `
                        <div class="carousel-item ${index === 0 ? "active" : ""}">
                          <img src="${image}" class="d-block w-100" alt="${workshop.title} ${index + 1}" loading="lazy" decoding="async" />
                        </div>
                      `;
                    })
                    .join("")}
                </div>
                ${workshop.images.length > 1 ? `
                  <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${workshop.id}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carousel-${workshop.id}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                  </button>
                ` : ""}
              </div>
            </div>
            <div class="workshop-modal__copy">
              <span class="eyebrow">${workshop.tag}</span>
              <h2 id="workshop-${workshop.id}-label">${workshop.title}</h2>
              <p>${workshop.text}</p>
              <a class="btn btn-alo-primary" href="./contactanos.html">Consultar disponibilidad</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;
}

function initContactStatus() {
  const params = new URLSearchParams(window.location.search);
  const status = params.get("status");

  if (status === "success") {
    showToast("Tu consulta se envió correctamente. Te vamos a responder pronto.", "success");
    removeStatusParam();
  } else if (status === "error") {
    showToast("No pudimos enviar la consulta. Probá nuevamente en unos minutos.", "error");
    removeStatusParam();
  }
}

function initFormSecurityFields() {
  document.querySelectorAll("[data-form-loaded-at]").forEach(function (field) {
    field.value = Math.floor(Date.now() / 1000).toString();
  });
}

function showToast(message, type) {
  let toast = document.querySelector(".alo-toast");

  if (!toast) {
    toast = document.createElement("div");
    toast.className = "alo-toast";
    document.body.appendChild(toast);
  }

  toast.textContent = message;
  toast.className = `alo-toast alo-toast--${type} is-visible`;

  window.setTimeout(function () {
    toast.classList.remove("is-visible");
  }, 4200);
}

function removeStatusParam() {
  window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
}

function getCategoryLabel(category) {
  const labels = {
    eventos: "Sociales",
    eventos_sociales: "Sociales",
    workshops: "Workshops",
    congresos: "Congresos",
  };

  return labels[category] || category;
}
