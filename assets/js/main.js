// IMPORTS GO HERE
import accessibleMenu from "../../views/components/header/accessible-menu";
import navigation from "../../views/components/header/navigation";

async function init () {
  /* Load JS for blocks only if they exist on the page */
  // Accordion
  const accordionsList = document.querySelector(".accordion");
  if (accordionsList) {
    const accordionsJS = await import('../../views/blocks/accordion/accordion');
    accordionsJS.render();
  }

  // Global Components
  accessibleMenu();
  navigation();
}

// Initialize Site Scripts
init();