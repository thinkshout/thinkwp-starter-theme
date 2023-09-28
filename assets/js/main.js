// IMPORTS GO HERE
import accessibleMenu from "../../views/components/header/accessible-menu";
import accordions from "../../views/blocks/accordion/accordion";
import navigation from "../../views/components/header/navigation";

(($) => {
  $(document).ready(() => {
    // BEGIN CUSTOM CODE GOES HERE
    accessibleMenu($);
    accordions();
    navigation();
    // END CUSTOM CODE GOES HERE
  });
})(jQuery);
