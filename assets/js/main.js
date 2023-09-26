// IMPORTS GO HERE
import accessibleMenu from "./components/accessible-menu";
import accordions from "../../views/blocks/accordion/accordion";

(($) => {
  $(document).ready(() => {
    // BEGIN CUSTOM CODE GOES HERE
    accessibleMenu($);
    accordions();
    // END CUSTOM CODE GOES HERE
  });
})(jQuery);
