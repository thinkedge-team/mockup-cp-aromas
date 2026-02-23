/* ========================================
    AROMAS - PREMIUM PALM OIL & COOKING OIL
    Custom JavaScript - FINAL FIX
    ======================================== */

// ========== BRANCHES DATA ==========
const branches = [
    {
        id: 1,
        nama_cabang: "Cabang Jakarta Pusat",
        kategori: "Outlet Premium",
        alamat: "Jl. Industri Raya No. 123, Jakarta 12345",
        latitude: -6.2088,
        longitude: 106.8456,
        foto_url:
            "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=300&h=300&fit=crop",
        rating: 5,
        name: "Cabang Jakarta",
        address: "Jl. Industri Raya No. 123, Kawasan Industri, Jakarta 12345",
        phone: "(021) 1234-5678",
        whatsapp: "6281234567890",
        image: "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=250&fit=crop",
        lat: -6.2088,
        lng: 106.8456,
        mapLink: "https://maps.google.com/?q=Jl.+Industri+Raya+No.+123+Jakarta",
        city: "Jakarta",
        operatingHours: {
            open: "08:00",
            close: "17:00",
            days: "Senin - Jumat",
        },
        isOpen: true,
    },
    {
        id: 2,
        nama_cabang: "Cabang Surabaya Timur",
        kategori: "Outlet Standar",
        alamat: "Jl. Raya Surabaya No. 45, Jawa Timur 60111",
        latitude: -7.2575,
        longitude: 112.7521,
        foto_url:
            "https://images.unsplash.com/photo-1497366216548-37526070297c?w=300&h=300&fit=crop",
        rating: 4,
        name: "Cabang Surabaya",
        address: "Jl. Raya Surabaya No. 45, Jawa Timur 60111",
        phone: "(031) 9876-5432",
        whatsapp: "6281345678901",
        image: "https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&h=250&fit=crop",
        lat: -7.2575,
        lng: 112.7521,
        mapLink: "https://maps.google.com/?q=Jl.+Raya+Surabaya+No.+45",
        city: "Surabaya",
        operatingHours: {
            open: "08:00",
            close: "17:00",
            days: "Senin - Jumat",
        },
        isOpen: true,
    },
    {
        id: 3,
        nama_cabang: "Cabang Bandung Utara",
        kategori: "Outlet Premium",
        alamat: "Jl. Braga No. 67, Bandung 40111, Jawa Barat",
        latitude: -6.9175,
        longitude: 107.6191,
        foto_url:
            "https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=300&h=300&fit=crop",
        rating: 5,
        name: "Cabang Bandung",
        address: "Jl. Braga No. 67, Bandung 40111, Jawa Barat",
        phone: "(022) 2345-6789",
        whatsapp: "6281456789012",
        image: "https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=400&h=250&fit=crop",
        lat: -6.9175,
        lng: 107.6191,
        mapLink: "https://maps.google.com/?q=Jl.+Braga+No.+67+Bandung",
        city: "Bandung",
        operatingHours: {
            open: "08:00",
            close: "17:00",
            days: "Senin - Jumat",
        },
        isOpen: true,
    },
];

// ========== GLOBAL VARIABLES FOR INTERACTIVE MAP ==========
let markers = {};
let radiusCircles = {};
let map;

// Flag to prevent scroll listener from triggering during programmatic scroll
let isProgrammaticScroll = false;

// ========== HELPER FUNCTIONS ==========
function checkBranchStatus(branch) {
    const now = new Date();
    const currentTime = now.getHours() * 60 + now.getMinutes();
    const dayOfWeek = now.getDay();

    const isWeekday = dayOfWeek >= 1 && dayOfWeek <= 5;
    const isOpenToday = branch.operatingHours.days
        .toLowerCase()
        .includes("senin - jumat")
        ? isWeekday
        : true;

    if (!isOpenToday) return false;

    const openTime = parseTime(branch.operatingHours.open);
    const closeTime = parseTime(branch.operatingHours.close);

    return currentTime >= openTime && currentTime <= closeTime;
}

function parseTime(timeStr) {
    const [hours, minutes] = timeStr.split(":").map(Number);
    return hours * 60 + minutes;
}

function formatPhoneNumber(phone) {
    return phone.replace(/[^0-9]/g, "");
}

// Update branches with live status
branches.forEach((branch) => {
    branch.isOpen = checkBranchStatus(branch);
});

// ========== INTERACTIVE MAP FUNCTIONS ==========

// Create Active Marker - Large Product Bottle with Glow
function createActiveMarker() {
    return L.divIcon({
        className: "custom-marker-active",
        html: `
            <div class="product-marker-wrapper active">
                <div class="marker-glow-ring"></div>
                <div class="marker-product-container">
                    <img src="assets/images/aromas-hero.png" alt="AROMAS" class="marker-product-img">
                </div>
                <div class="marker-pulse"></div>
            </div>
        `,
        iconSize: [60, 80],
        iconAnchor: [30, 80],
        popupAnchor: [0, -85],
    });
}

// Create Inactive Marker - Small Product Bottle
function createInactiveMarker() {
    return L.divIcon({
        className: "custom-marker-inactive",
        html: `
            <div class="product-marker-wrapper inactive">
                <div class="marker-product-container small">
                    <img src="assets/images/aromas-hero.png" alt="AROMAS" class="marker-product-img">
                </div>
            </div>
        `,
        iconSize: [40, 53],
        iconAnchor: [20, 53],
        popupAnchor: [0, -58],
    });
}

// Create Eye-Catching Popup Content
function createPopupContent(branch) {
    const isOpen = checkBranchStatus(branch);
    const statusClass = isOpen ? "open" : "closed";
    const statusText = isOpen ? "Buka" : "Tutup";
    return `
        <div class="aromas-popup">
            <div class="popup-accent-bar"></div>
            <div class="popup-main-row">
                <div class="popup-dot-icon">
                    <img src="assets/images/aromas-hero.png" alt="AROMAS">
                </div>
                <div class="popup-main-info">
                    <p class="popup-branch-name">${branch.nama_cabang}</p>
                    <div class="popup-meta-row">
                        <span class="popup-status-dot ${statusClass}"></span>
                        <span class="popup-status-text ${statusClass}">${statusText}</span>
                        <span class="popup-meta-sep">·</span>
                        <span>${branch.operatingHours.open}–${branch.operatingHours.close}</span>
                    </div>
                </div>
            </div>
            <div class="popup-thin-divider"></div>
            <div class="popup-address-row">
                <i class="bi bi-geo-alt-fill"></i>
                <span>${branch.alamat}</span>
            </div>
            <div class="popup-actions-section">
                <a href="https://wa.me/${branch.whatsapp}" target="_blank" class="popup-btn popup-btn-whatsapp">
                    <i class="bi bi-whatsapp"></i><span>WhatsApp</span>
                </a>
                <a href="${branch.mapLink}" target="_blank" class="popup-btn popup-btn-directions">
                    <i class="bi bi-map-fill"></i><span>Arah</span>
                </a>
            </div>
        </div>`;
}

// Create Radius Circle - Pink/Red Semi-Transparent
function createRadiusCircle(lat, lng) {
    return L.circle([lat, lng], {
        radius: 500,
        color: "rgba(212, 160, 23, 0.55)",
        fillColor: "rgba(212, 160, 23, 0.1)",
        fillOpacity: 0.1,
        weight: 1.5,
        dashArray: "6 4",
        className: "leaflet-interactive-circle",
    });
}

// Render Info Cards
function renderInfoCards() {
    const container = document.getElementById("infoCards");
    if (!container) return;

    container.innerHTML = branches
        .map((branch) => {
            const isOpen = checkBranchStatus(branch);
            const statusClass = isOpen ? "open" : "closed";
            const statusText = isOpen ? "Buka" : "Tutup";
            return `
        <div class="info-card" data-id="${branch.id}">
            <div class="card-image">
                <img src="${branch.foto_url}" alt="${branch.nama_cabang}" class="card-photo" loading="lazy">
            </div>
            <div class="card-info">
                <span class="card-status-badge ${statusClass}">
                    <span class="card-status-dot"></span>
                    ${statusText} · ${branch.operatingHours.open}–${branch.operatingHours.close}
                </span>
                <h3 class="card-name">${branch.nama_cabang}</h3>
                <span class="card-category">${branch.kategori}</span>
                <p class="card-address">
                    <i class="bi bi-geo-alt-fill"></i>${branch.alamat}
                </p>
                <div class="card-actions">
                    <a href="https://wa.me/${branch.whatsapp}" target="_blank" class="card-btn card-btn-wa">
                        <i class="bi bi-whatsapp"></i><span>WA</span>
                    </a>
                    <a href="${branch.mapLink}" target="_blank" class="card-btn card-btn-maps">
                        <i class="bi bi-map-fill"></i><span>Arah</span>
                    </a>
                </div>
            </div>
        </div>`;
        })
        .join("");

    // Click to activate card
    container.querySelectorAll(".info-card").forEach((card) => {
        card.addEventListener("click", function (e) {
            if (e.target.closest(".card-btn")) return;
            setActiveBranch(parseInt(this.dataset.id), true);
        });
    });

    // Init dots after cards are rendered
    renderCardDots();
}

// Render pagination dots into #cardsDots (in HTML)
function renderCardDots() {
    const dotsEl = document.getElementById("cardsDots");
    if (!dotsEl) return;
    dotsEl.innerHTML = branches
        .map(
            (_, i) =>
                `<span class="cards-dot${i === 0 ? " active" : ""}" data-index="${i}"></span>`,
        )
        .join("");
    dotsEl.querySelectorAll(".cards-dot").forEach((dot) => {
        dot.addEventListener("click", () => {
            const idx = parseInt(dot.dataset.index);
            window.currentBranchIndex = idx;
            setActiveBranch(branches[idx].id, true);
        });
    });
}

// Sync active dot with current branch
function updateCardDots(index) {
    document.querySelectorAll(".cards-dot").forEach((d, i) => {
        d.classList.toggle("active", i === index);
    });
}

// Set Active Branch - Update marker and card states
// scrollIntoView parameter: true = programmatic (dari code), false = manual user scroll
function setActiveBranch(branchId, scrollIntoView = false) {
    console.log(
        "setActiveBranch called with:",
        branchId,
        "scrollIntoView:",
        scrollIntoView,
    );

    // Update current branch index globally
    window.currentBranchIndex = branches.findIndex((b) => b.id === branchId);

    // Sync dots
    if (typeof updateCardDots === "function")
        updateCardDots(window.currentBranchIndex);

    // Reset all cards
    document.querySelectorAll(".info-card").forEach((card) => {
        card.classList.remove("active");
    });

    // Set active card
    const activeCard = document.querySelector(
        `.info-card[data-id="${branchId}"]`,
    );
    if (activeCard) {
        activeCard.classList.add("active");

        // Only scroll if requested (from click/arrow, NOT from scroll listener)
        if (scrollIntoView) {
            // Set flag to prevent scroll listener from triggering
            isProgrammaticScroll = true;

            activeCard.scrollIntoView({
                behavior: "smooth",
                inline: "center",
                block: "nearest",
            });

            // Reset flag after scroll animation completes
            setTimeout(() => {
                isProgrammaticScroll = false;
            }, 500);
        }
    }

    // Reset all markers to inactive
    if (markers && Object.keys(markers).length > 0) {
        Object.keys(markers).forEach((id) => {
            if (markers[id]) {
                markers[id].setIcon(createInactiveMarker());
            }
            if (radiusCircles && radiusCircles[id]) {
                radiusCircles[id].setStyle({ opacity: 0 }).remove();
            }
        });

        // Set active marker
        if (markers[branchId]) {
            markers[branchId].setIcon(createActiveMarker());

            // Show radius circle
            if (radiusCircles && radiusCircles[branchId]) {
                const circle = radiusCircles[branchId];
                circle.setStyle({ opacity: 0.6 });
                circle.addTo(map);
            }

            // Fly to active marker
            const branch = branches.find((b) => b.id === branchId);
            if (branch) {
                map.flyTo([branch.latitude, branch.longitude], 14, {
                    animate: true,
                    duration: 1,
                });
            }
        }
    }

    // Update arrow states
    if (window.updateArrowStates) {
        window.updateArrowStates();
    }
}

// Handle Card Scroll - Sync with markers (ONLY for manual user scroll/swipe)
function handleCardScroll(container) {
    let scrollTimeout;

    // Scroll sync with markers - detect visible card
    container.addEventListener("scroll", () => {
        // CRITICAL: Ignore if this is a programmatic scroll
        if (isProgrammaticScroll) {
            console.log("Scroll ignored - programmatic");
            return;
        }

        console.log("Scroll detected - user initiated");

        // Clear previous timeout
        clearTimeout(scrollTimeout);

        // Set new timeout to detect when scrolling stops
        scrollTimeout = setTimeout(() => {
            const cards = container.querySelectorAll(".info-card");
            let closestCard = null;
            let closestDistance = Infinity;

            const containerRect = container.getBoundingClientRect();
            const containerCenter =
                containerRect.left + containerRect.width / 2;

            cards.forEach((card) => {
                const rect = card.getBoundingClientRect();
                const cardCenter = rect.left + rect.width / 2;
                const distance = Math.abs(cardCenter - containerCenter);

                if (distance < closestDistance) {
                    closestDistance = distance;
                    closestCard = card;
                }
            });

            if (closestCard) {
                const branchId = parseInt(closestCard.dataset.id);
                const currentActiveCard =
                    container.querySelector(".info-card.active");

                // Only update if different from current
                if (
                    !currentActiveCard ||
                    parseInt(currentActiveCard.dataset.id) !== branchId
                ) {
                    console.log("User scrolled to branch:", branchId);
                    setActiveBranch(branchId, false); // false = no scroll (already scrolled by user)
                }
            }
        }, 150); // Wait 150ms after scroll stops
    });

    // Touch swipe support for mobile
    let touchStartX = 0;
    let touchScrollLeft = 0;

    container.addEventListener(
        "touchstart",
        (e) => {
            touchStartX = e.touches[0].pageX - container.offsetLeft;
            touchScrollLeft = container.scrollLeft;
        },
        { passive: true },
    );

    container.addEventListener(
        "touchmove",
        (e) => {
            const x = e.touches[0].pageX - container.offsetLeft;
            const walk = (x - touchStartX) * 1.5;
            container.scrollLeft = touchScrollLeft - walk;
        },
        { passive: true },
    );
}

// Initialize Interactive Map
function initInteractiveMap() {
    const mapContainer = document.getElementById("interactiveMap");
    const cardsContainer = document.getElementById("infoCards");

    if (!mapContainer || !cardsContainer) return;

    // Initialize Leaflet Map
    map = L.map("interactiveMap", {
        center: [-6.2088, 106.8456],
        zoom: 12,
        scrollWheelZoom: true,
    });

    // CartoDB Positron — clean minimal look
    L.tileLayer(
        "https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png",
        {
            attribution: '&copy; <a href="https://carto.com/">CARTO</a>',
            subdomains: "abcd",
            maxZoom: 19,
        },
    ).addTo(map);

    // Reset markers and circles
    markers = {};
    radiusCircles = {};

    // Render markers and radius circles
    branches.forEach((branch) => {
        const marker = L.marker([branch.latitude, branch.longitude], {
            icon: createInactiveMarker(),
        }).addTo(map);

        // Bind eye-catching popup to marker
        marker.bindPopup(createPopupContent(branch), {
            maxWidth: 240,
            minWidth: 230,
            className: "custom-leaflet-popup",
            closeButton: true,
            autoClose: false,
            closeOnClick: false,
        });

        const radiusCircle = createRadiusCircle(
            branch.latitude,
            branch.longitude,
        );
        radiusCircle.setStyle({ opacity: 0 }); // Hidden initially

        markers[branch.id] = marker;
        radiusCircles[branch.id] = radiusCircle;

        // Handle marker click - show popup and set active
        marker.on("click", () => {
            setActiveBranch(branch.id, true); // true = scroll to card
            marker.openPopup(); // Open the popup
        });
    });

    // Render info cards
    renderInfoCards();

    // Initialize currentBranchIndex globally
    window.currentBranchIndex = 0;

    // Arrow button navigation with card activation
    const arrowLeft = document.getElementById("cardArrowLeft");
    const arrowRight = document.getElementById("cardArrowRight");

    // Function to update arrow states (now global)
    window.updateArrowStates = function () {
        if (arrowLeft) {
            arrowLeft.disabled = window.currentBranchIndex === 0;
            arrowLeft.style.opacity =
                window.currentBranchIndex === 0 ? "0.3" : "1";
            arrowLeft.style.cursor =
                window.currentBranchIndex === 0 ? "not-allowed" : "pointer";
        }
        if (arrowRight) {
            arrowRight.disabled =
                window.currentBranchIndex === branches.length - 1;
            arrowRight.style.opacity =
                window.currentBranchIndex === branches.length - 1 ? "0.3" : "1";
            arrowRight.style.cursor =
                window.currentBranchIndex === branches.length - 1
                    ? "not-allowed"
                    : "pointer";
        }
    };

    if (arrowLeft) {
        arrowLeft.addEventListener("click", (e) => {
            e.stopPropagation();
            if (window.currentBranchIndex > 0) {
                window.currentBranchIndex--;
                setActiveBranch(branches[window.currentBranchIndex].id, true); // true = scroll to card
            }
        });
    }

    if (arrowRight) {
        arrowRight.addEventListener("click", (e) => {
            e.stopPropagation();
            if (window.currentBranchIndex < branches.length - 1) {
                window.currentBranchIndex++;
                setActiveBranch(branches[window.currentBranchIndex].id, true); // true = scroll to card
            }
        });
    }

    // Set initial active branch (first branch)
    if (branches.length > 0) {
        setActiveBranch(branches[0].id, false); // false = no scroll needed (already at start)
    }

    // Handle card scroll (ONLY for manual user scroll)
    handleCardScroll(cardsContainer);

    // Make map global for setActiveBranch access
    window.interactiveMap = map;

    // Adjust map after rendering
    setTimeout(() => {
        map.invalidateSize();
    }, 100);
}

// ========== PRELOADER ==========
window.addEventListener("load", function () {
    const preloader = document.getElementById("preloader");
    if (preloader) {
        // Add a small delay for smooth transition
        setTimeout(function () {
            preloader.classList.add("hidden");
            // Remove from DOM after animation completes
            setTimeout(function () {
                preloader.style.display = "none";
            }, 600);
        }, 800);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // ========== INITIALIZATION ==========
    initNavbarScroll();
    initSmoothScroll();
    initAccordion();
    initFaqAccordion(); // FAQ accordion
    initCounterAnimation();
    initScrollAnimations();
    initBackToTop();
    initVideoModal();
    initMobileMenu();
    initInteractiveMap();
    initHeroSlider();

    console.log("AROMAS website initialized successfully!");
});

// ========== NAVBAR SCROLL EFFECT ==========
function initNavbarScroll() {
    const navbar = document.querySelector(".navbar");
    const navLinks = document.querySelectorAll(".nav-link");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }

        // Update active nav link based on scroll position
        updateActiveNavLink();
    });
}

// Update active navigation link based on current section
function updateActiveNavLink() {
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-link");

    let currentSection = "";

    sections.forEach((section) => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.offsetHeight;

        if (
            window.scrollY >= sectionTop &&
            window.scrollY < sectionTop + sectionHeight
        ) {
            currentSection = section.getAttribute("id");
        }
    });

    navLinks.forEach((link) => {
        const href = link.getAttribute("href");
        if (href && href.startsWith("#")) {
            link.classList.remove("active");
            if (href === `#${currentSection}`) {
                link.classList.add("active");
            }
        }
    });
}

// ========== SMOOTH SCROLL ==========
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("href");
            if (targetId === "#") return;

            const targetElement = document.querySelector(targetId);
            if (!targetElement) return;

            const headerOffset = 80;
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition =
                elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth",
            });

            // Close mobile menu if open
            const navbarCollapse = document.querySelector(".navbar-collapse");
            if (navbarCollapse.classList.contains("show")) {
                const bsCollapse =
                    bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });
    });
}

// ========== SERVICES ACCORDION ==========
function initAccordion() {
    const accordionItems = document.querySelectorAll(".accordion-item");

    accordionItems.forEach((item) => {
        const header = item.querySelector(".accordion-header");
        const content = item.querySelector(".accordion-content");
        const toggle = item.querySelector(".accordion-toggle i");

        header.addEventListener("click", function () {
            const isActive = item.classList.contains("active");

            // Close all accordion items
            accordionItems.forEach((otherItem) => {
                otherItem.classList.remove("active");
                const otherContent =
                    otherItem.querySelector(".accordion-content");
                const otherToggle = otherItem.querySelector(
                    ".accordion-toggle i",
                );

                otherContent.classList.remove("show");
                otherToggle.className = "bi bi-plus-lg";
            });

            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add("active");
                content.classList.add("show");
                toggle.className = "bi bi-dash-lg";
            }
        });
    });
}

// ========== FAQ ACCORDION ==========
function initFaqAccordion() {
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach((item) => {
        const header = item.querySelector(".faq-header");
        const content = item.querySelector(".faq-content");
        const toggle = item.querySelector(".faq-toggle i");

        if (!header || !content || !toggle) return;

        header.addEventListener("click", function () {
            const isActive = item.classList.contains("active");

            // Close all FAQ items
            faqItems.forEach((otherItem) => {
                otherItem.classList.remove("active");
                const otherContent = otherItem.querySelector(".faq-content");
                const otherToggle = otherItem.querySelector(".faq-toggle i");

                if (otherContent) otherContent.classList.remove("show");
                if (otherToggle) otherToggle.className = "bi bi-plus-lg";
            });

            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add("active");
                content.classList.add("show");
                toggle.className = "bi bi-dash-lg";
            }
        });
    });
}

// ========== COUNTER ANIMATION ==========
function initCounterAnimation() {
    const counters = document.querySelectorAll(".counter");
    let countersAnimated = false;

    function animateCounters() {
        counters.forEach((counter) => {
            const target = parseInt(counter.getAttribute("data-target"));
            const duration = 2000; // Animation duration in ms
            const increment = target / (duration / 16); // 60fps

            let current = 0;

            const updateCounter = () => {
                current += increment;

                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        });
    }

    // Intersection Observer for counter animation
    const impactSection = document.querySelector(".impact-section");

    if (impactSection) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting && !countersAnimated) {
                        countersAnimated = true;
                        animateCounters();
                    }
                });
            },
            {
                threshold: 0.5,
            },
        );

        observer.observe(impactSection);
    }
}

// ========== SCROLL ANIMATIONS (AOS-like) ==========
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll("[data-aos]");

    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Add delay if specified
                const delay = entry.target.getAttribute("data-aos-delay") || 0;

                setTimeout(() => {
                    entry.target.classList.add("aos-animate");
                }, delay);
            }
        });
    }, observerOptions);

    animatedElements.forEach((element) => {
        observer.observe(element);
    });
}

// ========== BACK TO TOP BUTTON ==========
function initBackToTop() {
    const backToTopBtn = document.getElementById("backToTop");

    if (!backToTopBtn) return;

    // Show/hide button based on scroll position
    window.addEventListener("scroll", function () {
        if (window.scrollY > 500) {
            backToTopBtn.classList.add("show");
        } else {
            backToTopBtn.classList.remove("show");
        }
    });

    // Scroll to top on click
    backToTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
}

// ========== VIDEO MODAL ==========
function initVideoModal() {
    const videoModal = document.getElementById("videoModal");
    const videoIframe = document.getElementById("videoIframe");

    if (!videoModal || !videoIframe) return;

    // Sample video URL (replace with actual video)
    const videoURL = "https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1";

    videoModal.addEventListener("show.bs.modal", function () {
        videoIframe.src = videoURL;
    });

    videoModal.addEventListener("hide.bs.modal", function () {
        videoIframe.src = "";
    });
}

// ========== MOBILE MENU ENHANCEMENTS ==========
function initMobileMenu() {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.querySelector(".navbar-collapse");

    if (!navbarToggler || !navbarCollapse) return;

    // Close menu when clicking outside
    document.addEventListener("click", function (e) {
        const isClickInsideNav = navbarCollapse.contains(e.target);
        const isClickOnToggler = navbarToggler.contains(e.target);

        if (
            !isClickInsideNav &&
            !isClickOnToggler &&
            navbarCollapse.classList.contains("show")
        ) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) {
                bsCollapse.hide();
            }
        }
    });

    // Add animation class to toggler
    navbarToggler.addEventListener("click", function () {
        this.classList.toggle("active");
    });
}

// ========== BLOG CAROUSEL NAVIGATION ==========
document.addEventListener("DOMContentLoaded", function () {
    const prevBtn = document.querySelector(".blog-nav .prev");
    const nextBtn = document.querySelector(".blog-nav .next");

    if (!prevBtn || !nextBtn) return;

    // Simple visual feedback for navigation buttons
    prevBtn.addEventListener("click", function () {
        this.style.transform = "scale(0.95)";
        setTimeout(() => {
            this.style.transform = "";
        }, 150);
        console.log("Navigate to previous blog posts");
    });

    nextBtn.addEventListener("click", function () {
        this.style.transform = "scale(0.95)";
        setTimeout(() => {
            this.style.transform = "";
        }, 150);
        console.log("Navigate to next blog posts");
    });
});

// ========== UTILITY FUNCTIONS ==========

function debounce(func, wait = 20) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit = 100) {
    let inThrottle;
    return function (...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => (inThrottle = false), limit);
        }
    };
}

// ========== RESIZE HANDLER ==========
window.addEventListener(
    "resize",
    debounce(function () {
        updateActiveNavLink();
    }, 250),
);

// ========================================================
//  HERO SLIDER - TAMBAHAN JS
//  Paste di bagian bawah script.js (sebelum baris terakhir)
// ========================================================

function initHeroSlider() {
    const track        = document.getElementById('heroSlidesTrack');
    const slides       = track ? track.querySelectorAll('.hero-slide') : [];
    const dots         = document.querySelectorAll('.hero-dot');
    const prevBtn      = document.getElementById('heroPrev');
    const nextBtn      = document.getElementById('heroNext');
    const counterEl    = document.getElementById('heroCurrent');
    const progressBar  = document.getElementById('heroProgressBar');

    if (!track || slides.length === 0) return;

    const TOTAL        = slides.length;
    const AUTOPLAY_MS  = 5000;
    let current        = 0;
    let autoplayTimer  = null;
    let isAnimating    = false;

    // ── Go to slide ──
    function goTo(index, resetProgress = true) {
        if (isAnimating) return;
        isAnimating = true;

        // Remove active class from current slide
        slides[current].classList.remove('active-slide');

        // Clamp index
        current = (index + TOTAL) % TOTAL;

        // Apply transform
        track.style.transform = `translateX(-${current * 100}%)`;

        // Add active class to new slide
        slides[current].classList.add('active-slide');

        // Update dots
        dots.forEach((d, i) => d.classList.toggle('active', i === current));

        // Update counter
        if (counterEl) {
            counterEl.textContent = String(current + 1).padStart(2, '0');
        }

        // Reset animating flag after transition
        setTimeout(() => { isAnimating = false; }, 750);

        // Restart progress bar
        if (resetProgress) restartProgress();
    }

    // ── Autoplay ──
    function startAutoplay() {
        clearInterval(autoplayTimer);
        autoplayTimer = setInterval(() => goTo(current + 1), AUTOPLAY_MS);
    }

    function stopAutoplay() {
        clearInterval(autoplayTimer);
    }

    // ── Progress bar ──
    function restartProgress() {
        if (!progressBar) return;
        progressBar.classList.remove('animating');
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';

        // Force reflow
        void progressBar.offsetWidth;

        progressBar.style.transition = `width ${AUTOPLAY_MS}ms linear`;
        progressBar.classList.add('animating');
    }

    // ── Dot clicks ──
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            stopAutoplay();
            goTo(i);
            startAutoplay();
        });
    });

    // ── Arrow buttons ──
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            stopAutoplay();
            goTo(current - 1);
            startAutoplay();
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            stopAutoplay();
            goTo(current + 1);
            startAutoplay();
        });
    }

    // ── Touch / swipe support ──
    let touchStartX = 0;
    let touchEndX   = 0;
    const SWIPE_THRESHOLD = 50;

    track.addEventListener('touchstart', e => {
        touchStartX = e.touches[0].clientX;
    }, { passive: true });

    track.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].clientX;
        const delta = touchStartX - touchEndX;

        if (Math.abs(delta) > SWIPE_THRESHOLD) {
            stopAutoplay();
            goTo(delta > 0 ? current + 1 : current - 1);
            startAutoplay();
        }
    }, { passive: true });

    // ── Keyboard navigation ──
    document.addEventListener('keydown', e => {
        // Only when hero is in viewport
        const heroEl = document.getElementById('home');
        if (!heroEl) return;
        const rect = heroEl.getBoundingClientRect();
        if (rect.bottom < 0 || rect.top > window.innerHeight) return;

        if (e.key === 'ArrowLeft') {
            stopAutoplay();
            goTo(current - 1);
            startAutoplay();
        } else if (e.key === 'ArrowRight') {
            stopAutoplay();
            goTo(current + 1);
            startAutoplay();
        }
    });

    // ── Pause on hover (desktop) ──
    const heroSection = document.getElementById('home');
    if (heroSection) {
        heroSection.addEventListener('mouseenter', () => {
            stopAutoplay();
            if (progressBar) {
                progressBar.style.animationPlayState = 'paused';
            }
        });
        heroSection.addEventListener('mouseleave', () => {
            startAutoplay();
            restartProgress();
        });
    }

    // ── Initialize ──
    goTo(0, true);
    startAutoplay();

    console.log('Hero Slider initialized —', TOTAL, 'slides');
}

/* ── BLOG SLIDER ── */
(function () {
    var track      = document.getElementById('blogSliderTrack');
    var prevBtn    = document.getElementById('blogPrev');
    var nextBtn    = document.getElementById('blogNext');
    var dotsWrap   = document.getElementById('blogDots');

    if (!track || !prevBtn || !nextBtn) return;

    var slides     = track.querySelectorAll('.blog-slide');
    var totalSlides = slides.length;
    var current    = 0;

    /* How many slides visible at once based on window width */
    function getVisible() {
        if (window.innerWidth <= 575)  return 1;
        if (window.innerWidth <= 991)  return 2;
        return 3;
    }

    /* Max index we can scroll to */
    function maxIndex() {
        return Math.max(0, totalSlides - getVisible());
    }

    /* Build dots */
    function buildDots() {
        dotsWrap.innerHTML = '';
        var pages = maxIndex() + 1;
        for (var i = 0; i < pages; i++) {
            var dot = document.createElement('button');
            dot.className = 'blog-dot' + (i === current ? ' active' : '');
            dot.setAttribute('aria-label', 'Halaman ' + (i + 1));
            (function(idx){ dot.addEventListener('click', function(){ goTo(idx); }); })(i);
            dotsWrap.appendChild(dot);
        }
    }

    /* Update dots */
    function updateDots() {
        var dots = dotsWrap.querySelectorAll('.blog-dot');
        dots.forEach(function(d, i){ d.classList.toggle('active', i === current); });
    }

    /* Calculate translateX for the current index */
    function getOffset() {
        if (totalSlides === 0) return 0;
        var slideEl = slides[0];
        /* gap between slides = 24px (from CSS) */
        var gap = 24;
        var slideWidth = slideEl.getBoundingClientRect().width;
        return -(current * (slideWidth + gap));
    }

    /* Animate to index */
    function goTo(idx) {
        current = Math.max(0, Math.min(idx, maxIndex()));
        track.style.transform = 'translateX(' + getOffset() + 'px)';
        prevBtn.disabled = (current === 0);
        nextBtn.disabled = (current >= maxIndex());
        updateDots();
    }

    /* Init */
    buildDots();
    goTo(0);

    prevBtn.addEventListener('click', function () { goTo(current - 1); });
    nextBtn.addEventListener('click', function () { goTo(current + 1); });

    /* Recalculate on resize */
    var resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            buildDots();
            goTo(Math.min(current, maxIndex()));
        }, 150);
    });

    /* Touch/swipe support */
    var touchStartX = 0;
    track.addEventListener('touchstart', function (e) { touchStartX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend',   function (e) {
        var diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) { goTo(diff > 0 ? current + 1 : current - 1); }
    }, { passive: true });
})();