export default () => {
  const axsMenuItems = document.querySelectorAll(".accessible-menu li.menu-item-has-children");
  const axsMenuButtons = document.querySelectorAll(".accessible-menu li.menu-item-has-children button");

  axsMenuButtons.forEach(button => {
    button.setAttribute("aria-expanded", "false");
  });

  axsMenuItems.forEach(axsMenuItem => {
    const activatingA = axsMenuItem.querySelector("a");
    const buttonLabel = `Open submenu for “${activatingA.textContent}”`;
    const btn = document.createElement('button');
    btn.classList.add('reset', 'menu-chevron');
    const span = document.createElement('span');
    span.classList.add('screen-reader-text');
    span.textContent = buttonLabel;
    btn.appendChild(span);
    activatingA.after(btn);

    btn.addEventListener("click", function(event) {
      event.stopPropagation();
      const li = event.target.closest("li.menu-item-has-children");
      li.classList.toggle("open");
      const isOpen = li.classList.contains("open");
      event.target.setAttribute("aria-expanded", isOpen ? "true" : "false");
      const screenReaderText = event.target.querySelector("span.screen-reader-text");
      screenReaderText.textContent = isOpen ? buttonLabel.replace("Open", "Close") : buttonLabel;
    });
  });

  const mainMenuLinks = document.querySelectorAll(".main-navigation > .accessible-menu > .menu-item > .menu-link");

  mainMenuLinks.forEach(mainMenuLink => {
    mainMenuLink.addEventListener("focus", function() {
      axsMenuItems.forEach(axsMenuItem => {
        axsMenuItem.classList.remove("open");
        const button = axsMenuItem.querySelector("button");
        button.setAttribute("aria-expanded", "false");
      });
    });
  });
};