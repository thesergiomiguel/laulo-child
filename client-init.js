"use strict";
(() => {
  // src/dom-scripts/carousel.ts
  function getScrollingDistance(given, target) {
    if (!given) {
      return;
    }
    if (given === "block") {
      return target.clientWidth;
    }
    return parseInt(given);
  }
  function setupCarousels() {
    document.querySelectorAll("[data-carousel]").forEach((el) => {
      const element = el;
      const target = element.dataset.target;
      if (!target) {
        return;
      }
      const targetEl = document.querySelector(target);
      if (!targetEl) {
        return;
      }
      const left = element.querySelector("[data-left]");
      const right = element.querySelector("[data-right]");
      left?.addEventListener("click", () => {
        const distance = getScrollingDistance(
          element.dataset.distance,
          targetEl
        );
        if (!distance) {
          return;
        }
        targetEl.scrollBy({
          left: -1 * distance,
          behavior: "smooth"
        });
      });
      right?.addEventListener("click", () => {
        const distance = getScrollingDistance(
          element.dataset.distance,
          targetEl
        );
        if (!distance) {
          return;
        }
        targetEl.scrollBy({
          left: distance,
          behavior: "smooth"
        });
      });
    });
  }

  // src/dom-scripts/sidebars.ts
  var CLOSING_CLASS_NAME = "Sidebar--closing";
  var OPEN_CLASS_NAME = "Sidebar--open";
  var BACKDROP_CLASSNAME = "with-backdrop";
  function open(element) {
    if (!element) {
      return;
    }
    element.classList.add(OPEN_CLASS_NAME);
    document.body.classList.add(BACKDROP_CLASSNAME);
  }
  function close(element) {
    if (!element) {
      return;
    }
    element.classList.add(CLOSING_CLASS_NAME);
    element.classList.remove(OPEN_CLASS_NAME);
    document.body.classList.remove(BACKDROP_CLASSNAME);
    setTimeout(() => {
      element.classList.remove(CLOSING_CLASS_NAME);
    }, 250);
  }
  function toggle(element) {
    if (!element) {
      return;
    }
    if (element.classList.contains(OPEN_CLASS_NAME)) {
      return close(element);
    }
    open(element);
  }
  function setupSidebars() {
    const openers = document.querySelectorAll("[data-open-sidebar]");
    const closers = document.querySelectorAll("[data-close-sidebar]");
    const togglers = document.querySelectorAll("[data-toggle-sidebar]");
    closers.forEach((element) => {
      const id = element.getAttribute("data-close-sidebar");
      if (!id) {
        return;
      }
      const target = document.getElementById(id);
      element.addEventListener("click", () => close(target));
    });
    openers.forEach((element) => {
      const id = element.getAttribute("data-open-sidebar");
      if (!id) {
        return;
      }
      const target = document.getElementById(id);
      const delay = parseInt(element.getAttribute("data-open-delay") ?? "0");
      if (delay > 0) {
        element.addEventListener("click", () => {
          setTimeout(() => open(target), delay);
        });
        return;
      }
      element.addEventListener("click", () => open(target));
    });
    togglers.forEach((element) => {
      const id = element.getAttribute("data-toggle-sidebar");
      if (!id) {
        return;
      }
      const target = document.getElementById(id);
      element.addEventListener("click", () => toggle(target));
    });
    document.querySelector(".Sidebar__backdrop")?.addEventListener("click", () => {
      document.querySelectorAll(`.${OPEN_CLASS_NAME}`).forEach((el) => close(el));
    });
  }

  // src/dom-scripts/contact-sidebar.ts
  function setupContactSidebar() {
    const form = document.querySelector("form.wpcf7-form");
    form?.addEventListener("submit", (event) => {
      event.preventDefault();
      const data = new FormData(form);
      const actionUrl = form.action;
      fetch(actionUrl, { method: "post", body: data }).then((response) => {
        if (!response.ok) {
          throw new Error("Could not send e-mail.");
        }
        close(document.getElementById("contact-sidebar"));
      }).catch((err) => {
        console.log("Could not send e-mail message.");
        console.log(err);
      });
    });
  }

  // src/dom-scripts/logo.ts
  function setupLogoAnimation() {
    const shell = document.getElementById("logo-toggle");
    shell?.addEventListener("click", () => {
      shell.classList.toggle("Logo__shell--toggled");
    });
  }

  // src/dom-scripts/newsletter-widget.ts
  function setupNewsletterWidget() {
    const widget = document.getElementById("newsletter-widget");
    const target = document.getElementById("main-footer");
    if (!widget || !target) {
      return;
    }
    widget.classList.add("NewsletterBar--visible");
    document.getElementById("newsletter-bar-dismiss")?.addEventListener("click", () => {
      widget.setAttribute("data-is-dismissed", "1");
    });
    const observer = new IntersectionObserver((entries) => {
      const [entry] = entries;
      if (entry.isIntersecting) {
        widget?.setAttribute("data-has-completed", "1");
        widget?.setAttribute("data-is-intersecting", "1");
        return;
      }
      widget?.setAttribute("data-is-intersecting", "0");
    });
    observer.observe(target);
  }

  // src/dom-scripts/subnavs.ts
  function setupNavs() {
    const attr = "data-subnav-state";
    function toggleSubnav(ev) {
      const element = ev.currentTarget;
      if (element.getAttribute(attr) === "1") {
        element.setAttribute(attr, "0");
        return;
      }
      element.setAttribute(attr, "1");
    }
    document.querySelectorAll(`[${attr}]`).forEach((el) => {
      el.addEventListener("click", toggleSubnav);
    });
  }

  // src/dom-scripts/on-dom-content-loaded.ts
  function onDOMContentLoaded(cb) {
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", cb);
    } else {
      cb();
    }
  }
  function init() {
    onDOMContentLoaded(() => {
      setupCarousels();
      setupSidebars();
      setupContactSidebar();
      setupNavs();
      setupNewsletterWidget();
      setupLogoAnimation();
    });
  }

  // src/dom-scripts/client-init.ts
  init();
})();
