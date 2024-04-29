import MicroModal from "micromodal";

import "./bootstrap";

import Alpine from "alpinejs";

MicroModal.init({
  disableScroll: true,
});

window.Alpine = Alpine;

Alpine.start();
