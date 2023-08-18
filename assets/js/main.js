// IMPORTS GO HERE
import accessibleMenu from "./components/accessible-menu";
import accordions from "./components/accordion";

(($) => {
  $(document).ready(() => {
    // BEGIN CUSTOM CODE GOES HERE
    accessibleMenu($);
    accordions();
    // END CUSTOM CODE GOES HERE
  });
})(jQuery);
