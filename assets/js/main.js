// IMPORTS GO HERE
import siteAlpine from "./alpine.js";
import accessibleMenu from "./components/accessible-menu";
(($) => {
  $(document).ready(() => {
    // BEGIN CUSTOM CODE GOES HERE
    accessibleMenu($);
    // END CUSTOM CODE GOES HERE
  });
})(jQuery);
