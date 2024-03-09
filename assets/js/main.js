/* IMPORTS GO HERE */
import accessibleMenu from "../../views/organisms/header/display/accessible-menu";
import mobileMenu from "../../views/organisms/header/display/mobile-menu";
import skipLinkFocusFix from "../../views/organisms/header/display/skip-link-focus-fix";

async function init() {
	/* Load JS for blocks only if they exist on the page */
	/* https://parceljs.org/features/code-splitting/ */
	/* Accordion */
	const accordionsList = document.querySelector(".accordion");
	if (accordionsList) {
		const accordionsJS = await import( '../../views/organisms/blocks/accordion/display/accordion' );
		accordionsJS.render();
	}
	/* People Cards */
	const peopleCardsGrid = document.querySelector(".people-cards");

	/* Video Element */
	const videoElement = document.querySelector('.video-container');
	if (videoElement) {
		const videoJS = await import("../../views/organisms/blocks/banner/display/banner.js");
		videoJS.render();
	}

	/* Global Components */
	skipLinkFocusFix();
	accessibleMenu();
	mobileMenu();
}

/* Initialize Site Scripts */
init();
