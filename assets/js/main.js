// IMPORTS GO HERE
import accessibleMenu from "../../views/components/header/accessible-menu";
import navigation from "../../views/components/header/navigation";
import skipLinkFocusFix from "./components/skip-link-focus-fix";

async function init () {
  /* Load JS for blocks only if they exist on the page */
  // https://parceljs.org/features/code-splitting/
  // Accordion
  const accordionsList = document.querySelector(".accordion");
  if (accordionsList) {
    const accordionsJS = await import('../../views/blocks/accordion/accordion');
    accordionsJS.render();
  }

  // Global Components
  skipLinkFocusFix();
  accessibleMenu();
  navigation();
}

// Initialize Site Scripts
init();